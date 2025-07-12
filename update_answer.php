<?php
session_start();
include 'db_connect.php';

// Ensure user is logged in as Doctor
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Doctor') {
    header("Location: login.php");
    exit();
}

// Check if form data is received
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $query_id = $_POST['query_id'];
    $answer = $_POST['answer'];

    // Update answer in database
    $sql = "UPDATE queries SET answer = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $answer, $query_id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Answer updated successfully!";
    } else {
        $_SESSION['error'] = "Failed to update the answer.";
    }

    $stmt->close();
    $conn->close();
    
    header("Location: view queries.php");
    exit();
}
?>
