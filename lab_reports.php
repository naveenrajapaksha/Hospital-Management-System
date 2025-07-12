<?php
session_start();
include 'db_connect.php';

// Ensure user is logged in as Doctor
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Doctor') {
    header("Location: login.php");
    exit();
}

$doctor_id = $_SESSION['user_id'];

// Handle File Upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['lab_report'])) {
    $patient_id = $_POST['patient_id'];
    $file_name = $_FILES['lab_report']['name'];
    $file_tmp = $_FILES['lab_report']['tmp_name'];
    $file_error = $_FILES['lab_report']['error'];
    $upload_dir = 'uploads/lab_reports/';

    // Create upload directory if not exists
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $file_path = $upload_dir . basename($file_name);

    if ($file_error === 0) {
        if (move_uploaded_file($file_tmp, $file_path)) {
            // Insert into database
            $sql = "INSERT INTO lab_reports (doctor_id, patient_id, file_name, file_path) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                die("SQL Error: " . $conn->error);
            }
            $stmt->bind_param("iiss", $doctor_id, $patient_id, $file_name, $file_path);
            
            if ($stmt->execute()) {
                $_SESSION['message'] = "Lab report uploaded successfully!";
            } else {
                $_SESSION['error'] = "Database entry failed: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $_SESSION['error'] = "File upload failed.";
        }
    } else {
        $_SESSION['error'] = "File upload error: " . $file_error;
    }

    header("Location: lab_reports.php");
    exit();
}

// Fetch Lab Reports for the logged-in doctor
$sql = "SELECT id, patient_id, file_name, file_path FROM lab_reports WHERE doctor_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $doctor_id);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab Reports | Hospital Management</title>
    <link rel="stylesheet" href="css/lab_reports.css">
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Welcome, <?= htmlspecialchars($_SESSION['full_name']) ?>!</h2>
        <a href="view_appointments.php"><button>View Appointments</button></a>
        <a href="Medical_records.php"><button>Medical Records</button></a>
        <a href="Lab_reports.php"><button>Lab Reports</button></a>
        <a href="view queries.php"><button>Answers for Queries</button></a>
        <a href="logout.php"><button>Log Out</button></a>
    </div>

    <!-- Main Content -->
    <div class="content">
    <img src="images/labreport.jpg" alt="Hospital Image" class="static-image">
        <h1>📑 Upload Lab Reports</h1>

        <?php if (isset($_SESSION['message'])): ?>
            <p class="message success"><?= $_SESSION['message'] ?></p>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <p class="message error"><?= $_SESSION['error'] ?></p>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <label for="patient_id">Patient ID:</label>
            <input type="number" name="patient_id" required>

            <label for="lab_report">Upload Lab Report (PDF only):</label>
            <input type="file" name="lab_report" accept="application/pdf" required>

            <button type="submit">Upload</button>
        </form>

        <h2>📂 Uploaded Lab Reports</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Patient ID</th>
                    <th>File Name</th>
                    <th>Download</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['patient_id'] ?></td>
                        <td><?= htmlspecialchars($row['file_name']) ?></td>
                        <td><a href="<?= htmlspecialchars($row['file_path']) ?>" target="_blank">Download</a></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
