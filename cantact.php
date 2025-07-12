<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Private Hospital</title>
    <link rel="stylesheet" href="css/contact.css"> <!-- Link to CSS -->
</head>
<body>

<header>
    <h1>Contact Us</h1>
    <nav>
        <a href="index.php">Home</a>
        <a href="appointment.php">Book Appointment</a>
        <a href="about.php">About Us</a>
        <a href="contact.php">Contact</a>
        
    </nav>
</header>

<div class="container">
    <h2>Get in Touch</h2>
    <p>Feel free to reach out to us for any inquiries or appointments.</p>

    <div class="contact-info">
        <p><strong>📍 Address:</strong> 123 Main Street, Colombo, Sri Lanka</p>
        <p><strong>📞 Phone:</strong> +94 123 456 789</p>
        <p><strong>📧 Email:</strong> info@carecompass.com</p>
    </div>

    <form action="send_message.php" method="POST">
        <label for="name">Full Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="message">Message:</label>
        <textarea id="message" name="message" rows="4" required></textarea>

        <button type="submit">Send Message</button>
    </form>
</div>

<footer>
    <p>© 2025 Private Hospital | All Rights Reserved</p>
</footer>

</body>
</html>
