<?php include("db_connect.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hospital Footer</title>
  <link rel="stylesheet" href="css/footer.css">
</head>
<body>
  <!-- Footer Section -->
  <footer class="footer">
    <!-- Quick Links -->
    <div class="footer-section">
      <h3>Quick Links</h3>
      <ul>
        <li><a href="about.php">About Us</a></li>
        <li><a href="loginf.php">Apointments</a></li>
        <li><a href="contact.php">Contact Us</a></li>
        <li><a href="branches.php">Our Branches</a></li>
        <li><a href="careers.php">Careers</a></li>
        <li><a href="services.php">Services</a></li>
      </ul>
    </div>

    <!-- Contact Information -->
    <div class="footer-section">
      <h3>Contact Us</h3>
      <p>123 Main Street, Colombo, Sri Lanka</p>
      <p>Phone: +94 123 456 789</p>
      <p>Email: info@carecompass.com</p>
      <p>Emergency: <a href="tel:+94 123 456 789">Call +94 123 456 789</a></p>
      <br>
      <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126743.33858278253!2d79.82160358955074!3d6.927078795073205!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2594c4f4f5b1d%3A0x48c4b531f07aafc6!2sColombo!5e0!3m2!1sen!2slk!4v1615467972489!5m2!1sen!2slk" 
            allowfullscreen="" loading="lazy">
        </iframe>
    </div>

    
    <!-- Newsletter Signup -->
    <div class="footer-section">
      <h3>Subscribe to Our Newsletter</h3>
      <form class="newsletter-form">
        <input type="email" placeholder="Enter your email" required>
        <button type="submit">Subscribe</button>
      </form>
    </div>

    <!-- Legal & Compliance -->
    <div class="footer-section">
      <h3>Legal</h3>
      <ul>
        <li><a href="privacy_policy.php">Privacy Policy</a></li>
        <li><a href="terms_of_use.php">Terms of Use</a></li>
        <li><a href="accessibility.php">Accessibility</a></li>
      </ul>
    </div>

   
  </footer>

  <!-- Back to Top Button -->
  <button id="back-to-top" title="Go to top">↑</button>

  <!-- Copyright Notice -->
  <div class="copyright">
    <p>© 2025 care_compass. All rights reserved.</p>
  </div>

  <script src="script.js"></script>
</body>
</html>