<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for a Job</title>

    <!-- Apply Form Styles -->
    <link rel="stylesheet" href="css/submit-form.css">
</head>
<body>

<header>
    <h1>Apply for a Job</h1>
</header>

<div class="apply-container">
    <?php
    // Get the job title from the URL
    $jobTitle = isset($_GET['job']) ? htmlspecialchars($_GET['job']) : "Job Position";
    ?>
    
    <h2>Apply for <?php echo $jobTitle; ?></h2>

    <form action="submit_application.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
        <input type="hidden" name="job_title" value="<?php echo $jobTitle; ?>">

        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="resume">Upload Resume (PDF):</label>
        <input type="file" id="resume" name="resume" accept=".pdf" required>

        <button type="submit">Submit Application</button>
    </form>
</div>

<script>
function validateForm() {
    var email = document.getElementById("email").value;
    var resume = document.getElementById("resume").files.length;

    if (email.trim() === "") {
        alert("Please enter your email address.");
        return false;
    }

    if (resume === 0) {
        alert("Please upload your resume (PDF only).");
        return false;
    }

    return true;
}
</script>
</body>
</html>
