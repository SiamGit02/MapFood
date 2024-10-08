<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "railmap"); // Update with your DB credentials

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle Add Restaurant
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $contact = $_POST['contact'];

    $query = "INSERT INTO restaurants (name, location, contact) VALUES ('$name', '$location', '$contact')";
    if ($conn->query($query)) {
        echo "<script>alert('Restaurant added successfully!');</script>";
    } else {
        echo "<script>alert('Error adding restaurant.');</script>";
    }
}

// Handle Delete Restaurant
if (isset($_POST['delete'])) {
    $id = $_POST['delete_id'];
    $query = "DELETE FROM restaurants WHERE id = $id";
    if ($conn->query($query)) {
        echo "<script>alert('Restaurant deleted successfully!');</script>";
    } else {
        echo "<script>alert('Error deleting restaurant.');</script>";
    }
}

// Handle Update Restaurant
if (isset($_POST['update'])) {
    $id = $_POST['edit_id'];
    $name = $_POST['edit_name'];
    $location = $_POST['edit_location'];
    $contact = $_POST['edit_contact'];

    $query = "UPDATE restaurants SET name='$name', location='$location', contact='$contact' WHERE id = $id";
    if ($conn->query($query)) {
        echo "<script>alert('Restaurant updated successfully!');</script>";
    } else {
        echo "<script>alert('Error updating restaurant.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .navbar {
            background-color: #c4c4e8;
            
        
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand {
            
            text-decoration: none;
            font-size: 24px;
        }

        .navbar-nav {
            list-style-type: none;
            display: flex;
            margin: 0;
            padding: 0;
        }

        .navbar-nav li {
            margin-right: 20px;
        }

        .navbar-nav a {
           
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .navbar-nav a:hover {
            background-color: #495057;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }
        h1, h2 {
            text-align: center;
            color: #333;
        }
        form {
            margin-bottom: 20px;
        }
        label {
            display: inline-block;
            width: 100px;
            margin-top: 10px;
        }
        input[type="text"] {
            width: 200px;
            padding: 5px;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            padding: 8px 16px;
            background-color: #5cb85c;
            border: none;
            color: white;
            cursor: pointer;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        td form {
            display: inline-block;
        }
    </style>
</head>
<body>
<nav class="navbar">
        <div class="container">
            <a class="navbar-brand" href="index.php">Map Food</a>
            <ul class="navbar-nav">
                <li><a href="adminpage.php">Restaurants</a></li>
                <li><a href="complaints.php">Complaints</a></li>
                     
                
            </ul>
        </div>
    </nav>


    <div class="container">
        <h1>Restaurant Management</h1>

        <!-- Add Restaurant Form -->
        <form action="" method="POST">
            <h2>Add New Restaurant</h2>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>
            
            <label for="location">Location:</label>
            <input type="text" name="location" id="location" required>
            
            <label for="contact">Contact:</label>
            <input type="text" name="contact" id="contact" required>
            
            <input type="submit" name="add" value="Add Restaurant">
        </form>

        <!-- Restaurant List with Edit Option -->
        <h2>Restaurant List</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Contact</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch and Display Restaurants
                $query = "SELECT * FROM restaurants";
                $result = $conn->query($query);

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row['id']."</td>";
                    echo "<td>".$row['name']."</td>";
                    echo "<td>".$row['location']."</td>";
                    echo "<td>".$row['contact']."</td>";
                    echo "<td>
                            <form action='' method='POST' style='display:inline-block;'>
                                <input type='hidden' name='edit_id' value='".$row['id']."'>
                                <input type='submit' name='edit' value='Edit'>
                            </form>
                            <form action='' method='POST' style='display:inline-block;'>
                                <input type='hidden' name='delete_id' value='".$row['id']."'>
                                <input type='submit' name='delete' value='Delete'>
                            </form>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Edit Restaurant Form (Appears after Edit is Clicked) -->
        <?php
        if (isset($_POST['edit'])) {
            $id = $_POST['edit_id'];
            $query = "SELECT * FROM restaurants WHERE id = $id";
            $result = $conn->query($query);
            $restaurant = $result->fetch_assoc();
        ?>
            <h2>Edit Restaurant</h2>
            <form action="" method="POST">
                <input type="hidden" name="edit_id" value="<?php echo $restaurant['id']; ?>">
                
                <label for="edit_name">Name:</label>
                <input type="text" name="edit_name" id="edit_name" value="<?php echo $restaurant['name']; ?>" required>
                
                <label for="edit_location">Location:</label>
                <input type="text" name="edit_location" id="edit_location" value="<?php echo $restaurant['location']; ?>" required>
                
                <label for="edit_contact">Contact:</label>
                <input type="text" name="edit_contact" id="edit_contact" value="<?php echo $restaurant['contact']; ?>" required>
                
                <input type="submit" name="update" value="Update Restaurant">
            </form>
        <?php } ?>
    </div>

</body>
</html>
