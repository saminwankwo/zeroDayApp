<?php
include 'config/core.php'; 

// advance dns
if (isset($_POST['app'])) {
    $id = htmlspecialchars($_POST['app']);
   
   $stmt = $conn->query("SELECT * FROM websites WHERE webId = '$id'");
   $row = $stmt->fetch(PDO::FETCH_ASSOC); 
   echo json_encode($row);

} elseif (isset($_POST['DNS'])) {

   $id = htmlspecialchars($_POST['DNS']);
   
   $stmt = $conn->query("SELECT * FROM webDNS WHERE webId = '$id'");
   $row = $stmt->fetch(PDO::FETCH_ASSOC); 
   echo json_encode($row);
}

?>