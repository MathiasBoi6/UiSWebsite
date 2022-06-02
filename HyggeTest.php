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
include_once 'FrontPage.html';

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
    echo "<option value=\"". $row["Name"] ."\">";
}
echo "</datalist>";




$result = $conn->query("SELECT * FROM user");

if(isset($_REQUEST["Subject"]) && isset($_REQUEST["Text"]) && isset($_REQUEST["Type"]) && isset($_REQUEST["Anmod"]) 
	&& isset($_REQUEST["AnswerDeadline"]) && isset($_REQUEST["StartDate"]) && isset($_REQUEST["StartTime"])
 	&& isset($_REQUEST["EndDate"]) && isset($_REQUEST["EndTime"])) {

	$Text = $_REQUEST["Text"];
	$Subject = $_REQUEST["Subject"];
	$EventType = $_REQUEST["Type"];
	$Users = $_REQUEST["UserSearch"];
	$CoUsers = $_REQUEST["CoUserSearch"];
	$RequstedAnswer = $_REQUEST["Anmod"];
	$SchoolCalendar = $_REQUEST["TilKalender"];
	$NotOwnCalendar = $_REQUEST["IkkeEgenKalender"];
	$WholeDay = $_REQUEST["WholeDay"];
	$Private = $_REQUEST["Private"];
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
	#echo $RequstedAnswer. "<br>";
	$StartD = ($StartDate . " " . $StartTime . ":00");
	$Start = date ('Y-m-d H:i:s', strtotime($StartD));

	$EndD = ($EndDate . " " . $EndTime . ":00");
	$End = date ('Y-m-d H:i:s', strtotime($EndD));
	#echo $Start. "<br>";
	
	#echo "DEFAULT, '".$Text."', '".$Subject."', '".$EventType."', '".$RequstedAnswer."', '".$AnswerDeadline."', '".$Start."', '".$End."' <br>";
	$cookie = ($_COOKIE['remberLogin']);
	$conn->query("INSERT INTO begivenhed VALUES (DEFAULT, '$cookie', '$Text', '$Subject', '$EventType', '$RequstedAnswer', '$AnswerDeadline', '$Start', '$End')");
}


$conn->close();
?>

</body>
</html>