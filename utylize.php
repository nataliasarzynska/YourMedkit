<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Utylize</title>
        <link rel="stylesheet" href="stylelog.css" type="text/css" />
        <meta charset="UTF-8">
    </head>
    <body> 


<div id ="menulog">

<?php

$servername = "";
$username = "";
$dbpassword = "";
$dbname = "";

$conn = mysqli_connect($servername, $username, $dbpassword, $dbname);
if(!$conn){
    die("Connection failed: ".mysqli_connect_error());
}


$current_user = $_SESSION["current_user"];

$medkit_name = "SELECT medkit_1 FROM users WHERE user_fullname = '$current_user'";
$result_ = mysqli_query($conn, $medkit_name);
while($row = mysqli_fetch_assoc($result_)) {
    $medkit_name = $row['medkit_1']; 
}




$sql = "DELETE FROM $medkit_name WHERE `idmed`=".$_GET["ajdi"];

if(mysqli_query($conn, $sql)){
    echo "Utylized!<br> ";
}
echo "<a href='./medkit1.php'> Medkit</a> ";


?>

</div>