<?php
header('Content-Type: application/json');
include 'db.php';

$data = json_decode(file_get_contents('php://input'), true);

// Validate input
if (empty($data['train_number']) || empty($data['from_station']) || empty($data['to_station'])) {
    echo json_encode(["error" => "Missing required fields"]);
    exit;
}

// Generate PNR
$pnrNumber = strtoupper(substr(md5(uniqid()), 0, 6));

// Insert booking
$query = "INSERT INTO bookings (user_id, train_id, pnr_number, journey_date, from_station_id, to_station_id, coach_type, booking_status)
          SELECT ?, t.train_id, ?, ?, s1.station_id, s2.station_id, ?, 'Confirmed'
          FROM trains t, stations s1, stations s2
          WHERE t.train_number = ? 
          AND s1.station_code = ?
          AND s2.station_code = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param("issssss", 
    $data['user_id'], 
    $pnrNumber, 
    $data['journey_date'], 
    $data['coach_type'], 
    $data['train_number'], 
    $data['from_station'], 
    $data['to_station']
);

if ($stmt->execute()) {
    echo json_encode([
        "success" => true,
        "pnr_number" => $pnrNumber,
        "message" => "Booking confirmed!"
    ]);
} else {
    echo json_encode(["error" => "Booking failed: " . $conn->error]);
}

$conn->close();
?>