<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>New User Registration - Hospital Name</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header>
    <h1>New User Registration</h1>
    <p>Please fill out the form to register.</p>
  </header>

  <main>
    <form action="register.php" method="POST">
      <label for="name">Full Name:</label>
      <input type="text" id="name" name="name" required>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>

      <button type="submit">Register</button>
    </form>
  </main>

  <!-- Include the Footer -->
  <?php include 'footer.php'; ?>
</body>
</html>