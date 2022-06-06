<!DOCTYPE html>
<html>
<body>

<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname="uis";

$conn = mysqli_connect($servername, $username, $password, $dbname);




echo "<span style='color: black;'>";

if(isset($_REQUEST["Subject"]) && isset($_REQUEST["Text"]) && isset($_REQUEST["Type"]) 
	&& isset($_REQUEST["AnswerDeadline"]) && isset($_REQUEST["StartDate"]) && isset($_REQUEST["StartTime"])
 	&& isset($_REQUEST["EndDate"]) && isset($_REQUEST["EndTime"])
 	&& isset($_REQUEST["UserSearch"]) && isset($_REQUEST["eventID"]) ){


	$EID = $_REQUEST["eventID"];


	$Text = $_REQUEST["Text"];
	$Subject = $_REQUEST["Subject"];
	$EventType = $_REQUEST["Type"];
	$CoUsers = $_REQUEST["CoUserSearch"];
	#$SchoolCalendar = $_REQUEST["TilKalender"];
	#$NotOwnCalendar = $_REQUEST["IkkeEgenKalender"];
	#$WholeDay = $_REQUEST["WholeDay"];
	#$Private = $_REQUEST["Private"];
	$Frequency = $_REQUEST["Frequency"];
	$AnswerDeadline = $_REQUEST["AnswerDeadline"];
	$StartTime = $_REQUEST["StartTime"];
	$EndTime = $_REQUEST["EndTime"];
	$StartDate = $_REQUEST["StartDate"];
	$EndDate = $_REQUEST["EndDate"];
	$Place = $_REQUEST["PlaceSearch"];
	$ExtraPlace = $_REQUEST["PlaceSearchTwo"];
	$Resource = $_REQUEST["ResourceSearch"];
	

	#echo $Text . "<br>";
	#echo $Subject . "<br>";
	$StartD = ($StartDate . " " . $StartTime . ":00");
	$Start = date ('Y-m-d H:i:s', strtotime($StartD));

	$EndD = ($EndDate . " " . $EndTime . ":00");
	$End = date ('Y-m-d H:i:s', strtotime($EndD));
	#echo $Start. "<br>";

	$Users = explode(", ", $_REQUEST["UserSearch"])[1];

	
	$ReqAns = 0;
	if (isset($_REQUEST["Anmod"])) {
		$ReqAns = 1;
	}
	
	
	$cookie = ($_COOKIE['remberLogin']);

	$conn->query(
		"UPDATE begivenhed
		SET Text = '$Text', Subject = '$Subject', EventType = '$EventType', RequstedAnswer = '$ReqAns', AnswerDeadline = '$AnswerDeadline', StartTime = '$Start', EndTime = '$End'
		WHERE EventID = '$EID'");
	
	$last_id = $conn->insert_id;
	echo $last_id;
	$conn->query("INSERT INTO inviterede VALUES (DEFAULT, '$Users', '$last_id', NULL)");
	

	echo "<script> alert('Begivenhed opdateret'); </script>";
	echo '<script type="text/javascript">', 'window.location.replace("http://localhost/Uni/ShowEvents.php");', '</script>';
}
else{
	echo "<h1>ISSET FAILED</h1>";
	if (isset($_REQUEST["UserSearch"])){
		echo "<h1>user was inputted</h1>";
	}
	else{
		echo "<h1> DID NOT RECIVE USER</h1>";
	}
	if (isset($_REQUEST["eventID"])) {
		echo "<h1>EventID recived</h1>";
	}
	else{
		echo "<h1> DID NOT RECIVE EVENT ID</h1>";
	}
	
}
echo "</span>";


$conn->close();
?>
</body>
</html>