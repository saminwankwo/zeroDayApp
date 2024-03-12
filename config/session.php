<?php 
session_start();
include 'core.php';


if(!isset($_SESSION['user']) || trim($_SESSION['user']) == ''){
    header('location:login.php');
}

try {
    $sql = "SELECT * FROM business WHERE bizId = '".$_SESSION['user']."' ";   
    $result = $conn->query($sql);

    $boss = $result->fetch();
    
} catch (PDOException $e) {
    $_SESSION['error'] = $e->getMessage();
    return header("location:login.php");
}

$BizName = $boss['companyName'];
$fullname = $boss['fullname'];

?>