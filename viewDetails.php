<?php
session_start();
include('config/session.php');
include('config/head.php');
include('config/navbar.php');


?>
 <!-- Main Content -->
 <div class="main-content">
		<section class="section">
		
<?php
if(isset($_GET['view'])){
    $id = $_GET['view'];
    $sql = $conn->query("SELECT * FROM websites WHERE webId = '$id'");
}
?>


<?php
include('config/dashfooter.php');
?>