<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>YourMedkit</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="stylelog.css" type="text/css" />
    </head>
    <body>
    <div id = "menulog" >
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

$medkit_name = "";

if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        if (empty($_POST["medkit_name"]))
        {
            $mknameErr = "Medkit name is required";
        }
        else{
            $medkit_name = chgw($_POST["medkit_name"]);
    }
}

$medkit_out = $medkit_name."_out";


$couser_1 = chgw($_POST["couser_1"]);
$couser_2 = chgw($_POST["couser_2"]);
$couser_3 = chgw($_POST["couser_3"]);
/* $couser_4 = chgw($_POST["couser_4"]);
$couser_5 = chgw($_POST["couser_5"]);*/

/*Current user*/

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


    if(is_null($medkit1))
    {
        $q_create = "CREATE TABLE .$medkit_name (idmed INT(10) NOT NULL AUTO_INCREMENT, medname VARCHAR(150), expidate DATE, quant INT(10), PRIMARY KEY (idmed))";
        $q_create_out = "CREATE TABLE .$medkit_out (Idout INT(10) NOT NULL AUTO_INCREMENT, user_id INT(10) UNSIGNED , idmed INT(10), quant INT(10), dateout DATE , PRIMARY KEY (Idout))";
        if (mysqli_query($dbconn,$q_create)) {
            echo "Stworzono tabelę główną";
            echo "<br>";
        } else {
            echo "Błąd tworzenia tabeli głównej";
            echo "<br>";
        }

        if (mysqli_query($dbconn,$q_create_out)) {
            echo "Utworzono tabelę zazyć";
            echo "<br>";
        } else {
            echo "Błąd tworzenia tabeli zazyć";
        }

        $q_rel1 = "ALTER TABLE $medkit_out ADD CONSTRAINT FOREIGN KEY (idmed) REFERENCES $medkit_name(idmed) ON DELETE CASCADE ON UPDATE CASCADE ";
        if (mysqli_query($dbconn,$q_rel1)) {
            echo "Ok";
            echo "<br>";
        } else {
            echo "";
        }

        $q_rel2 = "ALTER TABLE $medkit_out ADD CONSTRAINT FOREIGN KEY (user_id) REFERENCES `users`(user_id) ON DELETE CASCADE ON UPDATE CASCADE ";
        if (mysqli_query($dbconn,$q_rel2)) {
            echo "Ok druga relacja ";
            echo "<br>";
        } else {
            echo "";
        }



        $q_update = "UPDATE users
        SET medkit_1 = '$medkit_name'
        WHERE user_fullname = '$current_user'";

        mysqli_query($dbconn, $q_update) or die("Blad z updateowaniem"); 

        $q_update_cu1 = "UPDATE users
        SET mk1_couser_1 = '$couser_1'
        WHERE user_fullname = '$current_user'";

        $q_update_cu2 = "UPDATE users
        SET mk1_couser_2 = '$couser_2'
        WHERE user_fullname = '$current_user'";

        $q_update_cu3 = "UPDATE users
        SET mk1_couser_3 = '$couser_3'
        WHERE user_fullname = '$current_user'";

        /*$q_update_cu4 = "UPDATE users
        SET mk1_couser_4 = '$couser_4'
        WHERE user_fullname = '$current_user'";

        $q_update_cu5 = "UPDATE users
        SET mk1_couser_5 = '$couser_5'
        WHERE user_fullname = '$current_user'";*/


        mysqli_query($dbconn, $q_update_cu1) or die("Blad z updateowaniem"); 
        mysqli_query($dbconn, $q_update_cu2) or die("Blad z updateowaniem"); 
        mysqli_query($dbconn, $q_update_cu3) or die("Blad z updateowaniem"); 
        /*mysqli_query($dbconn, $q_update_cu4) or die("Blad z updateowaniem"); 
        mysqli_query($dbconn, $q_update_cu5) or die("Blad z updateowaniem"); */

        echo "Medkit was successfully created";
        echo "<br><br>";

    } elseif(is_null($medkit2)) {

        $q_create = "CREATE TABLE .$medkit_name (idmed INT(10) NOT NULL AUTO_INCREMENT, medname VARCHAR(150), expidate DATE, quant INT(10), PRIMARY KEY (idmed) )";
        $q_create_out = "CREATE TABLE .$medkit_out (Idout INT(10) NOT NULL AUTO_INCREMENT, user_id INT(10) UNSIGNED, idmed INT(10), quant INT(10),	dateout DATE, PRIMARY KEY (Idout) )";

        if (mysqli_query($dbconn,$q_create)) {
            echo "";
            echo "<br>";
        } else {
            
            echo "<br>";
        }

        if (mysqli_query($dbconn,$q_create_out)) {
            echo "";
            echo "<br>";
        } else {
            echo "";
        }

        $q_rel2 = "ALTER TABLE $medkit_out ADD CONSTRAINT FOREIGN KEY (idmed) REFERENCES $medkit_name(idmed) ON DELETE CASCADE ON UPDATE CASCADE ";
        if (mysqli_query($dbconn,$q_rel2)) {
            echo " ";
            echo "<br>";
        } else {
            echo "";
        }

        $q_rel22 = "ALTER TABLE $medkit_out ADD CONSTRAINT FOREIGN KEY (user_id) REFERENCES `users`(user_id) ON DELETE CASCADE ON UPDATE CASCADE ";
        if (mysqli_query($dbconn,$q_rel22)) {
            echo " k";
            echo "<br>";
        } else {
            echo "";
        }



        $q_update = "UPDATE users
        SET medkit_2 = '$medkit_name'
        WHERE user_fullname = '$current_user'";

        mysqli_query($dbconn, $q_update) or die("Blad z updateowaniem"); 

        $q_update_cu1 = "UPDATE users
        SET mk2_couser_1 = '$couser_1'
        WHERE user_fullname = '$current_user'";

        $q_update_cu2 = "UPDATE users
        SET mk2_couser_2 = '$couser_2'
        WHERE user_fullname = '$current_user'";

        $q_update_cu3 = "UPDATE users
        SET mk2_couser_3 = '$couser_3'
        WHERE user_fullname = '$current_user'";

        /*$q_update_cu4 = "UPDATE users
        SET mk2_couser_4 = '$couser_4'
        WHERE user_fullname = '$current_user'";

        $q_update_cu5 = "UPDATE users
        SET mk2_couser_5 = '$couser_5'
        WHERE user_fullname = '$current_user'";*/


        mysqli_query($dbconn, $q_update_cu1) or die("Blad z updateowaniem"); 
        mysqli_query($dbconn, $q_update_cu2) or die("Blad z updateowaniem"); 
        mysqli_query($dbconn, $q_update_cu3) or die("Blad z updateowaniem"); 
        /*mysqli_query($dbconn, $q_update_cu4) or die("Blad z updateowaniem"); 
        mysqli_query($dbconn, $q_update_cu5) or die("Blad z updateowaniem"); */

        echo "Medkit was successfully created";
        echo "<br><br>";


    } elseif(is_null($medkit3)) {

        $q_create = "CREATE TABLE .$medkit_name (idmed INT(10) NOT NULL AUTO_INCREMENT, medname VARCHAR(150), expidate DATE, quant INT(10), PRIMARY KEY (idmed) )";
        $q_create_out = "CREATE TABLE .$medkit_out (Idout INT(10) NOT NULL AUTO_INCREMENT, user_id INT(10) UNSIGNED, idmed INT(10), quant INT(10),	dateout DATE , PRIMARY KEY (Idout))";

        if (mysqli_query($dbconn,$q_create)) {
            echo "";
            echo "<br>";
        } else {
            echo "Błąd tworzenia tabeli";
            echo "<br>";
        }

        if (mysqli_query($dbconn,$q_create_out)) {
            echo "";
            echo "<br>";
        } else {
            echo "błąd";
        }

        $q_rel3 = "ALTER TABLE $medkit_out ADD CONSTRAINT FOREIGN KEY (idmed) REFERENCES $medkit_name(idmed) ON DELETE CASCADE ON UPDATE CASCADE ";
        if (mysqli_query($dbconn,$q_rel3)) {
            echo "Ok";
            echo "<br>";
        } else {
            echo "";
        }

        $q_rel33 = "ALTER TABLE $medkit_out ADD CONSTRAINT FOREIGN KEY (user_id) REFERENCES `users`(user_id) ON DELETE CASCADE ON UPDATE CASCADE ";
        if (mysqli_query($dbconn,$q_rel33)) {
            echo " Ok ";
            echo "<br>";
        } else {
            echo "";
        }

        $q_update = "UPDATE users
        SET medkit_3 = '$medkit_name'
        WHERE user_fullname = '$current_user'";

        mysqli_query($dbconn, $q_update) or die("Blad z updateowaniem"); 

        $q_update_cu1 = "UPDATE users
        SET mk3_couser_1 = '$couser_1'
        WHERE user_fullname = '$current_user'";

        $q_update_cu2 = "UPDATE users
        SET mk3_couser_2 = '$couser_2'
        WHERE user_fullname = '$current_user'";

        $q_update_cu3 = "UPDATE users
        SET mk3_couser_3 = '$couser_3'
        WHERE user_fullname = '$current_user'";

        /*$q_update_cu4 = "UPDATE users
        SET mk3_couser_4 = '$couser_4'
        WHERE user_fullname = '$current_user'";

        $q_update_cu5 = "UPDATE users
        SET mk3_couser_5 = '$couser_5'
        WHERE user_fullname = '$current_user'";*/


        mysqli_query($dbconn, $q_update_cu1) or die("Blad z updateowaniem"); 
        mysqli_query($dbconn, $q_update_cu2) or die("Blad z updateowaniem"); 
        mysqli_query($dbconn, $q_update_cu3) or die("Blad z updateowaniem"); 
        /*mysqli_query($dbconn, $q_update_cu4) or die("Blad z updateowaniem"); 
        mysqli_query($dbconn, $q_update_cu5) or die("Blad z updateowaniem"); */

        echo "Medkit was successfully created";
        echo "<br><br>";


    }
    else
    {
        echo "You can't have any more medkits";
    } 

