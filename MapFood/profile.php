<?php
require_once('dbconnect.php');
session_start(); // Start the session to access session variables

// Check if the user is logged in
$user_email = $_SESSION['email'] ?? ''; // Use the email stored in session

if (empty($user_email)) {
    die("User is not logged in.");
}

// Update user information
if (isset($_POST['update'])) {
    $user_id = $_POST['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];

    $sql = "UPDATE users SET first_name='$first_name', last_name='$last_name', email='$email', contact='$contact' WHERE user_id=$user_id";
    if ($conn->query($sql) === TRUE) {
        $message = "Record updated successfully";
    } else {
        $message = "Error updating record: " . $conn->error;
    }
}

// Fetch user data based on email
$sql = "SELECT * FROM users WHERE email='$user_email'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Map Food - User Profile</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/style.css" rel="stylesheet" />
</head>
<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="#page-top">Map Food</a>
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
    
    <!-- Masthead-->
    <header class="masthead">
        <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
            <div class="d-flex justify-content-center">
                <div class="text-center">
                    <h1 class="mx-auto my-0 text-uppercase">User Profile</h1>
                    <h2 class="text-white-50 mx-auto mt-2 mb-5">Update your profile information</h2>
                </div>
            </div>
        </div>
    </header>

    <!-- User Profile Section-->
    <section class="profile-section text-center" id="profile">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    <?php if (isset($message)) { echo "<div class='alert alert-info'>$message</div>"; } ?>
                    <form method="POST" action="">
                        <?php
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            echo "<div class='form-group'>
                                <label for='first_name'>First Name</label>
                                <input class='form-control' type='text' id='first_name' name='first_name' value='".$row["first_name"]."'>
                            </div>
                            <div class='form-group'>
                                <label for='last_name'>Last Name</label>
                                <input class='form-control' type='text' id='last_name' name='last_name' value='".$row["last_name"]."'>
                            </div>
                            <div class='form-group'>
                                <label for='email'>Email</label>
                                <input class='form-control' type='email' id='email' name='email' value='".$row["email"]."'>
                            </div>
                            <div class='form-group'>
                                <label for='contact'>Contact</label>
                                <input class='form-control' type='text' id='contact' name='contact' value='".$row["contact"]."'>
                            </div>
                            <input type='hidden' name='user_id' value='".$row["user_id"]."'>
                            <button class='btn btn-primary mt-4' type='submit' name='update'>Update</button>";
                        } else {
                            echo "<p>No user found</p>";
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer-->
    <footer class="footer bg-black small text-center text-white-50">
        <div class="container px-4 px-lg-5">Copyright &copy; Map Food</div>
        <div class="container px-4 px-lg-5">
            <img src="images/ErrorSage/ERROR SAGE Logo [Color].png" alt="" width="150px">
        </div>
    </footer>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>
</html>

<?php
$conn->close();
?>
