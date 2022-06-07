<!DOCTYPE html>
<html>
<link rel="stylesheet" href="style.css">
<body>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

<?php

include_once 'TopNav.html';
include_once 'ShowUser.php';

?>

<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname="uis";

$conn = mysqli_connect($servername, $username, $password, $dbname);

$cookie = ($_COOKIE['remberLogin']);

#----------- If recived from form -----------------


if(isset($_REQUEST["Yes"])){
    $EID = $_REQUEST["Yes"];
    $conn->query(
        "UPDATE inviterede
        SET Answer = 1
        WHERE EventID = '$EID' && UserID = '$cookie'");
}
else if(isset($_REQUEST["No"])){
    $EID = $_REQUEST["No"];
    $conn->query(
        "UPDATE inviterede
        SET Answer = 0
        WHERE EventID = '$EID' && UserID = '$cookie'");
}



#----------- Normal runtime ----------------------



echo "<div class=\"Centered\">
    <h1>
    Se begivenheder du er blevet inviteret til, og som du har lavet.
    </h1>
    <br>
    <h2>
        Egne begivenheder:
    </h2>";


#--------------------------Your events ----------------------

$result = $conn->query(
    "SELECT Name, EventID, Subject, StartTime, EndTime, RequstedAnswer FROM `user`
    INNER JOIN `begivenhed` 
    ON SSN = UserID
    WHERE SSN='$cookie'");

if ($result->num_rows > 0) {
    echo "<table><tr>
    <th>Name</th>
    <th>BegivenhedNr</th>
    <th>Emne</th>
    <th>StartDato</th>
    <th>SlutDato</th>
    <th>Anmodet svar</th>
    <th>Ændrer Begivenhed</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $requstedAnswer = "Nej";
        if ($row["RequstedAnswer"] == 1) {
            $requstedAnswer = "Ja";
        }
        //Display the event name, id, subject, start, end time, if the user has requested to attend the event and a button for changing the event
        echo "<tr>
        <form action='ChangeEvent.php' method='post'>
        <td>" . $row["Name"]. "</td>
        <td>" . $row["EventID"]. "</td>
        <td>" . $row["Subject"]. "</td>
        <td>" . $row["StartTime"]. "</td>
        <td>" . $row["EndTime"]. "</td>
        <td>" . $requstedAnswer. "</td>
        <input style='display:none;' name='Subject' value='" .  $row["Subject"] ."'>
        <input style='display:none;' name='StartTime' value='" .  $row["StartTime"] ."'>
        <input style='display:none;' name='EndTime' value='" .  $row["EndTime"] ."'>
        <td>" . "<button type='submit' name='eventID' value='" . $row["EventID"] . "'>Ændre</button></td>
        </form>
        </tr>";
    }
    echo "</table>";
    
} else {
    echo "<h1 style='color: red;'>Du har ikke lavet nogle events</h1>";
}


echo    "<br>
        <h2>
            Begivenheder du er blevet inviteret til:
        </h2>";

#--------------------------Your invitations ----------------------

$result = $conn->query(
    "SELECT inviterede.EventID, Name, Subject, EventType, StartTime, EndTime, AnswerDeadline, Answer, RequstedAnswer, Text From inviterede
    LEFT JOIN 
        (SELECT EventID, Name, Subject, EventType, StartTime, EndTime, AnswerDeadline, RequstedAnswer, Text  FROM `begivenhed`
        LEFT JOIN `user`
        ON user.SSN = begivenhed.UserID) as Q1
    ON inviterede.EventID = Q1.EventID
    WHERE inviterede.UserID = '$cookie'");


if ($result->num_rows > 0) {
    echo "<table>
    <tr>
    <th>Navn</th>
    <th>Emne</th>
    <th>Type</th>
    <th>StartDato</th>
    <th>SlutDato</th>
    <th>SvarDeadline</th>
    <th>Dit svar</th>
    <th>Text</th>
    </tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $actAnswer = $row["Answer"];
        if($row["Answer"] == ""){
            $actAnswer = "Ikke svaret";
        }
        else if($row["Answer"] == 1){
            $actAnswer = "Ja";
        }
        else if($row["Answer"] == 0){
            $actAnswer = "Nej";
        }

        if ($row["RequstedAnswer"] == 1) {
            
        }
        echo "<tr><td>" . 
        $row["Name"] . "</td><td>" . 
        $row["Subject"]. "</td><td>" . 
        $row["EventType"]. "</td><td>" . 
        $row["StartTime"]. "</td><td>" . 
        $row["EndTime"]. "</td><td>" . 
        $row["AnswerDeadline"]. "</td><td>" . 
        $row["Text"]. "</td><td>";
        if ($row["RequstedAnswer"] == 1) {
            echo "<form action='ShowEvents.php' method='post'>" .
            $actAnswer . "&nbsp;&nbsp;" .
            "<button type='submit' name='Yes' value='" . $row["EventID"] . "'>Ja</button>" .
            "<button type='submit' name='No' value='" . $row["EventID"] . "'>Nej</button></td>" .
            "</form>";
        }
        echo "</td></tr>";
    }
    echo "</table>";
} else {
    echo "<h1 style='color: red;'>Du er ikke blevet inviteret til nogle begivenheder</h1>";
}

echo "</div>";

?>


</body>
</html>
