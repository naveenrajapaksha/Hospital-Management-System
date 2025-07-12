<?php include("db.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Accessibility Statement - Hospital Name</title>
  <link rel="stylesheet" href="css/accessibility.css"> <!-- Link to your CSS file -->
</head>
<body>
  <!-- Include the Header -->
    <header> 
        <?php include 'includes/header.php'; ?>
    </header>

  <main>
    <section class="accessibility-statement">
      <h1>Accessibility Statement</h1>
      <p>Last updated: [Insert Date]</p>

      <h2>1. Commitment to Accessibility</h2>
      <p>
        At [Hospital Name], we are committed to ensuring that our website is accessible to everyone, including individuals with disabilities. We strive to meet the Web Content Accessibility Guidelines (WCAG) 2.1 Level AA standards to provide an inclusive experience for all users.
      </p>

      <h2>2. Features for Accessibility</h2>
      <p>
        Our website includes the following accessibility features:
      </p>
      <ul>
        <li><strong>Keyboard Navigation:</strong> All interactive elements can be accessed using a keyboard.</li>
        <li><strong>Screen Reader Compatibility:</strong> Content is structured to work well with screen readers.</li>
        <li><strong>Resizable Text:</strong> Users can adjust text size in their browser settings.</li>
        <li><strong>Color Contrast:</strong> Sufficient contrast is maintained between text and background colors.</li>
        <li><strong>Alternative Text:</strong> Images include descriptive alt text for screen readers.</li>
      </ul>

      <h2>3. Feedback and Assistance</h2>
      <p>
        If you encounter any accessibility barriers while using our website, please let us know. We are committed to resolving issues promptly and improving the accessibility of our services.
      </p>
      <p>
        You can contact us via:
      </p>
      <ul>
        <li><strong>Email:</strong> accessibility@hospitalname.com</li>
        <li><strong>Phone:</strong> (123) 456-7890</li>
        <li><strong>Address:</strong> 123 Hospital Street, City, State, ZIP</li>
      </ul>

      <h2>4. Third-Party Content</h2>
      <p>
        While we strive to make all content on our website accessible, some third-party content (e.g., embedded videos or external links) may not fully comply with accessibility standards. We encourage users to report any issues so we can address them.
      </p>

      <h2>5. Continuous Improvement</h2>
      <p>
        Accessibility is an ongoing effort. We regularly review and update our website to ensure it remains accessible and user-friendly. Your feedback is invaluable in helping us improve.
      </p>
    </section>
  </main>

  <!-- Include the Footer -->
  <?php include 'includes/footer.php'; ?>
</body>
</html>