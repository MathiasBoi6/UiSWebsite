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
    Se beskeder du har sendt og modtaget
    </h1>
    <br>
    <h2>
        Egne beskeder:
    </h2>";


$cookie = ($_COOKIE['remberLogin']);
$result = $conn->query(
    "SELECT Name, Subject, Text FROM `besked`
    LEFT JOIN user
    ON user.SSN = besked.ToUserID
    WHERE besked.FromUserID='$cookie'");

if ($result->num_rows > 0) {
    echo "<table><tr><th>Modtager</th><th>Emne</th><th>Tekst</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["Name"]. "</td><td>" . $row["Subject"]. "</td><td>" . $row["Text"]. "</td></tr>";
    }
    echo "</table>";
} else {
    echo "<h1 style='color: red;'>Du har ikke skrevet nogen beskeder</h1>";
}


echo    "<br>
        <h2>
            Beskeder du har skrevet:
        </h2>";



$result = $conn->query(
    "SELECT Name, Subject, Text FROM `besked`
    LEFT JOIN user
    ON user.SSN = besked.FromUserID
    WHERE besked.ToUserID='$cookie'");


if ($result->num_rows > 0) {
    echo "<table><tr><th>Modtager</th><th>Emne</th><th>Tekst</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["Name"]. "</td><td>" . $row["Subject"]. "</td><td>" . $row["Text"]. "</td></tr>";
    }
    echo "</table>";
} else {
    echo "<h1 style='color: red;'>Du har ikke modtaget nogen beskeder</h1>";
}

echo "</div>";

?>


</body>
</html>