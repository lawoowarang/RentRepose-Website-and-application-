<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "website";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch addresses
$sql = "SELECT address FROM pg_info";
$result = $conn->query($sql);

$addresses = array();

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $addresses[] = $row['address'];
    }
} else {
    echo "0 results";
}
$conn->close();

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($addresses);