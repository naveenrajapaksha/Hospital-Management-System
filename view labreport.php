<?php
session_start();
include 'db_connect.php';

// Ensure user is logged in as a Patient
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Patient') {
    header("Location: login.php");
    exit();
}

$patient_id = $_SESSION['user_id'];

// Fetch Lab Reports for the logged-in Patient
$sql = "SELECT id, file_name, file_path, upload_date FROM lab_reports WHERE patient_id = ?";
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
    <title>My Lab Reports | Hospital Management</title>
    <link rel="stylesheet" href="css/customer_lab_reports.css">
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
    <img src="images/labreport.jpg" alt="Hospital Image" class="static-image">
        <h1>📄 My Lab Reports</h1>

        <?php if ($result->num_rows > 0): ?>
            <table border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>File Name</th>
                        <th>Upload Date</th>
                        <th>Download</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= htmlspecialchars($row['file_name']) ?></td>
                            <td><?= $row['upload_date'] ?></td>
                            <td><a href="<?= htmlspecialchars($row['file_path']) ?>" target="_blank">Download PDF</a></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No lab reports available.</p>
        <?php endif; ?>
    </div>

</body>
</html>
