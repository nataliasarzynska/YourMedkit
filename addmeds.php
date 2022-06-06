<?php
session_start();
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style.css" type="text/css" />

        <title> Add new medicine</title>
</head>

<body>

<?php
$servername = "";
$username = "";
$dbpassword = "";
$dbname = "";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}

$current_user = $_SESSION["current_user"];

$medkit_22 = "SELECT `medkit_1`, `medkit_2`, `medkit_3` FROM `users` WHERE user_fullname = '$current_user'";
$result111 = mysqli_query($conn, $medkit_22);
while($row = mysqli_fetch_assoc($result111)) {
    $medkit_first = $row['medkit_1']; 
    $medkit_second = $row['medkit_2']; 
    $medkit_third = $row['medkit_3'];

}
?>

    <div id="addmed">
     

    <form method="POST" action ="newmed.php">
        <label for="wh_medkit"> Choose medkit: </label>
        <select name = 'wh_medkit'>

	        <option value="<?= $medkit_first ?>"><?= $medkit_first ?></option>
	        <option value="<?= $medkit_second?>"><?= $medkit_second ?></option>
	        <option value="<?= $medkit_third ?>"><?= $medkit_third ?></option>
            </select>
        <br>
        <label for="medsopt">Choose medicine:</label>
        <select name='medsopt'>
        <option value=""></option>

            <?php
            $options=nl2br(file_get_contents("meds.txt"));
            $options=explode("\n",$options);
            
            $options = preg_replace('#(( ){0,}<br( {0,})(/{0,1})>){1,}$#i', '', $options);


            for($i=0;$i<count(($options));$i++)
                 {
             echo "<option value='".$options[$i]."'>".$options[$i]."</option>";
              }
            ?>
         </select>


         <br> <label for="quantmed">Amount:</label>
            <input type = "number" name = "quantmed" placeholder = "Amount"><br>
            <label for="quantmed">Expiration date:</label>
            <input type = "date" name = "expdate" placeholder = "Expiration date YY-MM-DD"><br>
            <br>
            <input type = "submit" name = "submit" value = "Add">
</form>
<br><br><br><br>
<a href = "./login.php"> Home</a>
<a href = "./createmedkit.php"> Create new medkit</a>
<a href = "./addmeds.php"> Add new medicine</a>
    </div>
  <?php  
   if (isset($_POST['Add'])) {
      $which_medkit = $_POST['wh_medkit'];
  }


?>


</body>
</html>