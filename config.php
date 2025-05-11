<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sarzamin";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}




// $servername = '89.42.211.172'; 
// $username = 'vkwpsaop_admin'; 
// $password = 'k.YX4yxO(j7['; 
// $dbname = 'vkwpsaop_db'; 

// $cfg['Lang'] = 'fa';
// $cfg['Charset'] = 'utf8mb4';


// $conn = mysqli_connect($servername, $username, $password, $dbname);


// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// $conn->set_charset("utf8");
