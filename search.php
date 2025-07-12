<?php
include("db_connect.php");

// Get the search query from the URL
if (isset($_GET['query'])) {
    $query = $_GET['query'];

    // Perform a database search
    $sql = "SELECT * FROM services WHERE name LIKE '%$query%' OR description LIKE '%$query%'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<h2>Search Results for: $query</h2>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='search-result'>";
            echo "<h3>" . $row['name'] . "</h3>";
            echo "<p>" . $row['description'] . "</p>";
            echo "</div>";
        }
    } else {
        echo "<h2>No results found for: $query</h2>";
    }
} else {
    echo "<h2>Please enter a search query.</h2>";
}
?>