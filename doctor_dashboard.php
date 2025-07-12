<?php
session_start();

// Ensure user is logged in as Admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Doctor') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard | Hospital Management</title>
    <link rel="stylesheet" href="css/admin_dashboard.css">
</head>
<body>

    <!-- Sidebar Navigation -->
    <div class="sidebar">
        <h2>Welcome, <?= htmlspecialchars($_SESSION['full_name']) ?>!</h2>
        <a href="view appointments.php"><button>View Appointments</button></a>
        <a href="Medical_records.php"><button>Medical Records</button></a>
        <a href="Lab_reports.php"><button>Lab Reports</button></a>
        <a href="view queries.php"><button>Answers for Queries</button></a>
        
        <a href="logout.php"><button>Log Out</button></a>
       
    </div>

    <!-- Main Content with Animated Images -->
    <div class="content">
        <h1>Hospital Doctor Dashboard</h1>
        <p>"Effortlessly manage your patient appointments, medical records, and lab reports—all in one place for a seamless healthcare workflow."</p>

        <!-- Image Slideshow -->
        <div class="image-slider">
        <img src="images/doctordash1.jpg" class="slide active">
            <img src="images/doctordash2.jpg" class="slide">
            <img src="images/doctordash3.jpg" class="slide">
        </div>
    </div>

    <script>
        // Image Slider Animation
        let slides = document.querySelectorAll(".slide");
        let currentIndex = 0;

        function showNextImage() {
            slides[currentIndex].classList.remove("active");
            currentIndex = (currentIndex + 1) % slides.length;
            slides[currentIndex].classList.add("active");
        }

        setInterval(showNextImage, 3000); // Change image every 3 seconds
    </script>

</body>
</html>
