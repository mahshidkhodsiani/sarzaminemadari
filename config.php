<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sarzamin";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}




// $servername = '185.141.212.171'; 
// $username = 'adsbarg_admin'; 
// $password = 'HL(to{PCYL=b'; 
// $dbname = 'adsbarg_dashboard'; 

// $cfg['Lang'] = 'fa';
// $cfg['Charset'] = 'utf8mb4';


// $conn = mysqli_connect($servername, $username, $password, $dbname);


// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// $conn->set_charset("utf8");
