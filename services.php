<?php include("db_connect.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Services - Hospital</title>
    <link rel="stylesheet" href="css/services.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<header>
    <nav>
        <a href="index.php">Home</a>
        <a href="about.php">About Us</a>
        <a href="loginf.php">Book Appointment</a>
        <a href="contact.php">Contact Us</a>
        <a href="branches.php">Our Branches</a>
        <a href="careers.php">Careers</a>
        <a href="loginf.php" class="login-btn">Log in</a>
        <a href="register.html" class="signup-btn">Sign-up</a>
    </nav>
</header>

<div class="container mt-5">
    <h2 class="text-center">Our Medical Services</h2>
    <div class="row mt-4">
        
        <!-- Cardiology -->
        <div class="col-md-4">
            <div class="card">
                <img src="images/cardiology.jpg" class="card-img-top" alt="Cardiology">
                <div class="card-body">
                    <h5 class="card-title">Cardiology</h5>
                    <p class="card-text">Advanced heart care services with expert cardiologists.</p>
                </div>
            </div>
        </div>

        <!-- Orthopedics -->
        <div class="col-md-4">
            <div class="card">
                <img src="images/orthopedics.jpg" class="card-img-top" alt="Orthopedics">
                <div class="card-body">
                    <h5 class="card-title">Orthopedics</h5>
                    <p class="card-text">Comprehensive bone and joint care for all ages.</p>
                </div>
            </div>
        </div>

        <!-- Pediatrics -->
        <div class="col-md-4">
            <div class="card">
                <img src="images/pediatrics.jpg" class="card-img-top" alt="Pediatrics">
                <div class="card-body">
                    <h5 class="card-title">Pediatrics</h5>
                    <p class="card-text">Specialized care for infants, children, and adolescents.</p>
                </div>
            </div>
        </div>

        <!-- Neurology -->
        <div class="col-md-4 mt-4">
            <div class="card">
                <img src="images/neurology.jpg" class="card-img-top" alt="Neurology">
                <div class="card-body">
                    <h5 class="card-title">Neurology</h5>
                    <p class="card-text">Expert care for neurological disorders and brain health.</p>
                </div>
            </div>
        </div>

        <!-- Dermatology -->
        <div class="col-md-4 mt-4">
            <div class="card">
                <img src="images/dermatology.jpg" class="card-img-top" alt="Dermatology">
                <div class="card-body">
                    <h5 class="card-title">Dermatology</h5>
                    <p class="card-text">Professional skin care and treatment for all skin conditions.</p>
                </div>
            </div>
        </div>

        <!-- Gynecology -->
        <div class="col-md-4 mt-4">
            <div class="card">
                <img src="images/gynecology.jpg" class="card-img-top" alt="Gynecology">
                <div class="card-body">
                    <h5 class="card-title">Gynecology</h5>
                    <p class="card-text">Women's health and maternity care specialists.</p>
                </div>
            </div>
        </div>

        <!-- Radiology -->
        <div class="col-md-4 mt-4">
            <div class="card">
                <img src="images/radiology.jpg" class="card-img-top" alt="Radiology">
                <div class="card-body">
                    <h5 class="card-title">Radiology</h5>
                    <p class="card-text">Advanced diagnostic imaging and radiology services.</p>
                </div>
            </div>
        </div>

        <!-- Oncology -->
        <div class="col-md-4 mt-4">
            <div class="card">
                <img src="images/oncology.jpg" class="card-img-top" alt="Oncology">
                <div class="card-body">
                    <h5 class="card-title">Oncology</h5>
                    <p class="card-text">Comprehensive cancer treatment and care.</p>
                </div>
            </div>
        </div>

        <!-- Emergency Care -->
        <div class="col-md-4 mt-4">
            <div class="card">
                <img src="images/emergency.jpg" class="card-img-top" alt="Emergency Care">
                <div class="card-body">
                    <h5 class="card-title">Emergency Care</h5>
                    <p class="card-text">24/7 emergency medical support for critical patients.</p>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<footer>
    <?php include 'includes/footer.php'; ?>
</footer>

</body>
</html>
