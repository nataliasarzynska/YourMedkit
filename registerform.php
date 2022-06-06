<!DOCTYPE html>
<html>
    <head>
        <title>Rejestracja</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="stylelog.css" type="text/css" />
        <link rel="preconnect" href="https://fonts.googleapis.com"> 
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
        <link href="https://fonts.googleapis.com/css2?family=Spectral:wght@200&display=swap" rel="stylesheet">
    </head>
    <body>

    <div id = "container">

<div id = "topbar">
    YourMedkit
</div>
</div>

<div id ="menulog">

        <form method="POST" action ="register.php">
            <input type = "text" name = "name" placeholder = "Username"><br>
            <input type = "email" name = "email" placeholder = "E-mail"><br>
            <input type = "password" name = "password" placeholder = "Password"><br>
            <br>
            <input type = "submit" name = "submit" value = "Register">


           
</form>
Already have an account? <a href = "./loginform.php"> Log in </a><br>
</div>

    </body>
</html>