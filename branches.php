<?php include("db_connect.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Branches - Care Compass Hospital</title>
    <link rel="stylesheet" href="css/branches.css">
</head>
<body>

<header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About Us</a></li>
            <li><a href="loginf.php">Book Appointment</a></l>
            <li><a href="contact.php">Contact Us</a></li>
            <li><a href="careers.php">Careers</a></li>
            <li><a href="services.php">Services</a></li>
            <li><a href="loginf.php" class="login-btn">Log in</a></li>
            <li><a href="register.html" class="signup-btn">Sign-up</a></li>
            
        </ul>
    </nav>
</header>

<div class="container">
    <h2>Explore Our Branches</h2>

    <!-- Kandy Branch -->
    <div class="branch">
        <img src="images/kandy-branch.jpg" alt="Kandy Branch">
        <div class="branch-info">
            <h3>📍 Kandy Branch</h3>
            <p><strong>Address:</strong> No. 123, Peradeniya Road, Kandy, Sri Lanka</p>
            <p><strong>Phone:</strong> +94 81 222 3456</p>
            <p><strong>Email:</strong> kandy@privatehospital.com</p>
        </div>
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31686.82082362826!2d80.62171951214702!3d7.290571938555677!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae366eb3a5df3d1%3A0x27b1b68049e0c4ea!2sKandy!5e0!3m2!1sen!2slk!4v1615467972489!5m2!1sen!2slk" 
            allowfullscreen="" loading="lazy">
        </iframe>
    </div>

    <!-- Colombo Branch -->
    <div class="branch">
        <img src="images/colombo-branch.jpg" alt="Colombo Branch">
        <div class="branch-info">
            <h3>📍 Colombo Branch</h3>
            <p><strong>Address:</strong> No. 45, Galle Road, Colombo 03, Sri Lanka</p>
            <p><strong>Phone:</strong> +94 11 234 5678</p>
            <p><strong>Email:</strong> colombo@privatehospital.com</p>
        </div>
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126743.33858278253!2d79.82160358955074!3d6.927078795073205!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2594c4f4f5b1d%3A0x48c4b531f07aafc6!2sColombo!5e0!3m2!1sen!2slk!4v1615467972489!5m2!1sen!2slk" 
            allowfullscreen="" loading="lazy">
        </iframe>
    </div>

    <!-- Kurunegala Branch -->
    <div class="branch">
        <img src="images/kurunegala-branch.jpg" alt="Kurunegala Branch">
        <div class="branch-info">
            <h3>📍 Kurunegala Branch</h3>
            <p><strong>Address:</strong> No. 78, Dambulla Road, Kurunegala, Sri Lanka</p>
            <p><strong>Phone:</strong> +94 37 223 4567</p>
            <p><strong>Email:</strong> kurunegala@privatehospital.com</p>
        </div>
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126875.76884888887!2d80.33878977159001!3d7.48745036015292!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae3157f6d8c2e1f%3A0x3c2aefc1c4f4e5a2!2sKurunegala!5e0!3m2!1sen!2slk!4v1700000000000!5m2!1sen!2slk" 
            allowfullscreen="" loading="lazy">
        </iframe>
    </div>
</div>
<footer>
     <?php include 'includes/footer.php'; ?>
</footer>
</body>
</html>
