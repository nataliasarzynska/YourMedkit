<?php
session_start();
echo "<meta  charset = 'UTF-8'>";


$servername = "";
$username = "";
$dbpassword = "";
$dbname = "";

$conn = mysqli_connect($servername, $username, $dbpassword, $dbname);
if(!$conn){
    die("Connection failed: ".mysqli_connect_error());
}


$current_user = $_SESSION["current_user"];


$medkit_name = "SELECT medkit_3 FROM users WHERE user_fullname = '$current_user'";
$result_ = mysqli_query($conn, $medkit_name);
while($row = mysqli_fetch_assoc($result_)) {
    $medkit_name = $row['medkit_3']; 
}



$sql = "DELETE FROM .$medkit_name WHERE `idmed`=".$_GET["ajdi"];

if(mysqli_query($conn, $sql)){
    echo "Utylized!<br> ";
}
echo "<a href='./medkit3.php'> Medkit</a> ";


?>