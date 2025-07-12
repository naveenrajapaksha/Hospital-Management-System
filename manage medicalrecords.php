<?php
session_start();
include 'db_connect.php';

// Ensure user is logged in as Admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.php");
    exit();
}

// Fetch all medical records
$sql = "SELECT * FROM medical_records ORDER BY record_date ASC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Manage Medical Records</title>
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
.active { color: green; }
.inactive { color: red; }

/* Buttons */
button {
    padding: 8px 12px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.activate-btn { background: #2ecc71; color: white; }
.deactivate-btn { background: #e74c3c; color: white; }

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
        <h1>🩺 Manage Medical Records</h1>

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
                    <th>Doctor ID</th>
                    <th>Patient ID</th>
                    <th>Diagnosis</th>
                    <th>Prescription</th>
                    <th>Notes</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['doctor_id'] ?></td>
                        <td><?= $row['patient_id'] ?></td>
                        <td><?= htmlspecialchars($row['diagnosis']) ?></td>
                        <td><?= htmlspecialchars($row['prescription']) ?></td>
                        <td><?= htmlspecialchars($row['notes']) ?></td>
                        <td><?= $row['record_date'] ?></td>
                        <td class="<?= strtolower($row['status']) ?>"><?= $row['status'] ?></td>
                        <td>
                            <form action="update_medical_record_status.php" method="POST" style="display:inline;">
                                <input type="hidden" name="record_id" value="<?= $row['id'] ?>">
                                <input type="hidden" name="status" value="<?= ($row['status'] == 'Active') ? 'Inactive' : 'Active' ?>">
                                <button class="<?= ($row['status'] == 'Active') ? 'deactivate-btn' : 'activate-btn' ?>" type="submit">
                                    <?= ($row['status'] == 'Active') ? 'Deactivate' : 'Activate' ?>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
