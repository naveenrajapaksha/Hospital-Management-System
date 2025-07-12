<?php
session_start();

// Ensure user is logged in as Admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Hospital Management</title>
    <link rel="stylesheet" href="css/admin_dashboard.css">
</head>
<body>

    <!-- Sidebar Navigation -->
    <div class="sidebar">
        <h2>Welcome, <?= htmlspecialchars($_SESSION['full_name']) ?>!</h2>
        <a href="manage_appoinments.php"><button>Manage Appointments</button></a>
        <a href="manage_users.php"><button>Manage Users</button></a>
        <a href="manage medicalrecords.php"><button>Manage Medical records</button></a>
        <a href="manage_labreports.php"><button>Manage Lab reports</button></a>
        <a href="monitor_feedback.php"><button>Monitor Feedback</button></a>
        <a href="logout.php"><button>Log Out</button></a>
    </div>

    <!-- Main Content with Animated Images -->
    <div class="content">
        <h1>Hospital Admin Dashboard</h1>
        <p>Manage hospital services efficiently and ensure seamless patient care.</p>

        <!-- Image Slideshow -->
        <div class="image-slider">
            <img src="images/admindash.jpg" class="slide active">
            <img src="images/admindash2.jpg" class="slide">
            <img src="images/admindash3.jpg" class="slide">
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
