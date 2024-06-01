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

// Fetch reviews from the database
$sql = "SELECT * FROM reviews";
$result = $connection->query($sql);

$reviews = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $reviews[] = $row;
    }
}

// Encode reviews as JSON
echo json_encode($reviews);

// Close connection
$connection->close();
?>
