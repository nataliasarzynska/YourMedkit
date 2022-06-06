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


    
    <div id = "menulog" >

    <?php

    session_unset();
    session_destroy();

    if (isset($_SESSION["current_user"])){
        echo "User is logged in:" .$_SESSION["current_user"];
    } else {
        echo "You were looged out.";
    }
    ?>

<br><br>
<a href = "./index.html"> Home page </a><br>
</div>

</body>
</html>