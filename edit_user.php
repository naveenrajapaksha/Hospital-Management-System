<?php
session_start();
include 'db_connect.php';

// Ensure user is logged in as Admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.php");
    exit();
}

// Fetch user details if an ID is passed
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        $_SESSION['error'] = "User not found.";
        header("Location: manage_users.php");
        exit();
    }
} else {
    $_SESSION['error'] = "Invalid user ID.";
    header("Location: manage_users.php");
    exit();
}

// Handle form submission to update user
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Hash password if it's changed
    if (!empty($password)) {
        $password = password_hash($password, PASSWORD_DEFAULT);
    } else {
        $password = $user['password']; // keep the old password if not changed
    }

    $update_sql = "UPDATE users SET full_name = ?, email = ?, password = ?, role = ? WHERE id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("ssssi", $full_name, $email, $password, $role, $user_id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "User details updated successfully!";
        header("Location: manage_users.php");
        exit();
    } else {
        $_SESSION['error'] = "Error updating user details.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User | Admin</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color:rgb(154, 171, 175);
            margin: 0;
            padding: 0;
            display: flex;
        }

        .sidebar {
            width: 350px;
            height: 100vh;
            background-color: #1e3a56;
            color: white;
            padding: 20px;
            display: flex;
            flex-direction: column;
        }

        .sidebar h2 {
            font-size: 22px;
            margin-bottom: 20px;
            text-align: center;
        }

        .sidebar button {
            display: block;
            width: 100%;
            background-color: #004080;
            color: white;
            border: none;
            padding: 12px;
            margin: 10px 0;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
            transition: background 0.3s, transform 0.2s;
        }

        .sidebar button:hover {
            background-color: #0066cc;
            transform: scale(1.05);
        }

        .content {
            margin-left: 50px;
            padding: 20px;
            width: calc(100% - 270px);
        }

        h1 {
            font-size: 26px;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        form {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin: 10px 0;
            font-size: 16px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        button {
            background-color: #2ecc71;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #27ae60;
        }

        .message {
            color: green;
            font-size: 16px;
            font-weight: bold;
        }

        .error {
            color: red;
            font-size: 16px;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Welcome, <?= htmlspecialchars($_SESSION['full_name']) ?>!</h2>
        <a href="manage_appoinments.php"><button>Manage Appointments</button></a>
        <a href="manage_users.php"><button>Manage Users</button></a>
        <a href="manage_medicalrecords.php"><button>Manage Medical Records</button></a>
        <a href="manage_labreports.php"><button>Manage Lab Reports</button></a>
        <a href="monitor_feedback.php"><button>Monitor Feedback</button></a>
        <a href="logout.php"><button>Log Out</button></a>
    </div>

    <!-- Main Content -->
    <div class="content">
        <h1>✏️ Edit User</h1>

        <?php if (isset($_SESSION['message'])): ?>
            <p class="message"><?= $_SESSION['message'] ?></p>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <p class="error"><?= $_SESSION['error'] ?></p>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <form method="POST">
            <label for="full_name">Full Name:</label>
            <input type="text" name="full_name" id="full_name" value="<?= htmlspecialchars($user['full_name']) ?>" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?= htmlspecialchars($user['email']) ?>" required>

            <label for="password">Password (leave blank to keep current):</label>
            <input type="password" name="password" id="password">

            <label for="role">Role:</label>
            <select name="role" id="role" required>
                <option value="Admin" <?= $user['role'] == 'Admin' ? 'selected' : '' ?>>Admin</option>
                <option value="Patient" <?= $user['role'] == 'Patient' ? 'selected' : '' ?>>Patient</option>
            </select>

            <button type="submit">Update User</button>
        </form>
    </div>

</body>
</html>
