<!DOCTYPE html>
<html>
<meta charset="UTF-8">
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
    <p>Her kan man kun afprøve det at oprette en samtale, og kan ikke oprette en samtale der bliver overført til databasen.</p>
    <img src="Samtaler.png" alt="Samtaler" style="width: 60%; margin-left: auto;
            margin-right: auto;">


    
    <div 
        style="
        position: absolute;
        top: 40%;
        left: 27.3%;
        border: 4px solid #ff6969;">
        <input  list="UserList" id="UserSearch" multiple onclick="UpdateRequest()"
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
        <input  type="number" id="Varighed" onclick="UpdateRequest()" size="30">
    </div>

    <div 
        style="
        position: absolute;
        top: 63%;
        left: 43%;
        border: 4px solid #73AD21;">
        <input  type="number" id="AntalFoerPause" onclick="UpdateRequest()" size="30">
    </div>

    <div 
        style="
        position: absolute;
        top: 63%;
        left: 59%;
        border: 4px solid #73AD21;">
        <select id="Pause" onclick="UpdateRequest()"> 
            <option value="Ingen">Ingen</option>
            <option value="FemMin">5 min</option>
            <option value="TenMin">10 min</option>
            <option value="FemTenMin">15 min</option>
        </select>
    </div>

    <div 
        style="
        position: absolute;
        top: 73.7%;
        left: 39%;
        border: 4px solid #73AD21;">
        <input  type="time" id="StartTime" required
                onclick="UpdateRequest()">
    </div>


    <div 
        style="
        position: absolute;
        top: 74%;
        left: 46.8%;
        border: 4px solid #73AD21;">
        <input  type="number" id="Antal" onclick="UpdateRequest()" size="30">
    </div>

    <div 
        style="
        position: absolute;
        top: 71%;
        left: 58%;
        width: 25%;
        color: red;">
        <h1 id="Change">
            Slut tid: ??:??
        </h1>
    </div>
</div>

</body>


<script type="text/javascript">

input.addEventListener("keypress", function(event) {
  if (event.key === "Enter") {
    UpdateRequest();
  }
});

function UpdateRequest(){
    const varighed = document.querySelector('#Varighed').valueAsNumber;
    const antalFoerPause = document.querySelector('#AntalFoerPause').valueAsNumber;
    const pause = document.querySelector('#Pause').value;
    const startTime = document.querySelector('#StartTime').value;
    var antal = (document.querySelector('#Antal')).valueAsNumber;

    

    if(!isNaN(antal) && !isNaN(varighed) && !isNaN(antalFoerPause) && startTime != "") {
        var slutTid = 0;
        var pauseAmount = Math.floor(antal / antalFoerPause);
        if(antal % antalFoerPause == 0){
            pauseAmount -= 1;
        }
        switch(pause) {
            case "Ingen":
                slutTid = varighed * antal;
                break;
            case "FemMin":
                slutTid = varighed * antal + pauseAmount * 5;
                break;
            case "TenMin":
                slutTid = varighed * antal + pauseAmount * 10;
                break;
            case "FemTenMin":
                slutTid = varighed * antal + pauseAmount * 15;
                break;
        }
        var minutter = slutTid % 60;
        var timer = Math.floor(slutTid / 60);
        var startTimeArr = startTime.split(":");

        var newTimeArr = new Array(parseInt(startTimeArr[0]) + timer, parseInt(startTimeArr[1]) + minutter)
        
        console.log(newTimeArr[0], newTimeArr[1]);

        if (newTimeArr[1] < 10) {
            document.getElementById("Change").innerHTML = "Slut tid: " + newTimeArr[0].toString() + ":0" + newTimeArr[1].toString();        
        }
        else {
            document.getElementById("Change").innerHTML = "Slut tid: " + newTimeArr[0].toString() + ":" + newTimeArr[1].toString();        
        }
    } 
}

</script>


</html>