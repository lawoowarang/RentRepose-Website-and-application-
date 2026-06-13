<?php include 'update18.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <title>PG info</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background: white;
            user-select: none;
        }

        header {
            background-color: gray;
            color: rgb(93, 5, 5);
            height: 55px;
            width: 100%;
            text-align: center;
            margin-top: 4px;
        }

        header h1 {
            margin-top: 10px;
        }

        .content-container {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            margin: 20px;
            gap: 20px;
        }

        .photo-box {
            flex: 1;
            min-width: 300px;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 2px solid black;
            border-radius: 10px;
            background-color: transparent;
            padding: 10px;
        }

        .photo-box img {
            max-width: 100%;
            max-height: 100%;
            border-radius: 10px;
        }

        form {
            flex: 2;
            background-color: transparent;
            padding: 2rem;
            backdrop-filter: blur(5px);
            border: 2px solid black;
            border-radius: 5px;
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 0.5rem;
        }

        input, textarea {
            margin-bottom: 1rem;
            padding: 0.5rem;
            border: 1px solid black;
            border-radius: 3px;
            width: 100%;
        }

        .buttons {
            display: flex;
            justify-content: space-evenly;
            margin-top: 30px;
        }

        button, .buttons a {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 3px;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            text-decoration: none;
        }

        button:hover, .buttons a:hover {
            background-color: #45a049;
        }

        .buttons a {
            background-color: #2196F3;
        }

        .buttons a:hover {
            background-color: #1e87d4;
        }
    </style>
</head>
<body>
    <header>
        <h1>PG Information</h1>
    </header>
    <main>
        <div class="content-container">
            <div class="photo-box">
                <img src="<?php echo $row['image']; ?>" id="image" name="image" alt="PG Image" required>
            </div>
            <form action="update.php" method="post" enctype="multipart/form-data">
                <label>Name:</label>
                <input type="text" id="name" name="name" value="<?php echo ($row['name']) ? $row['name'] : ''; ?>" required readonly>

                <label>Address:</label>
                <input type="text" id="address" name="address" value="<?php echo $row['address']; ?>" required readonly>
                 
                <label>Description:</label>
                <textarea id="description" name="description" rows="10" required readonly><?php echo $row['description']; ?></textarea>
                 
                <div class="buttons">
                    <a href="mapmess.html">Map</a>
                    <a href="review.html">Reviews and ratings</a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>