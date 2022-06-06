<?php
session_start();
?>

<?php
$servername = "";
$username = "";
$dbpassword = "";
$dbname = "";

$dbconn = mysqli_connect($servername, $username, $dbpassword, $dbname);
if(!$dbconn){
    die("Connection failed: ".mysqli_connect_error());
}


$current_user = $_SESSION["current_user"];



$medkit_22 = "SELECT medkit_1 FROM users WHERE user_fullname = '$current_user'";
$result111 = mysqli_query($dbconn, $medkit_22);
while($row = mysqli_fetch_assoc($result111)) {
    $medkit_actual = $row['medkit_1']; 

}
$sql = "SELECT `idmed`, `medname`, `expidate`, `quant` FROM .$medkit_actual ";
$result = mysqli_query($dbconn, $sql);


$query = $dbconn->query("SELECT * FROM $medkit_actual"); 

if($query->num_rows > 0){ 
    $delimiter = ","; 
    $filename = "medkit.csv"; 
     
    // Create a file pointer 
    $f = fopen('php://memory', 'w'); 
     
    // Set column headers 
    $fields = array(`ID leku`, `Nazwa`, `Data wazności`, `Ilość`); 
    fputcsv($f, $fields, $delimiter); 
    
    // Output each row of the data, format line as csv and write to file pointer 
    while($row = $query->fetch_assoc()){ 
        $lineData = array($row['idmed'], $row['medname'], $row['expidate'], $row['quant']); 
        fputcsv($f, $lineData, $delimiter); 
    } 
     
    // Move back to beginning of file 
    fseek($f, 0); 
     
    // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
     
    //output all remaining data on a file pointer 
    fpassthru($f); 
} 
    ?>