/* Couser 1 */

    $qcu1_medkit1 = "SELECT medkit_1 FROM users WHERE user_fullname = '$couser_1'";
    $result1 = mysqli_query($dbconn, $qcu1_medkit1);

    if (mysqli_num_rows($result1)>0) {
        while($row = mysqli_fetch_assoc($result1)) {
            $cu1_medkit1 = $row["medkit_1"];
        } 
    }

    $qcu1_medkit2 = "SELECT medkit_2 FROM users WHERE user_fullname = '$couser_1'";
    $result2 = mysqli_query($dbconn, $qcu1_medkit2);

    if (mysqli_num_rows($result2)>0) {
        while($row = mysqli_fetch_assoc($result2)) {
            $cu1_medkit2 = $row["medkit_2"];
        } 
    }

    $qcu1_medkit3 = "SELECT medkit_3 FROM users WHERE user_fullname = '$couser_1'";
    $result3 = mysqli_query($dbconn, $qcu1_medkit3);

    if (mysqli_num_rows($result3)>0) {
        while($row3 = mysqli_fetch_assoc($result3)) {
            $cu1_medkit3 = $row3["medkit_3"];
        } 
    } 

    if(is_null($cu1_medkit1))
    {
        $q_cu1update = "UPDATE users
        SET medkit_1 = '$medkit_name'
        WHERE user_fullname = '$couser_1'";
    
        mysqli_query($dbconn, $q_cu1update) or die("Blad z updateowaniem"); 
    
        $q_cu1update_cu1 = "UPDATE users
        SET mk1_couser_1 = '$current_user'
        WHERE user_fullname = '$couser_1'";
    
        $q_cu1update_cu2 = "UPDATE users
        SET mk1_couser_2 = '$couser_2'
        WHERE user_fullname = '$couser_1'";
    
        $q_cu1update_cu3 = "UPDATE users
        SET mk1_couser_3 = '$couser_3'
        WHERE user_fullname = '$couser_1'";
    
        /*$q_cu1update_cu4 = "UPDATE users
        SET mk1_couser_4 = '$couser_4'
        WHERE user_fullname = '$couser_1'";
    
        $q_cu1update_cu5 = "UPDATE users
        SET mk1_couser_5 = '$couser_5'
        WHERE user_fullname = '$couser_1'";*/
    
        mysqli_query($dbconn, $q_cu1update_cu1) or die("Blad z updateowaniem"); 
        mysqli_query($dbconn, $q_cu1update_cu2) or die("Blad z updateowaniem"); 
        mysqli_query($dbconn, $q_cu1update_cu3) or die("Blad z updateowaniem"); 
       /* mysqli_query($dbconn, $q_cu1update_cu4) or die("Blad z updateowaniem"); 
        mysqli_query($dbconn, $q_cu1update_cu5) or die("Blad z updateowaniem"); */
    } 
    elseif(is_null($cu1_medkit2))
    {
        $q_cu1update = "UPDATE users
        SET medkit_2 = '$medkit_name'
        WHERE user_fullname = '$couser_1'";
    
        mysqli_query($dbconn, $q_cu1update) or die("Blad z updateowaniem"); 
    
        $q_cu1update_cu1 = "UPDATE users
        SET mk2_couser_1 = '$current_user'
        WHERE user_fullname = '$couser_1'";
    
        $q_cu1update_cu2 = "UPDATE users
        SET mk2_couser_2 = '$couser_2'
        WHERE user_fullname = '$couser_1'";
    
        $q_cu1update_cu3 = "UPDATE users
        SET mk2_couser_3 = '$couser_3'
        WHERE user_fullname = '$couser_1'";
    
       /* $q_cu1update_cu4 = "UPDATE users
        SET mk2_couser_4 = '$couser_4'
        WHERE user_fullname = '$couser_1'";
    
        $q_cu1update_cu5 = "UPDATE users
        SET mk2_couser_5 = '$couser_5'
        WHERE user_fullname = '$couser_1'";*/
    
        mysqli_query($dbconn, $q_cu1update_cu1) or die("Blad z updateowaniem"); 
        mysqli_query($dbconn, $q_cu1update_cu2) or die("Blad z updateowaniem"); 
        mysqli_query($dbconn, $q_cu1update_cu3) or die("Blad z updateowaniem"); 
        /*mysqli_query($dbconn, $q_cu1update_cu4) or die("Blad z updateowaniem"); 
        mysqli_query($dbconn, $q_cu1update_cu5) or die("Blad z updateowaniem"); */
    }
    elseif(is_null($cu1_medkit3))
    {
        $q_cu1update = "UPDATE users
        SET medkit_3 = '$medkit_name'
        WHERE user_fullname = '$couser_1'";
    
        mysqli_query($dbconn, $q_cu1update) or die("Blad z updateowaniem"); 
    
        $q_cu1update_cu1 = "UPDATE users
        SET mk3_couser_1 = '$current_user'
        WHERE user_fullname = '$couser_1'";
    
        $q_cu1update_cu2 = "UPDATE users
        SET mk3_couser_2 = '$couser_2'
        WHERE user_fullname = '$couser_1'";
    
        $q_cu1update_cu3 = "UPDATE users
        SET mk3_couser_3 = '$couser_3'
        WHERE user_fullname = '$couser_1'";
    
        /*$q_cu1update_cu4 = "UPDATE users
        SET mk3_couser_4 = '$couser_4'
        WHERE user_fullname = '$couser_1'";
    
        $q_cu1update_cu5 = "UPDATE users
        SET mk3_couser_5 = '$couser_5'
        WHERE user_fullname = '$couser_1'";*/
    
        mysqli_query($dbconn, $q_cu1update_cu1) or die("Blad z updateowaniem"); 
        mysqli_query($dbconn, $q_cu1update_cu2) or die("Blad z updateowaniem"); 
        mysqli_query($dbconn, $q_cu1update_cu3) or die("Blad z updateowaniem"); 
        /*mysqli_query($dbconn, $q_cu1update_cu4) or die("Blad z updateowaniem"); 
        mysqli_query($dbconn, $q_cu1update_cu5) or die("Blad z updateowaniem"); */
    }
    else
    {
        echo "<br><br>";
        echo "Failed to add couser " .$couser_1. ". User can't have any more medkits";
    }


