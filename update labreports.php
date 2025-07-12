<?php
session_start();
include 'db_connect.php';

// Ensure admin is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $record_id = $_POST['record_id'];
    $status = $_POST['status'];

    // Update medical record status
    $sql = "UPDATE lab_reports SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $record_id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Lab Report status updated successfully!";
    } else {
        $_SESSION['error'] = "Error updating status.";
    }

    $stmt->close();
    header("Location: manage_labreports.php");
    exit();
}
?>
