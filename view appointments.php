<?php
session_start();
include 'db_connect.php'; // Database connection file

// Check if the doctor is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Doctor') {
    header("Location: login.php");
    exit();
}

$doctor_id = $_SESSION['user_id'];

// Fetch appointments for the logged-in doctor
$stmt = $conn->prepare("SELECT a.appointment_id, p.full_name AS patient_name, a.appointment_date, a.appointment_time, a.status, a.created_at 
                        FROM appointments a 
                        JOIN users p ON a.patient_id = p.id 
                        WHERE a.doctor_id = ? 
                        ORDER BY a.appointment_date DESC");
$stmt->bind_param("i", $doctor_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard - Appointments</title>
    <link rel="stylesheet" href="css/apointment.css">
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
<h2>Welcome, <?= htmlspecialchars($_SESSION['full_name']) ?>!</h2>
        <a href="view appointments.php"><button>View Appointments</button></a>
        <a href="Medical_records.php"><button>Medical Records</button></a>
        <a href="Lab_reports.php"><button>Lab Reports</button></a>
        <a href="view queries.php"><button>Answers for Queries</button></a>
        
        <a href="logout.php"><button>Log Out</button></a>
       
</div>

<!-- Main Content -->
<div class="content">
<div class="image-slider-container">
            <img src="images/appiontment.jpg" alt="Hospital Image" class="static-image">
        </div>
        <h1>📅 Your Appointments</h1>
<table border="10">
    <thead>
        <tr>
            <th>ID</th>
            <th>Patient</th>
            <th>Date</th>
            <th>Time</th>
            <th>Status</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['appointment_id'] ?></td>
                <td><?= htmlspecialchars($row['patient_name']) ?></td>
                <td><?= $row['appointment_date'] ?></td>
                <td><?= $row['appointment_time'] ?></td>
                <td class="<?= strtolower($row['status']) ?>"><?= $row['status'] ?></td>
                <td><?= $row['created_at'] ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

</body>
</html>
