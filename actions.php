<?php
session_start();
// include 'config/core.php';

// redirection 
if(isset($_GET['return'])){
    $return = $_GET['return'];
} else {
    $return = 'index.php';
}

    if (isset($_POST['register'])) {
        echo 'test9jf';
        $_SESSION['error'] = "Incorrect Password, Please Try Again";
    } elseif (isset($_POST['application'])) {
        # code...
    } elseif (isset($_POST['login'])) {
        # code...
    } else {
        # code...
    }

// $conn = null;
header('location:' .$return);
?>