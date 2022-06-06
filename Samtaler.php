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



$conn->close();
?>

    <h1>Opret samtaler</h1>
    <p>Tekst her.</p>
    <img src="Samtaler.png" alt="Samtaler" style="width: 60%; margin-left: auto;
            margin-right: auto;">


    <form action="Samtaler.php" method="post">
    <div 
        style="
        position: absolute;
        top: 40%;
        left: 27.3%;
        border: 4px solid #ff6969;">
        <input  list="UserList" name="UserSearch" multiple onclick="UpdateRequest()"
                placeholder="Søg efter deltagere..." size="30">
    </div>

    <p style="color: black;
        position: absolute;
        top: 58%;
        left: 34%;
        ">i minutter</p>
    <div 
        style="
        position: absolute;
        top: 63%;
        left: 27.3%;
        border: 4px solid #73AD21;">
        <input  type="number" name="Varighed" onclick="UpdateRequest()" size="30">
    </div>

    <div 
        style="
        position: absolute;
        top: 63%;
        left: 43%;
        border: 4px solid #73AD21;">
        <input  type="number" name="Varighed" onclick="UpdateRequest()" size="30">
    </div>

    <div 
        style="
        position: absolute;
        top: 63%;
        left: 59%;
        border: 4px solid #73AD21;">
        <select name="Type" onclick="UpdateRequest()"> 
            <option value="Ingen">Ingen</option>
            <option value="FemMin">5 min</option>
            <option value="TenMin">10 min</option>
            <option value="FemTenMin">15 min</option>
        </select>
    </div>

    </form>
</div>

</body>
</html>