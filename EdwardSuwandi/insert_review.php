<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webdev_afl2";

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name']) && isset($_POST['review'])) {
    // Escape user inputs to prevent SQL injection
    $name = $connection->real_escape_string($_POST['name']);
    $review = $connection->real_escape_string($_POST['review']);

    // Insert review into the database
    $sql = "INSERT INTO reviews (name, review) VALUES ('$name', '$review')";
    if ($connection->query($sql) === TRUE) {
        echo json_encode(['success' => true, 'message' => 'Review added successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error adding review: ' . $connection->error]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}

// Close connection
$connection->close();
?>
