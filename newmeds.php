<?php 
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>YourMedkit</title>
        <link rel="stylesheet" href="stylelog.css" type="text/css" />
        <meta charset="UTF-8">
    </head>
    <body>  


<?php

$expdate=$quantmed=$medsopt= "";




function chgw($dane){
    $dane = trim($dane);
    $dane = stripslashes($dane);
    $dane = htmlspecialchars($dane);
    return $dane;
}

if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $expdate = $_POST['expdate'];
    $medsopt = chgw($_POST['medsopt']);
    $quantmed = $_POST['quantmed'];
    $medkitname = $_POST['medkit_name'];
}

?>


<?php


    $servername = "";
    $username = "";
    $dbpassword = "";
    $dbname = "";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if(!$conn){
        die("Connection failed: " . mysqli_connect_error());

    }
    $current_user = $_SESSION["current_user"];

   // $medkit_22 = "SELECT medkit_2 FROM users WHERE user_fullname = '$current_user'";
    //$result111 = mysqli_query($conn, $medkit_22);
    //while($row = mysqli_fetch_assoc($result111)) {
      //  $medkit_actual = $row['medkit_2']; 
  
    //}
    $which_medkit = $_POST['wh_medkit'];

    $sql = "INSERT INTO  .$which_medkit  (medname,expidate,quant) VALUES ('".$medsopt."','".$expdate."','".$quantmed."')";
?>
    <div id = "menulog" >
        <?php
    if(mysqli_query($conn,$sql)){
        echo "New med added";


    } else {
        echo "Error ".$sql. "<br>". mysqli_error($conn);
    }
   
    echo "<a href = 'listaapteczek.php'>Zobacz apteczkę</a>"


?>

</div>

