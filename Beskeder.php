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
echo "<div class='Centered'>";

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


#Samme som fra ShowUser
$cookie = ($_COOKIE['remberLogin']);
$result = $conn->query("SELECT * FROM user WHERE SSN = '$cookie'");
if($result->num_rows == 1) {
    $Row = $result->fetch_assoc();
    echo '<div style="border: 4px solid #73AD21; position: absolute; top: 25%; left: 39%; color:black; ">' . ($Row["Name"]) . '</div>';
} 



#--------------- Form response --------------------
if(isset($_REQUEST["Subject"]) && isset($_REQUEST["Text"]) && isset($_REQUEST["UserSearch"]) ){

    $Text = $_REQUEST["Text"];
    $Subject = $_REQUEST["Subject"];
    $Users = explode(", ", $_REQUEST["UserSearch"])[1];

    $conn->query("CALL `WriteMessage`('$cookie', '$Users', '$Subject', '$Text');");
    #$conn->query("INSERT INTO besked VALUES (DEFAULT, '$cookie', '$Users', '$Subject', '$Text')");
    echo "<h1>CALL `WriteMessage`('$cookie', '$Users', '$Subject', '$Text');</h1>";

    echo "<script> alert('Besked sendt'); </script>";
}



$conn->close();
?>

    <h1>Skriv beskeder til sig selv</h1>
    <p>Udfyld de grønne felter og klik 'Send' for at sende en besked.</p>
    <img src="Beskeder.png" alt="Beskeder" style="width: 30%; margin-left: auto;
            margin-right: auto;">
    <form action="Beskeder.php" method="post">
    <div 
        style="
        position: absolute;
        top: 32%;
        left: 39%;
        border: 4px solid #73AD21;">
        <input  list="UserList" name="UserSearch" multiple onclick="UpdateRequest()"
                placeholder="Søg efter deltagere..." size="30" required>
    </div>

    <div 
        style="
        position: absolute;
        top: 43%;
        left: 39%;
        border: 4px solid #73AD21;">
        <input  type="text" name="Subject"  required onclick="UpdateRequest()"
                minlength="2" maxlength="50" size="30">
    </div>

    <div 
        style="
        position: absolute;
        top: 55%;
        left: 39%;
        border: 4px solid #73AD21;">
        <input  type="text" name="Text"  required onclick="UpdateRequest()"
                minlength="0" maxlength="1500" size="50">
    </div>

    <div 
        style="
        position: absolute;
        top: 80%;
        left: 57%;
        border: 4px solid #73AD21;">
        <input type="submit"
               id="submit"
               value="Send">
    </div>
    </form>
</div>

</body>
</html>