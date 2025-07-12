<?php
session_start();
include 'db_connect.php';

// Ensure user is logged in as Admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.php");
    exit();
}

// Fetch all users
$sql = "SELECT * FROM users ORDER BY full_name ASC";
$result = $conn->query($sql);

// Delete user if requested
if (isset($_GET['delete'])) {
    $user_id = $_GET['delete'];
    $delete_sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $user_id);
    if ($stmt->execute()) {
        $_SESSION['message'] = "User deleted successfully!";
    } else {
        $_SESSION['error'] = "Error deleting user.";
    }
    header("Location: manage_users.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Manage Users</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* General Page Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            background-color: #f4f4f9;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 350px;
            height: 250vh;
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

        /* Main Content Styling */
        .content {
            margin-left: 0px;
            padding: 20px;
            width: calc(100% - 270px);
        }

        h1 {
            font-size: 26px;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #2c3e50;
            color: white;
        }

        tr:hover {
            background: #f1f1f1;
        }

        /* Buttons */
        button {
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .edit-btn { background: #f39c12; color: white; }
        .delete-btn { background: #e74c3c; color: white; }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Welcome, <?= htmlspecialchars($_SESSION['full_name']) ?>!</h2>
        <a href="manage_appoinments.php"><button>Manage Appointments</button></a>
        <a href="manage_users.php"><button>Manage Users</button></a>
        <a href="manage medicalrecords.php"><button>Manage Medical Records</button></a>
        <a href="manage_labreports.php"><button>Manage Lab Reports</button></a>
        <a href="monitor_feedback.php"><button>Monitor Feedback</button></a>
        <a href="logout.php"><button>Log Out</button></a>
    </div>

    <!-- Main Content -->
    <div class="content">
        <h1>👥 Manage Users</h1>

        <?php if (isset($_SESSION['message'])): ?>
            <p class="message success"><?= $_SESSION['message'] ?></p>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <p class="message error"><?= $_SESSION['error'] ?></p>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['full_name']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= htmlspecialchars($row['password']) ?></td>
                        <td><?= htmlspecialchars($row['role']) ?></td>
                        <td>
                            <a href="edit_user.php?id=<?= $row['id'] ?>"><button class="edit-btn">Edit</button></a>
                            <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this user?')"><button class="delete-btn">Delete</button></a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
