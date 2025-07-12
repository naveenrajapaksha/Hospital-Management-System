<?php
session_start();
include 'db_connect.php';

// Ensure user is logged in as Doctor
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Doctor') {
    header("Location: login.php");
    exit();
}

$doctor_id = $_SESSION['user_id'];

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $patient_id = $_POST['patient_id'];
    $diagnosis = $_POST['diagnosis'];
    $prescription = $_POST['prescription'];
    $notes = $_POST['notes'];

    $sql = "INSERT INTO medical_records (doctor_id, patient_id, diagnosis, prescription, notes) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisss", $doctor_id, $patient_id, $diagnosis, $prescription, $notes);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Medical record added successfully!";
    } else {
        $_SESSION['error'] = "Error: " . $stmt->error;
    }

    $stmt->close();
    header("Location: Medical_records.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor | Write Medical Records</title>
    <link rel="stylesheet" href="css/medical_records.css">
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
        <h1>📝 Write Medical Records</h1>

        <?php if (isset($_SESSION['message'])): ?>
            <p class="message success"><?= $_SESSION['message'] ?></p>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <p class="message error"><?= $_SESSION['error'] ?></p>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <form action="" method="POST">
            <label for="patient_id">Patient ID:</label>
            <input type="number" name="patient_id" required>

            <label for="diagnosis">Diagnosis:</label>
            <textarea name="diagnosis" required></textarea>

            <label for="prescription">Prescription:</label>
            <textarea name="prescription" required></textarea>

            <label for="notes">Additional Notes:</label>
            <textarea name="notes"></textarea>

            <button type="submit">Save Record</button>
        </form>
    </div>

</body>
</html>
