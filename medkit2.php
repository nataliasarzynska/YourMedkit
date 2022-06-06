<?php 
session_start();
if(!isset($_SESSION['current_user'])){
    header("Location:index.html");
 }

$servername = "";
$username = "";
$dbpassword = "";
$dbname = "";

$conn = mysqli_connect($servername, $username, $dbpassword, $dbname);
if(!$conn){
    die("Connection failed: ".mysqli_connect_error());
}
?>
 

<!DOCTYPE html>
<html>
    <head>
        <title>YourMedkit</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style.css" type="text/css" />
    </head>
    <body>  




<div id="sidebar"> 

  <div class="image-user">

    <img src="us.png" alt="user"><br> 
   </div>
    
   <div class="user">
    <?php
        if (isset($_SESSION["current_user"])){
          echo "Hello " .$_SESSION["current_user"]. " !";
          } else {
         echo "You are not logged in";
          }?>


    </div>

        <div class="optionL"><a href = "./login.php"> Home </a></div>
        <div class="optionL"><a href = "./medkitlist.php"> See your medkits </a></div>
        <div class="optionL"><a href = "./createmedkit.php"> Create new medkit</a></div>
        <div class="optionL"> <a href = "./addmeds.php"> Add new medcine</a></div>
        <div class="optionL"> <a href = "./logout.php"> Logout</a></div>
        <div class="optionL"> <a href = "./medkit.php"> Your medkit</a></div>

        </div>

<div id="contents_main">

<form action="./exportcsv2.php">
    <input type="submit" value="Export CSV" />
</form>

<br>


<table>
    <tr>
        <th>Medicine ID</th>
        <th>Name</th>
        <th>Expiration date</th>
        <th>Amount</th>
        <th>Take</th>
        <th>Utylize</th>
    </tr>

    <?php


$current_user = $_SESSION["current_user"];

$medkit_22 = "SELECT medkit_2 FROM users WHERE user_fullname = '$current_user'";
$result111 = mysqli_query($conn, $medkit_22);
while($row = mysqli_fetch_assoc($result111)) {
    $medkit_actual = $row['medkit_2']; 

}
$sql = "SELECT `idmed`, `medname`, `expidate`, `quant` FROM .$medkit_actual ";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        echo"<tr><td>".$row["idmed"]."</td><td>".$row["medname"]."</td><td>".$row["expidate"]."</td><td>".$row["quant"]."</td><td><a href='./intake.php?ajdi=".$row["idmed"]."&ile=".$row["quant"]."'>Take</a></td><td><a href='./utylize.php?ajdi=".$row["idmed"]."&ile=".$row["quant"]."'>Utylize</a></td></tr>";
    }
} else {
        echo "Your medkit is empty";
    }
    mysqli_close($conn);
    ?>
</table> 

</div>


</body>
</html>




