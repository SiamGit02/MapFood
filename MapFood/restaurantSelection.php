<?php
require_once('dbconnect.php');

// Get the order station from the POST request
$orderStation = $_POST['orderStation'];

// SQL query to get restaurants and their average ratings
$sql = "
    SELECT r.id, r.name, r.contact, AVG(rt.rating) as average_rating 
    FROM restaurants r
    LEFT JOIN rating rt ON r.id = rt.restaurant_id
    WHERE r.location = '$orderStation'
    GROUP BY r.id
";
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
                    <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="order_history.php">History</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php#signup">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="rating.php">Rating</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <header class="masthead">
        <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
            <div class="d-flex justify-content-center">
                <div class="text-center">
                    <h1 class="mx-auto my-0 text-uppercase">Map Food</h1>
                    <h2 class="text-white-50 mx-auto mt-2 mb-5">Order food while on train</h2>
                    <a class="btn btn-primary" href="#about">Explore</a>
                </div>
            </div>
        </div>
    </header>
    <section class="about-section text-center" id="about">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    <h2 class="text-white mb-4">Welcome to Map Food - Your Ultimate Train Journey Food Companion!</h2>
                    <p class="text-white-50">
                    At Map Food, we understand that a satisfying journey involves more than just reaching your destination. It's about the experiences you gather along the way, including the food you enjoy. Our mission is to transform your train journeys into delightful culinary adventures, ensuring that you not only travel comfortably but also dine luxuriously.
                    </p>
                </div>
            </div>
            <img class="img-fluid" src="images/10784.jpg" alt="..." width=500px />
        </div>
    </section>
    <section id="availableRestaurants">
        <div class="container mt-5 px-2">
            <div class="mb-2 d-flex justify-content-between align-items-center"></div>
            <div class="table-responsive">
                <table class="table table-responsive table-borderless">
                    <thead>
                        <tr class="bg-light">
                            <th scope="col" width="20%">Restaurants</th>
                            <th scope="col" width="10%">Contact</th>
                            <th scope="col" width="10%">Rating</th>
                            <th scope="col" width="20%">Check Menu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = $conn->query($sql);
                        if ($result === false) {
                            die("Query failed: " . $conn->error);
                        }

                        foreach ($result as $row) {
                            echo "<tr>";
                            $getRestaurantID = $row['id'];
                            $restaurantName = htmlspecialchars($row['name']);
                            $averageRating = $row['average_rating'] ? number_format($row['average_rating'], 1) : 'No ratings yet';
                            echo "<td>" . $restaurantName . "</td>";
                            echo "<td>" . htmlspecialchars($row['contact']) . "</td>";
                            echo "<td>" . htmlspecialchars($averageRating) . "</td>";
                            echo "<td><a href='menu.php?id=$getRestaurantID'>Check Menu</a></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <section class="signup-section" id="signup">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5">
                <div class="col-md-10 col-lg-8 mx-auto text-center">
                    <i class="far fa-paper-plane fa-2x mb-2 text-white"></i>
                    <h2 class="text-white mb-5">Subscribe to receive updates!</h2>
                    <form class="form-signup" id="contactForm" data-sb-form-api-token="API_TOKEN">
                        <div class="row input-group-newsletter">
                            <div class="col"><input class="form-control" id="emailAddress" type="email" placeholder="Enter email address..." aria-label="Enter email address..." data-sb-validations="required,email" /></div>
                            <div class="col-auto"><button class="btn btn-primary disabled" id="submitButton" type="submit">Notify Me!</button></div>
                        </div>
                        <div class="invalid-feedback mt-2" data-sb-feedback="emailAddress:required">An email is required.</div>
                        <div class="invalid-feedback mt-2" data-sb-feedback="emailAddress:email">Email is not valid.</div>
                        <div class="d-none" id="submitSuccessMessage">
                            <div class="text-center mb-3 mt-2 text-white">
                                <div class="fw-bolder">Form submission successful!</div>
                                To activate this form, sign up at
                                <br />
                                <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                            </div>
                        </div>
                        <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3 mt-2">Error sending message!</div></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="contact-section bg-black">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5">
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-map-marked-alt text-primary mb-2"></i>
                            <h4 class="text-uppercase m-0">Location</h4>
                            <hr class="my-4 mx-auto" />
                            <div class="small text-black-50">Dhaka, Bangladesh</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-envelope text-primary mb-2"></i>
                            <h4 class="text-uppercase m-0">Email</h4>
                            <hr class="my-4 mx-auto" />
                            <div class="small text-black-50">info@mapfood.com</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-phone text-primary mb-2"></i>
                            <h4 class="text-uppercase m-0">Phone</h4>
                            <hr class="my-4 mx-auto" />
                            <div class="small text-black-50">+880-1788-214564</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="footer bg-black small text-center text-white-50">
        <div class="container px-4 px-lg-5">Copyright &copy; Map Food 2023</div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>
</html>
