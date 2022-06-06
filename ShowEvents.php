<!DOCTYPE html>
<html>
<link rel="stylesheet" href="style.css">
<body>

<script>
    function changeEvent(id) {
        //Go to ChangeEvent.php and pass the id of the event as a cookie
        var cookie_name = "changeEvent";
        var cookie_value = id;
        document.cookie = cookie_name + "=" + cookie_value + "; path=/";
        window.location.replace("http://localhost/uiswebsite/ChangeEvent.php");
    }
</script>

<?php
function changeEventAux($id){
    $cookie_name = "event2bChanged";
	$cookie_value = $id;
	setcookie($cookie_name, $cookie_value["SSN"], time() + (86400 * 30), "/"); // 86400 = 1 day
}
//php_func();
?>

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




echo "<div class=\"Centered\">
    <h1>
    Se begivenheder du er blevet inviteret til, og som du har lavet.
    </h1>
    <br>
    <h2>
        Egne begivenheder:
    </h2>";


$cookie = ($_COOKIE['remberLogin']);
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
        <td>" . $row["Name"]. "</td>
        <td>" . $row["EventID"]. "</td>
        <td>" . $row["Subject"]. "</td>
        <td>" . $row["StartTime"]. "</td>
        <td>" . $row["EndTime"]. "</td>
        <td>" . $requstedAnswer. "</td>
        <td> . <button onclick=\"changeEvent(" . $row["EventID"] . ")\">Ændre Begivenhed</button> </td>
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



$result = $conn->query(
    "SELECT Name, Subject, EventType, StartTime, EndTime, AnswerDeadline, Answer, Text From inviterede
    LEFT JOIN 
        (SELECT EventID, Name, Subject, EventType, StartTime, EndTime, AnswerDeadline, RequstedAnswer, Text  FROM `begivenhed`
        LEFT JOIN `user`
        ON user.SSN = begivenhed.UserID) as Q1
    ON inviterede.EventID = Q1.EventID
    WHERE inviterede.UserID = '$cookie'");


if ($result->num_rows > 0) {
    echo "<table><tr><th>Navn</th><th>Emne</th><th>Type</th><th>StartDato</th><th>SlutDato</th><th>SvarDeadline</th><th>Dit svar</th><th>Text</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["Name"]. "</td><td>" . $row["Subject"]. "</td><td>" . $row["EventType"]. "</td><td>" . $row["StartTime"]. "</td><td>" . $row["EndTime"].
        "</td><td>" . $row["AnswerDeadline"]. "</td><td>" . $row["Answer"]."</td><td>" . $row["Text"]. "</td></tr>";
    }
    echo "</table>";
} else {
    echo "<h1 style='color: red;'>Du er ikke blevet inviteret til nogle begivenheder</h1>";
}

echo "</div>";

?>


</body>
</html>
