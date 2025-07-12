<?php
session_start();
include 'db_connect.php';

// Check if the user is logged in and has the doctor role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'doctor') {
    header("Location: login.html");
    exit();
}

// Get the submitted available time from the form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $doctor_id = $_SESSION['user_id'];
    $available_time = $_POST['available_time'];

    // Prepare and execute the query to insert the available time into the database
    $sql = "INSERT INTO doctor_schedule (doctor_id, available_time) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $doctor_id, $available_time);

    if ($stmt->execute()) {
        echo "Schedule updated successfully!";
    } else {
        echo "Error updating schedule: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
