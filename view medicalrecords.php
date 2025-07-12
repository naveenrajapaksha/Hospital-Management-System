<?php
session_start();
include 'db_connect.php';

// Ensure user is logged in as a Patient
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Patient') {
    header("Location: login.php");
    exit();
}

$patient_id = $_SESSION['user_id'];

// Fetch medical records for the logged-in patient
$sql = "SELECT id, diagnosis, prescription, notes, record_date FROM medical_records WHERE patient_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $patient_id);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Medical Records | Hospital Management</title>
    <link rel="stylesheet" href="css/view medical_records.css">
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
    <h2>Welcome, <?= htmlspecialchars($_SESSION['full_name']) ?>!</h2>
   
        <a href="appointment.php"><button> Appointments</button></a>
        <a href="view medicalrecords.php"><button>Medical Records</button></a>
        <a href="view labreport.php"><button>Lab Reports</button></a>
        <a href="queries.php"><button>Queries</button></a>
        <a href="feedback.php"><button>Feedback</button></a>
        <a href="logout.php"><button>Log Out</button></a>
    </div>

    <!-- Main Content -->
    <div class="content">
    <img src="images/medicalrecord.jpg" alt="Hospital Image" class="static-image">
        <h1>📋 My Medical Records</h1>

        <?php if ($result->num_rows > 0): ?>
            <table border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Diagnosis</th>
                        <th>Prescription</th>
                        <th>Notes</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= htmlspecialchars($row['diagnosis']) ?></td>
                            <td><?= htmlspecialchars($row['prescription']) ?></td>
                            <td><?= htmlspecialchars($row['notes']) ?></td>
                            <td><?= $row['record_date'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No medical records available.</p>
        <?php endif; ?>
    </div>

</body>
</html>