/* Couser 2 */

    $qcu2_medkit1 = "SELECT medkit_1 FROM users WHERE user_fullname = '$couser_2'";
    $result1 = mysqli_query($dbconn, $qcu2_medkit1);

    if (mysqli_num_rows($result1)>0) {
        while($row = mysqli_fetch_assoc($result1)) {
            $cu2_medkit1 = $row["medkit_1"];
        } 
    }

    $qcu2_medkit2 = "SELECT medkit_2 FROM users WHERE user_fullname = '$couser_2'";
    $result2 = mysqli_query($dbconn, $qcu2_medkit2);

    if (mysqli_num_rows($result2)>0) {
        while($row = mysqli_fetch_assoc($result2)) {
            $cu2_medkit2 = $row["medkit_2"];
        } 
    }

    $qcu2_medkit3 = "SELECT medkit_3 FROM users WHERE user_fullname = '$couser_2'";
    $result3 = mysqli_query($dbconn, $qcu2_medkit3);

    if (mysqli_num_rows($result3)>0) {
        while($row3 = mysqli_fetch_assoc($result3)) {
            $cu2_medkit3 = $row3["medkit_3"];
        } 
    } 

    if(is_null($cu2_medkit1))
    {
        $q_cu2update = "UPDATE users
        SET medkit_1 = '$medkit_name'
        WHERE user_fullname = '$couser_2'";

        mysqli_query($dbconn, $q_cu2update) or die("Blad z updateowaniem"); 

        $q_cu2update_cu1 = "UPDATE users
        SET mk1_couser_1 = '$couser_1'
        WHERE user_fullname = '$couser_2'";

        $q_cu2update_cu2 = "UPDATE users
        SET mk1_couser_2 = '$current_user'
        WHERE user_fullname = '$couser_2'";

        $q_cu2update_cu3 = "UPDATE users
        SET mk1_couser_3 = '$couser_3'
        WHERE user_fullname = '$couser_2'";

        /*$q_cu2update_cu4 = "UPDATE users
        SET mk1_couser_4 = '$couser_4'
        WHERE user_fullname = '$couser_2'";

        $q_cu2update_cu5 = "UPDATE users
        SET mk1_couser_5 = '$couser_5'
        WHERE user_fullname = '$couser_2'";*/

        mysqli_query($dbconn, $q_cu2update_cu1) or die("Blad z updateowaniem"); 
        mysqli_query($dbconn, $q_cu2update_cu2) or die("Blad z updateowaniem"); 
        mysqli_query($dbconn, $q_cu2update_cu3) or die("Blad z updateowaniem"); 
        /*mysqli_query($dbconn, $q_cu2update_cu4) or die("Blad z updateowaniem"); 
        mysqli_query($dbconn, $q_cu2update_cu5) or die("Blad z updateowaniem");*/
    } 
    elseif(is_null($cu2_medkit2))
    {
        $q_cu2update = "UPDATE users
        SET medkit_2 = '$medkit_name'
        WHERE user_fullname = '$couser_2'";

        mysqli_query($dbconn, $q_cu2update) or die("Blad z updateowaniem"); 

        $q_cu2update_cu1 = "UPDATE users
        SET mk2_couser_1 = '$couser_1'
        WHERE user_fullname = '$couser_2'";

        $q_cu2update_cu2 = "UPDATE users
        SET mk2_couser_2 = '$current_user'
        WHERE user_fullname = '$couser_2'";

        $q_cu2update_cu3 = "UPDATE users
        SET mk2_couser_3 = '$couser_3'
        WHERE user_fullname = '$couser_2'";

        /*$q_cu2update_cu4 = "UPDATE users
        SET mk2_couser_4 = '$couser_4'
        WHERE user_fullname = '$couser_2'";

        $q_cu2update_cu5 = "UPDATE users
        SET mk2_couser_5 = '$couser_5'
        WHERE user_fullname = '$couser_2'";*/

        mysqli_query($dbconn, $q_cu2update_cu1) or die("Blad z updateowaniem"); 
        mysqli_query($dbconn, $q_cu2update_cu2) or die("Blad z updateowaniem"); 
        mysqli_query($dbconn, $q_cu2update_cu3) or die("Blad z updateowaniem"); 
        /*mysqli_query($dbconn, $q_cu2update_cu4) or die("Blad z updateowaniem"); 
        mysqli_query($dbconn, $q_cu2update_cu5) or die("Blad z updateowaniem"); */
    }
    elseif(is_null($cu2_medkit3))
    {
        $q_cu2update = "UPDATE users
        SET medkit_3 = '$medkit_name'
        WHERE user_fullname = '$couser_2'";

        mysqli_query($dbconn, $q_cu2update) or die("Blad z updateowaniem"); 

        $q_cu2update_cu1 = "UPDATE users
        SET mk3_couser_1 = '$couser_1'
        WHERE user_fullname = '$couser_2'";

        $q_cu2update_cu2 = "UPDATE users
        SET mk3_couser_2 = '$current_user'
        WHERE user_fullname = '$couser_1'";

        $q_cu2update_cu3 = "UPDATE users
        SET mk3_couser_3 = '$couser_3'
        WHERE user_fullname = '$couser_2'";

        /*$q_cu2update_cu4 = "UPDATE users
        SET mk3_couser_4 = '$couser_4'
        WHERE user_fullname = '$couser_2'";

        $q_cu2update_cu5 = "UPDATE users
        SET mk3_couser_5 = '$couser_5'
        WHERE user_fullname = '$couser_2'";*/

        mysqli_query($dbconn, $q_cu2update_cu1) or die("Blad z updateowaniem"); 
        mysqli_query($dbconn, $q_cu2update_cu2) or die("Blad z updateowaniem"); 
        mysqli_query($dbconn, $q_cu2update_cu3) or die("Blad z updateowaniem"); 
        /*mysqli_query($dbconn, $q_cu2update_cu4) or die("Blad z updateowaniem"); 
        mysqli_query($dbconn, $q_cu2update_cu5) or die("Blad z updateowaniem"); */
    }
    else
    {
        echo "<br><br>";
        echo "Failed to add couser " .$couser_2. ". User can't have any more medkits";
    }
