<?php
$servername = "localhost"; // Update with your database server
$username = "root"; // Update with your database username
$password = ""; // Update with your database password
$dbname = "railmap"; // Update with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $restaurant_id = $_POST['restaurant_id'];
    $user_id = $_POST['user_id']; // Assuming you have user_id from session or form
    $rating = $_POST['rating'];

    // Insert rating into database
    $stmt = $conn->prepare("INSERT INTO rating (restaurant_id, user_id, rating) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $restaurant_id, $user_id, $rating);

    if ($stmt->execute()) {
        echo "Rating submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

$sql = "SELECT * FROM restaurants";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Rating</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
        }
        .form-group {
            margin: 15px 0;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        select, input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Rate a Restaurant</h1>
    <form method="POST" action="">
        <div class="form-group">
            <label for="restaurant_id">Select Restaurant:</label>
            <select name="restaurant_id" id="restaurant_id" required>
                <option value="">Select a restaurant</option>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='".$row['id']."'>".$row['name']."</option>";
                    }
                } else {
                    echo "<option value=''>No restaurants found</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="rating">Rating (1-5):</label>
            <select name="rating" id="rating" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>
        <input type="hidden" name="user_id" value="1"> <!-- Replace with session user ID -->
        <input type="submit" value="Submit Rating">
    </form>
</div>

</body>
</html>
