<?php
session_start();
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Intake</title>
        <link rel="stylesheet" href="stylelog.css" type="text/css" />
        <meta charset="UTF-8">
    </head>
    <body>  
<div id="menulog">
    <?php
$medid = $medqu = $userr = "";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $medid=$_POST["medid"];
    $medqu=$_POST["medqu"];
    $userr = $_SESSION["current_user"];

}

$servername = "";
$username = "";
$dbpassword = "";
$dbname = "";

$conn = mysqli_connect($servername, $username, $dbpassword, $dbname);
if(!$conn){
    die("Connection failed: ".mysqli_connect_error());
}

$current_user = $_SESSION["current_user"];

// first medkit
$medkit_name = "SELECT medkit_1 FROM users WHERE user_fullname = '$current_user'";
$result_ = mysqli_query($conn, $medkit_name);
while($row = mysqli_fetch_assoc($result_)) {
    $medkit_name = $row['medkit_1']; 
}

$medkit_out = $medkit_name."_out";

echo $medkit_out;

$us = "SELECT user_id FROM users WHERE user_fullname = '$current_user'";
$result_us = mysqli_query($conn, $us);
while($row = mysqli_fetch_assoc($result_us)) {
    $us = $row['user_id']; 
}


$sql = "INSERT INTO .$medkit_out (`idout`, `user_id`, `idmed`, `quant`, `dateout`) VALUES (NULL, '".$us."', '".$medid."', '".$medqu."', CURRENT_DATE());";

if(mysqli_query($conn, $sql)){
    echo "Added! ";
} 

$esql = "SELECT `quant` FROM .$medkit_name WHERE `idmed` = ".$medid;
$eresult = mysqli_query($conn, $esql);


if (mysqli_num_rows($eresult) > 0){
    while($erow = mysqli_fetch_assoc($eresult)){
        $zostalo = $erow["quant"]-$medqu;
    }
}

$sqle = "UPDATE  .$medkit_name SET `quant` = ".$zostalo." WHERE `idmed` =".$medid;


if(mysqli_query($conn, $sqle)){
    echo "";
} else {
    echo "Error! ";
}
echo "<a href = 'medkit1.php'>See your medkit</a>"

?>
</div>
</body>
</html>