/* Couser 3 */

    $qcu3_medkit1 = "SELECT medkit_1 FROM users WHERE user_fullname = '$couser_3'";
    $result1 = mysqli_query($dbconn, $qcu3_medkit1);

    if (mysqli_num_rows($result1)>0) {
        while($row = mysqli_fetch_assoc($result1)) {
            $cu3_medkit1 = $row["medkit_1"];
        } 
    }

    $qcu3_medkit2 = "SELECT medkit_2 FROM users WHERE user_fullname = '$couser_3'";
    $result2 = mysqli_query($dbconn, $qcu3_medkit2);

    if (mysqli_num_rows($result2)>0) {
        while($row = mysqli_fetch_assoc($result2)) {
            $cu3_medkit2 = $row["medkit_2"];
        } 
    }

    $qcu3_medkit3 = "SELECT medkit_3 FROM users WHERE user_fullname = '$couser_3'";
    $result3 = mysqli_query($dbconn, $qcu3_medkit3);

    if (mysqli_num_rows($result3)>0) {
        while($row3 = mysqli_fetch_assoc($result3)) {
            $cu3_medkit3 = $row3["medkit_3"];
        } 
    } 

    if(is_null($cu3_medkit1))
    {
        $q_cu3update = "UPDATE users
        SET medkit_1 = '$medkit_name'
        WHERE user_fullname = '$couser_3'";

        mysqli_query($dbconn, $q_cu3update) or die("Blad z updateowaniem cu3111"); 

        $q_cu3update_cu1 = "UPDATE users
        SET mk1_couser_1 = '$couser_1'
        WHERE user_fullname = '$couser_3'";

        $q_cu3update_cu2 = "UPDATE users
        SET mk1_couser_2 = '$couser_2'
        WHERE user_fullname = '$couser_3'";

        $q_cu3update_cu3 = "UPDATE users
        SET mk1_couser_3 = '$current_user'
        WHERE user_fullname = '$couser_3'";

        mysqli_query($dbconn, $q_cu3update_cu1) or die("Blad z updateowaniem cu31"); 
        mysqli_query($dbconn, $q_cu3update_cu2) or die("Blad z updateowaniem cu31"); 
        mysqli_query($dbconn, $q_cu3update_cu3) or die("Blad z updateowaniem cu31"); 

    } 
    elseif(is_null($cu3_medkit2))
    {
        $q_cu3update = "UPDATE users
        SET medkit_2 = '$medkit_name'
        WHERE user_fullname = '$couser_3'";

        mysqli_query($dbconn, $q_cu3update) or die("Blad z updateowaniem"); 

        $q_cu3update_cu1 = "UPDATE users
        SET mk2_couser_1 = '$couser_1'
        WHERE user_fullname = '$couser_3'";

        $q_cu3update_cu2 = "UPDATE users
        SET mk2_couser_2 = '$couser_2'
        WHERE user_fullname = '$couser_3'";

        $q_cu2update_cu3 = "UPDATE users
        SET mk2_couser_3 = '$current_user'
        WHERE user_fullname = '$couser_3'";

        mysqli_query($dbconn, $q_cu3update_cu1) or die("Blad z updateowaniem cu3"); 
        mysqli_query($dbconn, $q_cu3update_cu2) or die("Blad z updateowaniem cu3"); 
        mysqli_query($dbconn, $q_cu3update_cu3) or die("Blad z updateowaniem cu3"); 

    }
    elseif(is_null($cu3_medkit3))
    {
        $q_cu3update = "UPDATE users
        SET medkit_3 = '$medkit_name'
        WHERE user_fullname = '$couser_3'";

        mysqli_query($dbconn, $q_cu3update) or die("Blad z updateowaniem user 3"); 

        $q_cu3update_cu1 = "UPDATE users
        SET mk3_couser_1 = '$couser_1'
        WHERE user_fullname = '$couser_3'";

        $q_cu3update_cu2 = "UPDATE users
        SET mk3_couser_2 = '$couser_2'
        WHERE user_fullname = '$couser_3'";

        $q_cu3update_cu3 = "UPDATE users
        SET mk3_couser_3 = '$current_user'
        WHERE user_fullname = '$couser_3'";

        mysqli_query($dbconn, $q_cu3update_cu1) or die("Blad z updateowaniem cu3"); 
        mysqli_query($dbconn, $q_cu3update_cu2) or die("Blad z updateowaniem cu3"); 
        mysqli_query($dbconn, $q_cu3update_cu3) or die("Blad z updateowaniem cu3"); 

    }
    else
    {
        echo "<br>";
        echo "Failed to add couser " .$couser_1. ". User can't have any more medkits";
    }

?>

<br><br>
<a href = "./login.php"> Home</a>
<br><br>
<a href = "./logout.php"> Log out</a>
</div>
    </body>
</html>