<?php include("db_connect.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Private Hospital</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="header">
    <div class="header-overlay">
        <h1 class="header-title">Welcome to Care Compass Hospital</h1>
        <nav>
            <ul>
                <!-- Navigation Links -->
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="loginf.php">Book Appointment</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <li><a href="careers.php">Careers</a></li>
                <li><a href="services.php">Services</a></li>
                <!-- Search Bar -->
                <li>
                    <form action="search.php" method="GET" class="search-form">
                        <input type="text" name="query" placeholder="Search services, doctors..." class="search-input">
                        <button type="submit" class="search-btn">Search</button>
                    </form>
                </li>
                <li><a href="loginf.php" class="login-btn">Log in</a></li>
                <li><a href="register.html" class="signup-btn">Sign-up</a></li>
            </ul>
        </nav>
    </div>
</header>

<section id="service_id">
    <div class="service-outer">
        <!-- Service Box 1 -->
        <a href="loginf.php" class="service-link">
            <div class="service-inner" style="background-image: url('images/admin.png');">
                <h2>Book Appointment</h2>
            </div>
        </a>

        <!-- Service Box 2 -->
        <a href="branches.php" class="service-link">
            <div class="service-inner" style="background-image: url('images/main-branches.jpg');">
                <h2>Our Branches</h2>
            </div>
        </a>

        <!-- Service Box 3 -->
        <a href="services.php" class="service-link">
            <div class="service-inner" style="background-image: url('images/services-main.jpg');">
                <h2>Services</h2>
            </div>
        </a>

        <!-- Service Box 4 -->
        <a href="careers.php" class="service-link">
            <div class="service-inner" style="background-image: url('images/career-main.jpg');">
                <h2>Careers</h2>
            </div>
        </a>
    </div>
</section>

<div class="context-main">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-6">
                <div class="dental-inner">
                </div>
            </div>
        </div>
    </div>
</div> 

<script src="js/script.js"></script>

<footer>
    <?php include 'includes/footer.php'; ?>
</footer>

</body>
</html>