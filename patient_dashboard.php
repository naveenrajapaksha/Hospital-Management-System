<?php
session_start();

// Ensure user is logged in as Admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Patient') {
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
        <a href="appointment.php"><button> Appointments</button></a>
        <a href="view medicalrecords.php"><button>Medical Records</button></a>
        <a href="view labreport.php"><button>Lab Reports</button></a>
        <a href="queries.php"><button>Queries</button></a>
        <a href="feedback.php"><button>Feedback</button></a>
        <a href="logout.php"><button>Log Out</button></a>
       
    </div>

    <!-- Main Content with Animated Images -->
    <div class="content">
        <h1>Hospital Patient Dashboard</h1>
        <p>"Easily manage your appointments, medical records, and lab reports in one place for a smoother healthcare experience."</p>

        <!-- Image Slideshow -->
        <div class="image-slider">
        <img src="images/patientdash1.jpg" class="slide active">
            <img src="images/patientdash2.jpg" class="slide">
            <img src="images/patientdash3.jpg" class="slide">
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
