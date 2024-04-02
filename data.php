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

} elseif (isset($_POST['result'])) {
   $id = $_POST['result'];

   
   // $jsonData = $_POST['result'];
   // $resultObject = json_decode($jsonData, true); // Decode into associative array (optional)
   
   // echo json_encode("Parsed object property (example): " . $resultObject['propertyName']." ");
    // Now you can access the properties of the $resultObject like any PHP object;
   //  echo "Parsed object property (example): " . $resultObject['propertyName'];
   echo json_encode($id);
}

?>