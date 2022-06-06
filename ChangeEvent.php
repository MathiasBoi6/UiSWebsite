<!DOCTYPE html>
<html>
<link rel="stylesheet" href="style.css">
<body>


<?php

include_once 'TopNav.html';
include_once 'ShowUser.php';

//Let the user change the event using the id present in the changeEvent cookie.
$id = $_COOKIE['changeEvent'];
//Interface for changing the event.
echo "<div class=\"Centered\">
    <h1>
    Ændring af begivenhed
    </h1>
    <br>
    <h2>
        Ændring af begivenhed:
    </h2>";




?>
</body>
</html>