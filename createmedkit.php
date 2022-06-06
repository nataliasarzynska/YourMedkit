<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Create medkit</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style.css" type="text/css" />
    </head>
    <body>

    <div id="addmedkit">

    <form method="POST" action ="newmedkit.php">
        Medkit name: <br>
            <input type = "text" name = "medkit_name"><br>
            <br>
        Add cousers: <br>
        <input type = "text" name = "couser_1" placeholder = "Nazwa uzytkownika"><br>
            <br>
            <input type = "text" name = "couser_2" placeholder = "Nazwa uzytkownika"><br>
            <br>
            <input type = "text" name = "couser_3" placeholder = "Nazwa uzytkownika"><br>
            <br>
            <!-- <input type = "text" name = "couser_4"placeholder = "Nazwa uzytkownika"><br>
            <br>
            <input type = "text" name = "couser_5"placeholder = "Nazwa uzytkownika"><br>
            <br> -->
            <input type = "submit" name = "submit" value = "Dodaj apteczkę">

            <br><br>
    <a href = "./login.php">Home</a>
    <a href = "./medkitlist.php">See your medkits</a>

</div>


    </body>

</html>