<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Domowa Apteczka</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style.css" type="text/css" />
    </head>
    <body>  

        <?php

$servername = "mysql.agh.edu.pl";
$username = "sarzyns1";
$dbpassword = "AAKV2ZvVy8UUW8cF";
$dbname = "sarzyns1";

$dbconn = mysqli_connect($servername, $username, $dbpassword, $dbname);
$user_password = mysqli_real_escape_string($dbconn, $_POST["password"]);
$user_email = mysqli_real_escape_string($dbconn, $_POST["email"]);
$query = mysqli_query($dbconn, "SELECT*FROM users WHERE user_email = '$user_email'");


if (mysqli_num_rows($query)>0) {
    $record = mysqli_fetch_assoc($query);
    $hash = $record["user_passwordhash"];

    if(password_verify($user_password, $hash))
    {
        $_SESSION["current_user"] = $record["user_fullname"];
        
    }
}


        ?>
    

    
    <div id="sidebar">

    
    <div class="image-user">

        <img src="us.png" alt="user"><br> </div>

    <div class="user">
    <?php
    if (isset($_SESSION["current_user"])){
     echo "Witaj " .$_SESSION["current_user"]. " !";
} else {
    echo "Użytkownik nie jest zalogowany";
}?>
</div>
    <div class="optionL"><a href = "./login.php"> Strona główna </a></div> 
    <div class="optionL"><a href = "./listaapteczek.php"> Zobacz swoje apteczki </a></div>
    <div class="optionL"><a href = "./dodajapteczke.php"> Dodaj nową apteczkę </a></div>
    <div class="optionL"> <a href = "./dodajnowylek.php"> Dodaj nowy lek</a></div>
    <div class="optionL"> <a href = "./ktozazyl.php"> Ostatnie zażycia</a></div>
    <div class="optionL"> <a href = "./wyloguj.php"> Wyloguj się</a></div>



</div>
<?php 
$current_user = $_SESSION["current_user"];
$conn = mysqli_connect($servername, $username, $dbpassword, $dbname);
if(!$conn){
    die("Connection failed: ".mysqli_connect_error());
}




// first medkit
$medkit_= "SELECT medkit_1 FROM users WHERE user_fullname = '$current_user'";
$result_ = mysqli_query($conn, $medkit_);
while($row = mysqli_fetch_assoc($result_)) {
    $medkit_actual_first = $row['medkit_1']; 
}

$sql1 = "SELECT `idmed`, `medname`, `expidate`, `quant` FROM  .$medkit_actual_first ";
$result = mysqli_query($conn, $sql1);


// second medkit
$medkit_2= "SELECT medkit_2 FROM users WHERE user_fullname = '$current_user'";
$result_2 = mysqli_query($conn, $medkit_2);
while($row = mysqli_fetch_assoc($result_2)) {
    $medkit_actual_second = $row['medkit_2']; 
}

$sql2 = "SELECT `idmed`, `medname`, `expidate`, `quant` FROM  .$medkit_actual_second ";
$result_22 = mysqli_query($conn, $sql2);


// third medkit
$medkit_3= "SELECT medkit_3 FROM users WHERE user_fullname = '$current_user'";
$result_3 = mysqli_query($conn, $medkit_3);
while($row = mysqli_fetch_assoc($result_3)) {
    $medkit_actual_third = $row['medkit_3']; 
}
$sql3 = "SELECT `idmed`, `medname`, `expidate`, `quant` FROM  .$medkit_actual_third ";
$result_33 = mysqli_query($conn, $sql3);




   
?>
<div id="contents_main">
   <?php
   echo 'Dzień dobry! Dziś jest:       '. date('Y-m-d')?> <br><br> 


<?php
   echo "Lekarstwa, które niebawem się przeterminują: "?> <br><br> 
   <?php


 //first medkit
  
  if (mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        $expiry_date=$row['expidate'];
        $me=$row['medname'];
        $current_date=date('Y-m-d');
        $expiry_date = strtotime($expiry_date);
        $current_date = strtotime($current_date);
        $days_to_expire =round(($expiry_date - $current_date ) / (60*60*24),0);
 
 
        if($days_to_expire > 0 && $days_to_expire <= 14){
          echo $medkit_actual_first. ": ".$me. " : ".$days_to_expire." dni zanim upłynie termin ważności"?> <br> <?php
        } 
        if ($days_to_expire <= 0){
            echo $medkit_actual_first. ": ".$me.     '<span style="color:red"> Przeterminowane!</span>'?> <br> <?php
    }
    }}


    // second medkit
    if (mysqli_num_rows($result_22) > 0){
        while($row = mysqli_fetch_assoc($result_22)){
            $expiry_date=$row['expidate'];
            $me=$row['medname'];
            $current_date=date('Y-m-d');
            $expiry_date = strtotime($expiry_date);
            $current_date = strtotime($current_date);
            $days_to_expire =round(($expiry_date - $current_date ) / (60*60*24),0);
     
     
            if($days_to_expire > 0 && $days_to_expire <= 14){
              echo $medkit_actual_second. ": ".$me. " : ".$days_to_expire." dni zanim upłynie termin ważności"?> <br> <?php
            } 
            if ($days_to_expire <= 0){
                echo $medkit_actual_second. ": ".$me.     '<span style="color:red"> Przeterminowane!</span>'?> <br> <?php
        }
        }}


        // third medkit

        if (mysqli_num_rows($result_33) > 0){
            while($row = mysqli_fetch_assoc($result_33)){
                $expiry_date=$row['expidate'];
                $me=$row['medname'];
                $current_date=date('Y-m-d');
                $expiry_date = strtotime($expiry_date);
                $current_date = strtotime($current_date);
                $days_to_expire =round(($expiry_date - $current_date ) / (60*60*24),0);
         
         
                if($days_to_expire > 0 && $days_to_expire <= 14){
                  echo $medkit_actual_third. ": ".$me. " : ".$days_to_expire." dni zanim upłynie termin ważności"?> <br> <?php
                } 
                if ($days_to_expire <= 0){
                    echo $medkit_actual_third. ": ".$me.     '<span style="color:red"> Przeterminowane!</span>'?> <br> <?php
            }
            }}


    

   ?>

</div>

    </body>
</html>

