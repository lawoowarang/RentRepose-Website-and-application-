<?php
include 'db_connect.php';
$id = 2;

$sql = "SELECT * FROM pg_info WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "No records found";
}