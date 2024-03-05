<?php
// Assuming you have established a MySQL connection
$servername = "localhost";
$username = "asuka";
$password = "asuka";
$dbname = "stats_entries";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the JSON data sent from JavaScript
$data = json_decode(file_get_contents('php://input'), true);

// Prepare and bind SQL statement
$stmt = $conn->prepare("INSERT INTO responses (word, color, answer, response_time) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sssi", $word, $color, $answer, $responseTime);

// Insert each response into the database
foreach ($data as $response) {
    $word = $response['word'];
    $color = $response['color'];
    $answer = $response['answer'];
    $responseTime = $response['responseTime'];
    $stmt->execute();
}

// Close connection
$stmt->close();
$conn->close();
?>
