<?php
include 'db_connect.php';

header('Content-Type: application/json');

// Get appointment ID from the POST request
$data = json_decode(file_get_contents('php://input'), true);
$appointment_id = $data['appointment_id'];

// Prepare and execute the query to update appointment status to 'rejected'
$sql = "UPDATE appointments SET status = 'rejected' WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $appointment_id);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Appointment rejected successfully!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to reject appointment.']);
}

$stmt->close();
$conn->close();
?>
