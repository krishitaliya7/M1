<?php
// actions/fetch_atms.php
header('Content-Type: application/json');

// Normally you’d query DB:
$atms = [
    ['name' => 'QuantumBank Branch A', 'type' => 'Branch', 'lat' => 40.7128, 'lng' => -74.0060],
    ['name' => 'QuantumBank ATM B', 'type' => 'ATM', 'lat' => 40.7138, 'lng' => -74.0020],
];
echo json_encode($atms);
?>
