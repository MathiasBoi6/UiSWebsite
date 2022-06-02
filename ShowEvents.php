<!DOCTYPE html>
<html>
<link rel="stylesheet" href="style.css">
<body>


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
    echo "<script> document.getElementsByClassName(\"ownEvents\").innerHTML = \"Hej med mig\" ; </script>"; 
    echo "<table><tr><th>Name</th><th>BegivenhedNr</th><th>Emne</th><th>StartDato</th><th>SlutDato</th><th>Anmodet svar</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["Name"]. "</td><td>" . $row["EventID"]. "</td><td>" . $row["Subject"]. "</td><td>" . $row["StartTime"]. "</td><td>" . $row["EndTime"].
        "</td><td>" . $row["RequstedAnswer"]. "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}


echo    "<br>
        <h2>
            Begivenheder du er blevet inviteret til:
        </h2>";

echo "</div>";

?>


</body>
</html>