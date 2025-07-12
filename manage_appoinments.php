<?php
session_start();
include 'db_connect.php';

// Ensure user is logged in as Admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.php");
    exit();
}

// Fetch all appointments
$sql = "SELECT * FROM appointments ORDER BY created_at DESC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Manage Appointments</title>
    <link rel="stylesheet" >
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
    margin-left: 50px;
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
    padding: 12px;
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

/* Status Colors */
.pending { color: orange; }
.confirmed { color: green; }
.cancelled { color: red; }

/* Buttons */
button {
    padding: 8px 12px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.confirm-btn { background: #2ecc71; color: white; }
.cancel-btn { background: #e74c3c; color: white; }

    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
       
        <h2>Welcome, <?= htmlspecialchars($_SESSION['full_name']) ?>!</h2>
        <a href="manage_appoinments.php"><button>Manage Appointments</button></a>
        <a href="manage_users.php"><button>Manage Users</button></a>
        <a href="manage medicalrecords.php"><button>Manage Medical records</button></a>
        <a href="manage_labreports.php"><button>Manage Lab reports</button></a>
        <a href="monitor_feedback.php"><button>Monitor Feedback</button></a>
        <a href="logout.php"><button>Log Out</button></a>
    </div>

    <!-- Main Content -->
    <div class="content">
        <h1>📅 Manage Appointments</h1>

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
                    <th>Appointment ID</th>
                    <th>Patient ID</th>
                    <th>Doctor ID</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['appointment_id'] ?></td>
                        <td><?= $row['patient_id'] ?></td>
                        <td><?= $row['doctor_id'] ?></td>
                        <td><?= $row['appointment_date'] ?></td>
                        <td><?= $row['appointment_time'] ?></td>
                        <td class="<?= strtolower($row['status']) ?>"><?= $row['status'] ?></td>
                        <td>
                            <?php if ($row['status'] === 'Pending'): ?>
                                <form action="update_appointment_status.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="appointment_id" value="<?= $row['appointment_id'] ?>">
                                    <input type="hidden" name="status" value="Confirmed">
                                    <button class="confirm-btn" type="submit">OK</button>
                                </form>
                                <form action="update_appointment_status.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="appointment_id" value="<?= $row['appointment_id'] ?>">
                                    <input type="hidden" name="status" value="Cancelled">
                                    <button class="cancel-btn" type="submit">Cancel</button>
                                </form>
                            <?php else: ?>
                                <span class="status"><?= $row['status'] ?></span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
