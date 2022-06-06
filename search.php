<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>YourMedkit</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style.css" type="text/css" />
    </head>
    <body>  


<?php

$servername = "";
$username = "";
$dbpassword = "";
$dbname = "";

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





<?php 
$current_user = $_SESSION["current_user"];
$conn = mysqli_connect($servername, $username, $dbpassword, $dbname);
if(!$conn){
die("Connection failed: ".mysqli_connect_error());
}

// first medkit name
$medkit_= "SELECT medkit_1 FROM users WHERE user_fullname = '$current_user'";
$result_ = mysqli_query($conn, $medkit_);
while($row = mysqli_fetch_assoc($result_)) {
    $medkit_actual_first = $row['medkit_1']; 
}

$sql1 = "SELECT `idmed`, `medname`, `expidate`, `quant` FROM  .$medkit_actual_first ";
$result = mysqli_query($conn, $sql1);

 
// second medkit name
$medkit_2= "SELECT medkit_2 FROM users WHERE user_fullname = '$current_user'";
$result_2 = mysqli_query($conn, $medkit_2);
while($row = mysqli_fetch_assoc($result_2)) {
    $medkit_actual_second = $row['medkit_2']; 
}

$sql2 = "SELECT `idmed`, `medname`, `expidate`, `quant` FROM  .$medkit_actual_second ";
$result_22 = mysqli_query($conn, $sql2);


// third medkit name
$medkit_3= "SELECT medkit_3 FROM users WHERE user_fullname = '$current_user'";
$result_3 = mysqli_query($conn, $medkit_3);
while($row = mysqli_fetch_assoc($result_3)) {
    $medkit_actual_third = $row['medkit_3']; 
}
$sql3 = "SELECT `idmed`, `medname`, `expidate`, `quant` FROM  .$medkit_actual_third ";
$result_33 = mysqli_query($conn, $sql3);

#first out medkit
$medkit1_out = $medkit_actual_first."_out";

#second out medkit
$medkit2_out = $medkit_actual_second."_out";

#thirf out medkit
$medkit3_out = $medkit_actual_third."_out";
?>
<div id="contents_main">

<form method="post" action="search.php">
   <div>
      <label> Intakes on day (YY-MM-DD): </label>
      <input type="date" name="date_from" value="<?php echo date('Y-m-d'); ?>"  />
   </div>
   <button type="submit" name="szukaj">Search</button>
</form>
<br> <br>


<?php


$date = $_POST["date_from"];

echo "<table border=1><tr><th> Osoba zażywająca </th> <th> Zażyty lek </th> <th> Ilość </th> <th> Data zażycia </th></tr>";

$sql_ = "SELECT users.user_fullname, .$medkit_actual_second.medname, .$medkit2_out.quant, .$medkit2_out.dateout FROM (( .$medkit2_out INNER JOIN users ON .$medkit2_out.user_id = users.user_id) INNER JOIN .$medkit_actual_second ON .$medkit2_out.Idout = .$medkit_actual_second.idmed) WHERE dateout LIKE '{$date}%'  ";

$result1 = mysqli_query($conn, $sql_);

if(mysqli_num_rows($result1) > 0){
    while ($row = mysqli_fetch_assoc($result1)){

        echo "<tr><td>".$row["user_fullname"]."</td><td>".$row["medname"]."</td><td>".$row["quant"]."</td><td>".$row["dateout"]."</td></tr>";
    }
} 


$sql_11 = "SELECT  users.user_fullname, .$medkit_actual_first.medname, .$medkit1_out.quant, .$medkit1_out.dateout FROM (( .$medkit1_out INNER JOIN users ON .$medkit1_out.user_id = users.user_id) INNER JOIN .$medkit_actual_first ON .$medkit1_out.Idout = .$medkit_actual_first.idmed) WHERE dateout LIKE '{$date}%'  ";

$result_11 = mysqli_query($conn, $sql_11);

if(mysqli_num_rows($result_11) > 0){
    while ($row = mysqli_fetch_assoc($result_11)){

        echo "<tr><td>".$row["user_fullname"]."</td><td>".$row["medname"]."</td><td>".$row["quant"]."</td><td>".$row["dateout"]."</td></tr>";
    }
} 



$sql_33 = "SELECT  users.user_fullname, .$medkit_actual_third.medname, .$medkit3_out.quant, .$medkit3_out.dateout FROM (( .$medkit3_out INNER JOIN users ON .$medkit3_out.user_id = users.user_id) INNER JOIN .$medkit_actual_third ON .$medkit3_out.Idout = .$medkit_actual_third.idmed) WHERE dateout LIKE '{$date}%'  ";

$result_33 = mysqli_query($conn, $sql_33);

if(mysqli_num_rows($result_33) > 0){
    while ($row = mysqli_fetch_assoc($result_33)){

        echo "<tr><td>".$row["user_fullname"]."</td><td>".$row["medname"]."</td><td>".$row["quant"]."</td><td>".$row["dateout"]."</td></tr>";
    }
} 

mysqli_close($conn);
echo "</table>";



?>

</div>

</body>
</html>

