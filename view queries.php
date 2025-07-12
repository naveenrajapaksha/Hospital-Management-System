<?php
session_start();

// Ensure user is logged in as Doctor
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Doctor') {
    header("Location: login.php");
    exit();
}

include 'db_connect.php';

$doctor_id = $_SESSION['user_id'];

// Fetch queries related to the logged-in doctor
$sql = "SELECT id, patient_id, question, answer FROM queries WHERE doctor_id = ?";
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
    <title>Doctor Queries | Hospital Management</title>
    <link rel="stylesheet" href="css/queries.css">
    <style>
        .message {
            color: red;
            font-weight: bold;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <!-- Sidebar Navigation -->
    <div class="sidebar">
    <h2>Welcome, <?= htmlspecialchars($_SESSION['full_name']) ?>!</h2>
    <a href="view appointments.php"><button>View Appointments</button></a>
        <a href="Medical_records.php"><button>Medical Records</button></a>
        <a href="view labreport.php"><button>Lab Reports</button></a>
        <a href="queries.php"><button>Answers for Queries</button></a>
        
        <a href="logout.php"><button>Log Out</button></a>
       
    </div>

    <!-- Main Content -->
    <div class="content">
    <img src="images/queries.jpg" alt="Hospital Image" class="static-image">
        <h1>❓ Patient Queries</h1>
        <!-- Display success/error messages -->
        <?php if (isset($_SESSION['message'])): ?>
            <p class="message"><?= $_SESSION['message'] ?></p>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <p class="message"><?= $_SESSION['error'] ?></p>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        <table border="10">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Patient ID</th>
                    <th>Question</th>
                    <th>Answer</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['patient_id'] ?></td>
                        <td><?= htmlspecialchars($row['question']) ?></td>
                        <td>
                            <form action="update_answer.php" method="POST">
                                <input type="hidden" name="query_id" value="<?= $row['id'] ?>">
                                <textarea name="answer" required><?= htmlspecialchars($row['answer']) ?></textarea>
                                <button type="submit">Save</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
