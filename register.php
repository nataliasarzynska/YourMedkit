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
    Domowa apteczka
</div>
</div>

<div id ="menulog">

        <form method="POST" action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type = "text" name = "name" placeholder = "Name"> <?php echo $imErr; ?><br> 
            <input type = "email" name = "email" placeholder = "E-mail"> <?php echo $mailErr; ?> <br>
            <input type = "password" name = "password" placeholder = "Password"> <?php echo $passErr; ?><br>
            <br>
            <input type = "submit" name = "submit" value = "Zarejestruj">
           
</form>

<?php

$user_fullname = $user_email = $user_password = $currentname = $currentemail ="";

function chgw($dane)
{
    $dane = trim($dane);
    $dane = stripslashes($dane);
    $dane = htmlspecialchars($dane);
    return $dane;
}

$servername = "";
$username = "";
$dbpassword = "";
$dbname = "";;

$dbconn = mysqli_connect($servername, $username, $dbpassword, $dbname);


    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
    
        $currentname = $_POST["name"];
        $q_freename = "SELECT user_fullname FROM users WHERE user_fullname='$currentname'";
        $r_freename = mysqli_query($dbconn,$q_freename)or die("Error");

        $currentemail = $_POST["email"];
        $q_freemail = "SELECT user_email FROM users WHERE user_email='$currentemail'";
        $r_freemail = mysqli_query($dbconn,$q_freemail)or die("Error");

        if (empty($_POST["name"]))
        {
            $imErr = "Choose a username <br/>";
        }
        elseif (mysqli_num_rows($r_freename) > 0){
            $freeimErr = "Current username is already taken";
        }
        else{
            $name = chgw($_POST["name"]);
        }
        if (empty($_POST["email"]))
        {
            $mailErr = "Enter email";
        }
        elseif (mysqli_num_rows($r_freemail) > 0){
            $freemailErr = "Account with this email adress already exists";
        }
        else{
            $email = chgw($_POST["email"]);
        }
        if (empty($_POST["password"]))
        {
            $passErr = "Enter password!";
        }
        else{
            $password = chgw($_POST["password"]);
        }
    }

    $user_fullname = mysqli_real_escape_string($dbconn, $name);
    $user_email = mysqli_real_escape_string($dbconn, $email);
    $user_password = mysqli_real_escape_string($dbconn, $password);

    $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);

    if((isset($name) and isset($password)) and isset($email)){
        mysqli_query($dbconn, "INSERT INTO users (user_fullname, user_email, user_passwordhash)
         VALUES ('$user_fullname', '$user_email', '$user_password_hash')");
        echo "You were registered successfully <br/><br/>";
    } else {
        echo "<br>" .$imErr. " " .$mailErr. " " .$passErr. " " .$freeimErr. " ".$freemailErr. " ";
    }
?>

<hr style="width: 20%;">

Already have an account? <a href = "./loginform.php"> Log in</a><br>
</div>

    </body>
</html>