<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname="uis";

$conn = mysqli_connect($servername, $username, $password, $dbname);


$test = ($_COOKIE['remberLogin']);


$result = $conn->query("SELECT * FROM user WHERE SSN = '$test'");
if($result->num_rows == 1) {
	$Row = $result->fetch_assoc();
	echo '<p style="font-size: 24px; color:white;position: absolute; top: -1%; right: 1%;"> Logged in as: ' . ($Row["Name"]) . '</p>';
} 
else{
	echo '<script type="text/javascript">', 'window.location.replace("http://localhost/Uni/Login.php");', '</script>';
}
?>