<?php
header('Content-Type: application/json');
include 'db.php';

$pnr = $_GET['pnr'] ?? '';

if (empty($pnr)) {
    echo json_encode(["error" => "PNR number required"]);
    exit;
}

$query = "SELECT b.pnr_number, t.train_number, t.train_name,
          s1.station_name as from_station, s2.station_name as to_station,
          b.journey_date, b.coach_type, b.seat_number, b.booking_status
          FROM bookings b
          JOIN trains t ON b.train_id = t.train_id
          JOIN stations s1 ON b.from_station_id = s1.station_id
          JOIN stations s2 ON b.to_station_id = s2.station_id
          WHERE b.pnr_number = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param("s", $pnr);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode($result->fetch_assoc());
} else {
    echo json_encode(["error" => "PNR not found"]);
}

$conn->close();
?>