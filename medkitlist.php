<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Twoje apteczki</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style.css" type="text/css" />
    </head>
    <body>
    <div id="showmedkit">
<?php
 

    $servername = "";
    $username = "";
    $dbpassword = "";
    $dbname = "";

    $dbconn = mysqli_connect($servername, $username, $dbpassword, $dbname);
        
    if (!$dbconn)
    {
        die("Connection failed: ".mysqli_connect_error());
    }

    $current_user = $_SESSION["current_user"];


    $q_medkit1 = "SELECT medkit_1 FROM users WHERE user_fullname = '$current_user'";
    $result1 = mysqli_query($dbconn, $q_medkit1);

    if (mysqli_num_rows($result1)>0) {
        while($row = mysqli_fetch_assoc($result1)) {
            $medkit1 = $row["medkit_1"];

        } 
    }
    

    $q_medkit2 = "SELECT medkit_2 FROM users WHERE user_fullname = '$current_user'";
    $result2 = mysqli_query($dbconn, $q_medkit2);

    if (mysqli_num_rows($result2)>0) {
        while($row2 = mysqli_fetch_assoc($result2)) {
            $medkit2 = $row2["medkit_2"];
        } 
    } 

    $q_medkit3 = "SELECT medkit_3 FROM users WHERE user_fullname = '$current_user'";
    $result3 = mysqli_query($dbconn, $q_medkit3);

    if (mysqli_num_rows($result3)>0) {
        while($row3 = mysqli_fetch_assoc($result3)) {
            $medkit3 = $row3["medkit_3"];
        } 
    } 

    if(isset($medkit1)){
        echo "$medkit1 ";
        echo '<a href = "./medkit1.php"> See</a>';
        echo '<a href = "./deletemedkit1.php"> Delete </a>';
    }

    if(isset($medkit2)){
        echo "<br><br>";
        echo "$medkit2 ";
        echo '<a href = "./medkit2.php"> See</a>';
        echo '<a href = "./deletemedkit2.php"> Delete </a>';
    }

    if(isset($medkit3)){
        echo "<br><br>";
        echo "$medkit3 ";
        echo '<a href = "./medkit3.php"> See</a>';
        echo '<a href = "./deletemedkit3.php"> Delete </a>';
    }

    if((is_null($medkit1) and is_null($medkit2)) and is_null($medkit3))
    {
        echo "You don't have any medkits.";
        echo "<br>";
        echo '<a href = "./createmedkit.php"> Create one! </a>';
    }
?>
    <br><br><br><br>
<a href = "./login.php">Home</a>
<br>
<a href = "./createmedkit.php"> Create medkit</a>
<a href = "./addmeds.php"> Add new medicne</a>
</div>


    </body>
</html>