<?php
require_once "dbconnect.php";
session_start();

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$id = $_GET['id'];

// Get the restaurant name
$getRestaurantName = "SELECT name FROM restaurants WHERE id = ?";
$stmt = $conn->prepare($getRestaurantName);
$stmt->bind_param('i', $id);
$stmt->execute();
$result2 = $stmt->get_result();
$row = $result2->fetch_assoc();
$name = $row['name'];

// Get menu items
$getMenu = "SELECT item_name, description, price FROM menu WHERE restaurant = ?";
$stmt = $conn->prepare($getMenu);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $quantities = $_POST['quantity'];
    $item_names = $_POST['item_name'];
    $descriptions = $_POST['description'];
    $prices = $_POST['price'];

    foreach ($quantities as $index => $quantity) {
        if ($quantity > 0) {
            $item_name = $item_names[$index];
            $description = $descriptions[$index];
            $price = $prices[$index];
            $total = $price * $quantity;

            // Insert into history table
            $insertHistory = "INSERT INTO history (user_id, restaurant_id, item_name, description, price, quantity, total) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($insertHistory);
            $stmt->bind_param('iissidi', $user_id, $id, $item_name, $description, $price, $quantity, $total);
            $stmt->execute();
        }
    }

    // Redirect to a confirmation page or refresh the current page
    header("Location: confirmation.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Map Food</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <link href="css/bookingStyle.css" rel="stylesheet" />
    <link href="css/table.css" rel="stylesheet" />
</head>
<body id="page-top">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="index.php">Map Food</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php#projects">Our Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php#signup">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="rating.php">Rating</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section id="menu">
        <div id="menuDiv">
            <div class="container mt-5 px-2">
                <div class="mb-2 d-flex justify-content-between align-items-center">
                    <h1>Welcome to <?php echo htmlspecialchars($name); ?></h1>
                </div>
                <div class="table-responsive" id="menuTable">
                    <form action="" method="post">
                        <table class="table table-responsive table-borderless">
                            <thead>
                                <tr class="bg-light">
                                    <th scope="col" width="10%">Item</th>
                                    <th scope="col" width="10%">Description</th>
                                    <th scope="col" width="5%">Price</th>
                                    <th scope="col" width="5%">Quantity</th>
                                </tr>
                            </thead>
                            <tbody id="cart">
                                <?php
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    $item_name = htmlspecialchars($row['item_name']);
                                    $description = htmlspecialchars($row['description']);
                                    $price = htmlspecialchars($row['price']);
                                    
                                    echo "<td>$item_name<input type='hidden' name='item_name[]' value='$item_name' /></td>";
                                    echo "<td>$description<input type='hidden' name='description[]' value='$description' /></td>";
                                    echo "<td class='price'>$price<input type='hidden' name='price[]' value='$price' /></td>";
                                    echo "<td><input type='number' class='quantity' name='quantity[]' min='0' max='100' value='0' /></td>";
                                    echo "</tr>";
                                }
                                ?>
                                <tr>
                                    <td colspan="4" align='center'><input type="submit" value="Checkout" class='btn btn-primary'></td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                    <p>Delivery Charge: BDT 60</p>
                    <p>Total: BDT <span id="total">0.00</span></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer-->
    <footer class="footer bg-black small text-center text-white-50">
        <div class="container px-4 px-lg-5">Copyright &copy; ErrorSage</div>
        <div class="container px-4 px-lg-5">
            <img src="images/ErrorSage/ERROR SAGE Logo [Color].png" alt="" width="150px">
        </div>
    </footer>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    <script src="js/totalAmount.js"></script>
</body>
</html>
