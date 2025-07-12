<?php
session_start();
include 'db_connect.php'; // Make sure this file contains your database connection code.

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize user inputs
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);

    // Prepare the query to fetch user from the database based on email and role
    $stmt = $conn->prepare("SELECT id, full_name, password, role FROM users WHERE email = ? AND role = ?");
    $stmt->bind_param("ss", $email, $role);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a user exists with the given email and role
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        // Verify the password using password_verify function
        if (password_verify($password, $user['password'])) {
            // Store session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['role'] = $user['role'];

            // Return success message with user role
            echo json_encode(['status' => 'success', 'role' => $user['role']]);
        } else {
            // Invalid password
            echo json_encode(['status' => 'error', 'message' => 'Incorrect password!']);
        }
    } else {
        // Invalid email or role
        echo json_encode(['status' => 'error', 'message' => 'Invalid email or role selection!']);
    }

    // Close the prepared statement
    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method!']);
}
?>
