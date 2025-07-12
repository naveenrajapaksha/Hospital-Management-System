<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = trim($_POST["first_name"]);
    $lastName = trim($_POST["last_name"]);
    $email = trim($_POST["email"]);
    $jobTitle = trim($_POST["job_title"]);

    // Validate required fields
    if (empty($firstName) || empty($lastName) || empty($email)) {
        die("Error: All fields are required.");
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Error: Invalid email format.");
    }

    // Validate file upload
    if (!isset($_FILES["resume"]) || $_FILES["resume"]["error"] != UPLOAD_ERR_OK) {
        die("Error: Resume upload is required.");
    }

    // Check file type
    $fileType = mime_content_type($_FILES["resume"]["tmp_name"]);
    if ($fileType != "application/pdf") {
        die("Error: Only PDF files are allowed.");
    }

    // Save the file (optional)
    $uploadDir = "uploads/";
    $fileName = basename($_FILES["resume"]["name"]);
    $targetFilePath = $uploadDir . $fileName;

    if (!move_uploaded_file($_FILES["resume"]["tmp_name"], $targetFilePath)) {
        die("Error: File upload failed.");
    }

    echo "Application submitted successfully!";
}
?>
