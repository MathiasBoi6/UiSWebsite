<!DOCTYPE html>
<html>
<link rel="stylesheet" href="style.css">
<body>


<?php

include_once 'TopNav.html';
include_once 'ShowUser.php';
include_once 'BegivenhedChangePage.html';

$servername = "localhost";
$username = "root";
$password = "";
$dbname="uis";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$UserList = $conn->query("SELECT * FROM user");
echo "<datalist id=\"UserList\">";
while($row = $UserList->fetch_assoc()) {
    echo "<option value=\"". $row["Name"] .", ". $row["SSN"]  ."\">";
}
echo "</datalist>";

$cookie = ($_COOKIE['remberLogin']);


if(isset($_REQUEST["eventID"]) && isset($_REQUEST["Subject"]) && isset($_REQUEST["StartTime"]) && isset($_REQUEST["EndTime"]) ){
	$EID = $_REQUEST["eventID"];
	$subject = $_REQUEST["Subject"];
	$start = $_REQUEST["StartTime"];
	$end = $_REQUEST["EndTime"];

	$startday = explode(" ", $start);
	$endday = explode(" ", $end);

	#echo "<h1>". $start . "</h1>";
	#echo "<h1>". $startday[0] . "</h1>";
	echo "<script> 
		document.getElementById('eventID').value = '". $EID ."';
		document.getElementById('Subject').value = '". $subject ."';
		document.getElementById('EndDate').value = '". $startday[0] ."';
		document.getElementById('StartDate').value = '". $endday[0] ."'; 
		
		StartDate = '". $startday[0] ."';
		EndDate = '". $endday[0] ."';

		</script> " ;
}


$conn->close();
?>




</body>
</html>