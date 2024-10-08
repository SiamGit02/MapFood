<?php
session_start();

// Get total amount from session
$totalAmount = isset($_SESSION['total_price']) ? $_SESSION['total_price'] : 0;

// Handle payment submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cardNumber = $_POST['card_number'];
    $expiration = $_POST['expiration'];
    $cvv = $_POST['cvv'];
    
    // Here you can process the payment
    // For example, store card details and amount in the database
    // Or integrate with a payment gateway API

    // If payment is successful, redirect to a success page
    header("Location: payment_success.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - Map Food</title>
    <link href="css/style.css" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <h2>Your Total: BDT <?php echo number_format($totalAmount, 2); ?></h2>
        <form action="" method="post">
            <div class="mb-3">
                <label for="card_number">Card Number</label>
                <input type="text" id="card_number" name="card_number" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="expiration">Expiration Date</label>
                <input type="text" id="expiration" name="expiration" class="form-control" required placeholder="MM/YY">
            </div>
            <div class="mb-3">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit Payment</button>
        </form>
    </div>
</body>
</html>
