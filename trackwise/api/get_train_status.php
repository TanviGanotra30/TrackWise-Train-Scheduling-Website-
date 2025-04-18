<?php
header('Content-Type: application/json');
include 'db.php';

$trainNumber = $_GET['train'] ?? '';

if (empty($trainNumber)) {
    echo json_encode(["error" => "Train number required"]);
    exit;
}

$query = "SELECT t.train_number, t.train_name, s.station_name, 
          lp.delay_minutes, lp.status, lp.last_update
          FROM live_positions lp
          JOIN trains t ON lp.train_id = t.train_id
          JOIN stations s ON lp.station_id = s.station_id
          WHERE t.train_number = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param("s", $trainNumber);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode($result->fetch_assoc());
} else {
    echo json_encode(["error" => "Train not found"]);
}

$conn->close();
?>