<?php
session_start()
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Intake</title>
        <link rel="stylesheet" href="stylelog.css" type="text/css" />
        <meta charset="UTF-8">
    </head>
    <body>  

<div id="menulog">
<form method="POST" action="./take2.php">
    <input type = "number" name = "medid" value="<?php echo $_GET['ajdi']; ?>"><br>
    <input type = "number" name = "medqu" min="0" max="<?php echo $_GET['ile']; ?>" placeholder="Ilość"><br>
    <input type = "submit" name = "submit" value = "Take">

</form>
</div>
</body>
</html>