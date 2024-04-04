<?php
// Generate random traffic data
function generateRandomData() {
    $data = [];
    for ($i = 0; $i < 3; $i++) {
        $data[] = [
            'hour' => $i,
            'traffic' => rand(1, 2) // Random number for traffic
        ];
    }
    return $data;
}

// Return data as JSON
header('Content-Type: application/json');
echo json_encode(generateRandomData());

?>
