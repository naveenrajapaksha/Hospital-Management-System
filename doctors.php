<?php include("db_connect.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctors</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Our Doctors</h1>
</header>

<section>
    <?php
    $result = $conn->query("SELECT * FROM doctors");
    while ($row = $result->fetch_assoc()) {
        echo "<div>
                <h3>" . $row['name'] . "</h3>
                <p>Specialty: " . $row['specialty'] . "</p>
              </div>";
    }
    ?>
</section>
<footer>
        <?php include 'footer.php'; ?>
    </footer>
</body>
</html>
