<?php
$timezone = 'Africa/lagos';
date_default_timezone_set($timezone);

if($_SERVER['HTTP_HOST'] == "localhost"){

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname ="zeroProject";

} else {

    $servername = "localhost";
    $username = "zerodayp_user";
    $password = "m+aer7h*b{jB";
    $dbname ="zerodayp_zerodayDb";
}

$dsn ="mysql:host=$servername;dbname=$dbname";

try {

    $conn = new PDO($dsn, $username, $password);

    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}

?>