<?php
session_start();

// Ensure user is logged in as Patient
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Patient') {
    header("Location: login.php");
    exit();
}

include 'db_connect.php';
$message = "";

// Fetch available doctors for the dropdown list
$doctorQuery = "SELECT id, full_name FROM users WHERE role = 'Doctor'";
$doctorResult = $conn->query($doctorQuery);

// Handle form submission and save appointment
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $patient_id = $_SESSION['user_id']; // Logged-in patient ID
    $doctor_id = $_POST['doctor_id'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];

    // Validate date (Cannot be a past date)
    $currentDate = date("Y-m-d");
    if ($appointment_date < $currentDate) {
        $message = "❌ You cannot book an appointment for a past date!";
    } else {
        // Validate that doctor exists
        $doctorCheckQuery = "SELECT id FROM users WHERE id = ? AND role = 'Doctor'";
        $stmtCheck = $conn->prepare($doctorCheckQuery);
        $stmtCheck->bind_param("i", $doctor_id);
        $stmtCheck->execute();
        $stmtCheck->store_result();
        
        if ($stmtCheck->num_rows === 0) {
            $message = "❌ Selected doctor is not available!";
        } else {
            // Insert appointment into the database
            $sql = "INSERT INTO appointments (patient_id, doctor_id, appointment_date, appointment_time, status)
                    VALUES (?, ?, ?, ?, 'Pending')";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iiss", $patient_id, $doctor_id, $appointment_date, $appointment_time);

            if ($stmt->execute()) {
                $message = "✅ Your appointment has been booked successfully!";
            } else {
                $message = "❌ Error booking appointment. Please try again!";
            }
            $stmt->close();
        }
        $stmtCheck->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Appointment | Hospital Management</title>
    <link rel="stylesheet" href="css/apointment.css">
    
</head>
<body>

    <!-- Sidebar Navigation -->
    <div class="sidebar">
        <h2>Welcome, <?= htmlspecialchars($_SESSION['full_name']) ?>!</h2>
        <a href="appointment.php"><button>Appointments</button></a>
        <a href="view_medicalrecords.php"><button>Medical Records</button></a>
        <a href="view_labreport.php"><button>Lab Reports</button></a>
        <a href="queries.php"><button>Queries</button></a>
        <a href="logout.php"><button>Log Out</button></a>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="image-slider-container">
            <img src="images/appiontment.jpg" alt="Hospital Image" class="static-image">
        </div>

        <div class="appointment-box">
            <h1>📅 Book an Appointment</h1>

            <?php if (!empty($message)): ?>
                <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
            <?php endif; ?>

            <form action="appointment.php" method="POST" class="appointment-form">
                <label for="doctor_id">👨‍⚕️ Select Doctor:</label>
                <select name="doctor_id" required>
                    <option value="">Select a Doctor</option>
                    <?php while ($row = $doctorResult->fetch_assoc()): ?>
                        <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['full_name']) ?></option>
                    <?php endwhile; ?>
                </select>

                <br><br> <label for="appointment_date">📆 Appointment Date:</label>
                <input type="date" name="appointment_date" min="<?= date('Y-m-d'); ?>" required>

                <br><br><label for="appointment_time">⏰ Appointment Time:</label>
                <input type="time" name="appointment_time" required>

                <br><br><button type="submit" class="btn btn-primary">✅ Book Appointment</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
