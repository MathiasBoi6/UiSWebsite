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
include_once 'forside.html';


$servername = "localhost";
$username = "root";
$password = "";
$dbname="uis";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if(isset($_REQUEST["navn2"]) && isset($_REQUEST["kode2"])) {
	$navn2 = $_REQUEST["navn2"];
	$kode2 = $_REQUEST["kode2"];
	$Age = $_REQUEST["Age"];
	$Role = $_REQUEST["Role"];
	$result = $conn->query("SELECT * FROM user WHERE Name = '$navn2'");
	if($result->num_rows == 0){
		$conn->query("INSERT INTO user(Name, Password, Age, Role, SSN) VALUES ('$navn2', '$kode2', '$Age', '$Role', DEFAULT)");


		$res2 = $conn->query("SELECT * FROM user WHERE Name = '$navn2' AND Password = '$kode2'");
		$cookie_name = "remberLogin";
		$cookie_value = $res2->fetch_assoc();
		setcookie($cookie_name, $cookie_value["SSN"], time() + (86400 * 30), "/"); // 86400 = 1 day


		echo '<script type="text/javascript">', 'window.location.replace("http://localhost/Uni/HyggeTest.php");', '</script>';
	} else {
		echo'<script type="text/javascript">', 'alert("User name already exists!");', '</script>';
	}
} else {
	if(isset($_REQUEST["navn1"]) && isset($_REQUEST["kode1"])) {
		$navn1 = $_REQUEST["navn1"];
		$kode1 = $_REQUEST["kode1"];
		$result = $conn->query("SELECT * FROM user WHERE Name = '$navn1'");
		if($result->num_rows == 0){
			echo '<script type="text/javascript">', 'alert("User name does not exists!");', '</script>';
		} else {
			if($kode1 == mysqli_fetch_assoc($result)['Password']){


				$res2 = $conn->query("SELECT * FROM user WHERE Name = '$navn1' AND Password = '$kode1'");
				$cookie_name = "remberLogin";
				$cookie_value = $res2->fetch_assoc();
				setcookie($cookie_name, $cookie_value["SSN"], time() + (86400 * 30), "/"); // 86400 = 1 day


				echo '<script type="text/javascript">', 'window.location.replace("http://localhost/Uni/HyggeTest.php");', '</script>';
			} else {
				echo'<script type="text/javascript">', 'alert("Code does not match username");', '</script>';
			}
		}
	}
}


?>

</body>
</html>