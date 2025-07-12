<?php include("db.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Careers - Private Hospital</title>

    <!-- Main Careers Page Styling -->
    <link rel="stylesheet" href="css/staff_select.css">

    <!-- Button Styles (Separated) -->
    <link rel="stylesheet" href="css/buttons.css">
</head>
<body>

<header>
<?php include 'includes/header.php'; ?>  
</header>

<div class="container">
<h1>Join Our Team</h1>
    <h2>Current Job Openings</h2>
    <p>Explore the opportunities to work with us and make a difference.</p>

    <!-- Job Listings -->
    <div class="job-listing">
        <img src="images/dr_male.jpg" alt="Doctor Vacancy" class="job-image">
        <h3>🔹 General Physician</h3>
        <p><strong>Location:</strong> Colombo, Sri Lanka</p>
        <p><strong>Experience:</strong> 5+ years</p>
        <p><strong>Description:</strong> Seeking a qualified physician to diagnose and treat patients.</p>
        <button onclick="applyNow('General Physician')">Apply Now</button>
    </div>

    <div class="job-listing">
        <img src="images/staff_nurse.jpg" alt="Nurse Vacancy" class="job-image">
        <h3>🔹 Staff Nurse</h3>
        <p><strong>Location:</strong> Colombo, Sri Lanka</p>
        <p><strong>Experience:</strong> 2+ years</p>
        <p><strong>Description:</strong> Looking for experienced nurses to provide patient care.</p>
        <button onclick="applyNow('Staff Nurse')">Apply Now</button>
    </div>

    <div class="job-listing">
        <img src="images/receptionalist.jpg" alt="Medical Receptionist Vacancy" class="job-image">
        <h3>🔹 Medical Receptionist</h3>
        <p><strong>Location:</strong> Colombo, Sri Lanka</p>
        <p><strong>Experience:</strong> 1+ years</p>
        <p><strong>Description:</strong> Responsible for front desk operations and patient assistance.</p>
        <button onclick="applyNow('Medical Receptionist')">Apply Now</button>
    </div>
</div>

<script>
function applyNow(jobTitle) {
    window.location.href = "apply.php?job=" + encodeURIComponent(jobTitle);
}
</script>

<footer>
     <?php include 'includes/footer.php'; ?>
</footer>

</body>
</html>
