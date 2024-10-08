<?php
// Start session
session_start();

// Include database connection
require_once "dbconnect.php";

// Get the restaurant ID from the URL
$id = $_GET['id'];

// Get menu items for the restaurant
$getMenu = "SELECT item_name, description, price FROM menu WHERE restaurant = ?";
$stmtMenu = mysqli_prepare($conn, $getMenu);
mysqli_stmt_bind_param($stmtMenu, 'i', $id);
mysqli_stmt_execute($stmtMenu);
$result = mysqli_stmt_get_result($stmtMenu);

// Get the name of the restaurant
$getRestaurantName = "SELECT name FROM restaurants WHERE id = ?";
$stmtRestaurant = mysqli_prepare($conn, $getRestaurantName);
mysqli_stmt_bind_param($stmtRestaurant, 'i', $id);
mysqli_stmt_execute($stmtRestaurant);
$result2 = mysqli_stmt_get_result($stmtRestaurant);
$name = '';
if ($row = mysqli_fetch_assoc($result2)) {
    $name = $row['name'];
}

// Handle complaint submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['complaint'])) {
    $complaintText = mysqli_real_escape_string($conn, $_POST['complaint']);
    $restaurantId = $id; // Current restaurant ID

    // Insert complaint without needing user_id
    $insertComplaint = "INSERT INTO complaint (restaurant_id, complaint_text) VALUES (?, ?)";
    $stmtComplaint = mysqli_prepare($conn, $insertComplaint);
    mysqli_stmt_bind_param($stmtComplaint, 'is', $restaurantId, $complaintText);
    if (mysqli_stmt_execute($stmtComplaint)) {
        $complaintSuccess = true;
    } else {
        $complaintError = true;
    }
}

// Handle checkout process
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['checkout'])) {
    $quantities = $_POST['quantity'];
    $itemNames = $_POST['item_name'];
    $totalPrice = 0;

    foreach ($quantities as $index => $quantity) {
        if ($quantity > 0) {
            $itemName = mysqli_real_escape_string($conn, $itemNames[$index]);
            $price = mysqli_real_escape_string($conn, $_POST['price'][$index]);
            $totalPrice += $quantity * $price;
        }
    }
    // Redirect to cart.php with total amount
    $_SESSION['total_price'] = $totalPrice;
    header("Location: cart.php");
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
                    <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="order_history.php">History</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php#signup">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="rating.php">Rating</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Menu Section -->
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
                                foreach ($result as $row) {
                                    echo "<tr>";
                                    $item_name = htmlspecialchars($row['item_name']);
                                    $price = htmlspecialchars($row['price']);

                                    echo "<td>$item_name</td>";
                                    echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                                    echo "<td class='price'>$price</td>";
                                    echo "<td><input type='number' class='quantity' name='quantity[]' min='0' max='100' value='0' onchange='updateTotal()'></td>";
                                    echo "<input type='hidden' name='item_name[]' value='$item_name'>";
                                    echo "<input type='hidden' name='price[]' value='$price'>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                            <tr>
                                <td colspan="4" align='center'>
                                    <input type="submit" name="checkout" value="Checkout" class='btn btn-primary'>
                                </td>
                            </tr>
                        </table>
                    </form>

                    <p>Delivery Charge: BDT 60</p>
                    <p>Total: BDT <span id="total">0.00</span></p>
                </div>
            </div>
        </div>
    </section>

    <section class="complaint-section">
        <div class="container px-4 px-lg-5">
            <h2 class="text-center">Submit Your Complaint</h2>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="complaint" class="form-label">Your Complaint</label>
                    <textarea class="form-control" id="complaint" name="complaint" rows="4" style="background-color:#a16468; color:white;" required></textarea>
                </div>
                <button type="submit" class="btn btn-danger">Submit Complaint</button>
            </form>
            <?php if (isset($complaintSuccess)) : ?>
                <div class="alert alert-success mt-3" role="alert">
                    Complaint submitted successfully!
                </div>
            <?php elseif (isset($complaintError)) : ?>
                <div class="alert alert-danger mt-3" role="alert">
                    Error submitting complaint. Please try again later.
                </div>
            <?php endif; ?>
        </div>
    </section>
    
    <footer class="bg-light py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 text-lg-start">© 2024 Map Food</div>
                <div class="col-lg-4 my-3 my-lg-0">
                    <a class="link-dark" href="#">Privacy Policy</a>
                    <span class="mx-1">·</span>
                    <a class="link-dark" href="#">Terms of Use</a>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a class="link-dark" href="#">Contact Us</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        function updateTotal() {
            const prices = document.querySelectorAll('.price');
            const quantities = document.querySelectorAll('.quantity');
            let total = 0;

            quantities.forEach((quantity, index) => {
                total += quantity.value * parseFloat(prices[index].textContent);
            });

            // Add delivery charge (60)
            const deliveryCharge = 60;
            total += deliveryCharge;

            document.getElementById('total').textContent = total.toFixed(2);
        }
    </script>
</body>
</html>
