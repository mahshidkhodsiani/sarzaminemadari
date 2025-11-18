<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sarzamin";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}




// $servername = '89.32.250.180'; 
// $username = 'litpupyo_admin'; 
// $password = 'V6YT?tbR%[FO'; 
// $dbname = 'litpupyo_sarzamin'; 

// $cfg['Lang'] = 'fa';
// $cfg['Charset'] = 'utf8mb4';


// $conn = mysqli_connect($servername, $username, $password, $dbname);


// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// $conn->set_charset("utf8");
