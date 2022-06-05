<!DOCTYPE html>
<html>
<body>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>


<?php

include_once 'TopNav.html';
include_once 'ShowUser.php';
include_once 'BegivenhedPage.html';

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

echo "<span style='color: white;'>";

if(isset($_REQUEST["Subject"]) && isset($_REQUEST["Text"]) && isset($_REQUEST["Type"]) 
	&& isset($_REQUEST["AnswerDeadline"]) && isset($_REQUEST["StartDate"]) && isset($_REQUEST["StartTime"])
 	&& isset($_REQUEST["EndDate"]) && isset($_REQUEST["EndTime"])
 	&& isset($_REQUEST["UserSearch"]) ){

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
	$conn->query("INSERT INTO begivenhed VALUES (DEFAULT, '$cookie', '$Text', '$Subject', '$EventType', '$ReqAns', '$AnswerDeadline', '$Start', '$End')");
	echo "<h1>INSERT INTO begivenhed VALUES (DEFAULT, '$cookie', '$Text', '$Subject', '$EventType', '$ReqAns', '$AnswerDeadline', '$Start', '$End')</h1>";

	$last_id = $conn->insert_id;
	echo $last_id;
	$conn->query("INSERT INTO inviterede VALUES (DEFAULT, '$Users', '$last_id', NULL)");
	echo "<h1>INSERT INTO inviterede VALUES ('$Users', '$last_id', DEFAULT)</h1>";

}
else{
	echo "<h1>ISSET FAILED</h1>";
	if (isset($_REQUEST["UserSearch"])){
		echo "<h1>user was inputted</h1>";
	}
	else{
		echo "<h1> DID NOT RECIVE USER</h1>";
	}
	
}
echo "</span>";

$conn->close();
?>

</body>
</html>