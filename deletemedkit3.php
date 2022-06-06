<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Delete</title>
        <meta charset="UTF-8">
    </head>
    <body>  
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

    function chgw($dane)
    {
        $dane = trim($dane);
        $dane = stripslashes($dane);
        $dane = htmlspecialchars($dane);
        return $dane;
    }

    $current_user = $_SESSION["current_user"];

    $q_medkit1 = "SELECT medkit_3 FROM users WHERE user_fullname = '$current_user'";
    $result1 = mysqli_query($dbconn, $q_medkit1);

    if (mysqli_num_rows($result1)>0) {
        while($row = mysqli_fetch_assoc($result1)) {
            $medkit1 = $row["medkit_3"];

        } 
    }


    $q_drop = "DROP TABLE $medkit3";
    echo "$q_drop";
    mysqli_query($dbconn, $q_drop);

    echo "Medkit " .$medkit3. " was deleted successfully";

        ?>

<br><br>
<a href = "./medkitlist.php"> See your medkits </a>
<br><br>
<a href = "./logout.php"> Log out</a>

    </body>
</html>