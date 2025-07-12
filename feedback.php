<?php
session_start();

// Ensure user is logged in as Patient
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Patient') {
    header("Location: login.php");
    exit();
}

include 'db_connect.php';

// Fetch available doctors for the dropdown list
$doctorQuery = "SELECT id, full_name FROM users WHERE role = 'Doctor'";
$doctorResult = $conn->query($doctorQuery);

// Handle form submission and save patient question
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['question_submit'])) {
    $patient_id = $_SESSION['user_id'];
    $doctor_id = $_POST['doctor_id'];
    $question = trim($_POST['question']); // Sanitize input

    if (!empty($question)) {
        // Insert the question into the database
        $sql = "INSERT INTO feedback(patient_id, doctor_id,feedback) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis", $patient_id, $doctor_id, $question);

        if ($stmt->execute()) {
            $message = "✅ Your feedback has been submitted successfully!";
        } else {
            $message = "❌ Error submitting your feedback. Please try again.";
        }
        $stmt->close();
    } else {
        $message = "⚠️ Question field cannot be empty.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Questions | Hospital Management</title>
    <link rel="stylesheet" href="css/feedback.css">
</head>
<body>

    <!-- Sidebar Navigation -->
    <div class="sidebar">
        <h2>Welcome, <?= htmlspecialchars($_SESSION['full_name']) ?>!</h2>
        <a href="appointment.php"><button>Appointments</button></a>
        <a href="Medical_records.php"><button>Medical Records</button></a>
        <a href="Lab_reports.php"><button>Lab Reports</button></a>
        <a href="queries.php"><button>Queries</button></a>
        <a href="feedback.php"><button>Feedback</button></a>
        <a href="logout.php"><button>Log Out</button></a>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="image-slider-container">
            <img src="images/feedback.jpg" alt="Hospital Image" class="static-image">
        </div>

        <div class="appointment-box">
            <h1>📝Write feedback</h1>

            <?php if (isset($message)): ?>
                <p class="error-message"><?= htmlspecialchars($message) ?></p>
            <?php endif; ?>

            <form action="feedback.php" method="POST" class="appointment-form">
                <label for="doctor_id">👨‍⚕️ Select Doctor:</label>
                <select name="doctor_id" required>
                    <option value="">Select a Doctor</option>
                    <?php while ($row = $doctorResult->fetch_assoc()): ?>
                        <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['full_name']) ?></option>
                    <?php endwhile; ?>
                </select>

                <br><br>
                <label for="question">🖊️ Write your feedback:</label>
                <textarea name="question" class="ask-doctor-input" required></textarea>

                <br><br>
                <button type="submit" name="question_submit">✅ Submit</button>
            </form>
                    
        </div>
    </div>

</body>
</html>
