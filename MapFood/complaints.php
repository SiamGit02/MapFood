<?php
session_start();
require_once "dbconnect.php";

// Fetch complaints from the database
$getComplaints = "SELECT c.id, r.name AS restaurant_name, c.complaint_text, c.created_at 
                  FROM complaint c
                  JOIN restaurants r ON c.restaurant_id = r.id 
                  ORDER BY c.created_at DESC";
$result = mysqli_query($conn, $getComplaints);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaints List</title>
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
        <h1>Complaints</h1>
        <table class="complaints-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Restaurant</th>
                    <th>Complaint</th>
                    <th>Date Submitted</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['restaurant_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['complaint_text']); ?></td>
                            <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No complaints found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</b