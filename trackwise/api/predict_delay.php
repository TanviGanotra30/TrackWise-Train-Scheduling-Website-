<?php
header('Content-Type: application/json');
include 'db.php';

$trainNumber = $_GET['train'] ?? '';

if (empty($trainNumber)) {
    echo json_encode(["error" => "Train number required"]);
    exit;
}

// Get average delay for this train
$query = "SELECT AVG(delay_minutes) as avg_delay 
          FROM live_positions lp
          JOIN trains t ON lp.train_id = t.train_id
          WHERE t.train_number = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param("s", $trainNumber);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

$predictedDelay = round($data['avg_delay'] ?? 0);

echo json_encode([
    "train_number" => $trainNumber,
    "predicted_delay" => $predictedDelay,
    "message" => $predictedDelay > 0 ? "Likely delayed by $predictedDelay minutes" : "On time expected"
]);

$conn->close();
?>