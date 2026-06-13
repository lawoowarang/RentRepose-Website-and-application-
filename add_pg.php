<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pg_name = $_POST['pg_name'];
    $pg_address = $_POST['pg_address'];
    $pg_description = $_POST['pg_description'];
    $pg_image = $_FILES['pg_image'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'website');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Image upload handling
    $target_dir = "uploads/";
    // Check if the uploads directory exists, if not, create it
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $target_file = $target_dir . basename($pg_image["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is an actual image or fake image
    $check = getimagesize($pg_image["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($pg_image["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($pg_image["tmp_name"], $target_file)) {
            // Insert PG information into the database
            $sql = "INSERT INTO pg_info (name, address, description, image) VALUES ('$pg_name', '$pg_address', '$pg_description', '$target_file')";
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('New PG added successfully');</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    $conn->close();
}