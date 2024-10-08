<?php
    require_once('dbconnect.php');

    // session_start();

    // if($_SERVER["REQUEST_METHOD"] == "POST") {

    //     $orderStation = $_POST['orderStation'];
    //     $sql = "SELECT * FROM restaurants WHERE location = '$orderStation'";
    //     $result = mysqli_query($conn, $sql);
    //     $count = mysqli_num_rows($result);
    //     if($count == 0) {
    //         echo "<script> no restaurant found </script>";
    //     }
    //     else {
    //         // header("Location: restaurantSelection.php");
    //     }
    // }
    
    if(isset($_POST['showRestaurants'])){
        header("Location: restaurantSelection.php#availableRestaurants");
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
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/style.css" rel="stylesheet" />
        <link href="css/bookingStyle.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
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
        <!-- Masthead-->
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
        <!-- About-->
        <section class="about-section text-center" id="about">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8">
                        <h2 class="text-white mb-4">Welcome to Map Food - Your Ultimate Train Journey Food Companion!
                        </h2>
                        <p class="text-white-50">
                        At Map Food, we understand that a satisfying journey involves more than just reaching your destination. It's about the experiences you gather along the way, including the food you enjoy. Our mission is to transform your train journeys into delightful culinary adventures, ensuring that you not only travel comfortably but also dine luxuriously.
                        </p>
                    </div>
                </div>
                <img class="img-fluid" src="images/10784.jpg" alt="..." width=500px />
            </div>
        </section>
        <!-- Restaurant Selection-->
        <section id="restaurantSelection">

        
        <div id="booking" class="section">
		<div class="section-center">
			<div class="container">
				<div class="row">
					<div class="booking-form">
						<form action="restaurantSelection.php#availableRestaurants" method="post">
							
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<span class="form-label">Current Station</span>
										<select name="currentStation" id="currentStation" class="form-control">
                                        <option value="Dhaka " name="das">Dhaka</option>
                            <option value="Mirpur" name="mirpur">Mirpur</option>
                            <option value="Gulsan" name="nsd">Gulsan</option>
                            <option value="Aftabnagar" name="aftabnagar">Aftabnagar</option>
                            <option value="Dhanmondi" name="nsd">Dhanmondi</option>
                            <option value="Cumilla" name="cumilla">Cumilla</option>
                            <option value="Bramhanbaria" name="bramhanbaria">Bramhanbaria</option>
                            <option value="Feni" name="feni">Feni</option>
                            
                        </select>
                        <span class="select-arrow"></span>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<span class="form-label">Order Station</span>
										<select name="orderStation" id="orderStation" class="form-control">
                            <option value="Mirpur" name="mirpur">Mirpur</option>
                            <option value="DU" name="du">DU</option>
                            <option value="EWU" name="ewu">EWU</option>
                          
                        </select>
                        <span class="select-arrow"></span>
									</div>
								</div>
							</div>
							
							<div class="row">
								
								<div class="col-md-3">
									<div class="form-btn" >
										
                                        <input type="submit" value="Show Restaurants" class="submit-btn" name="showRestaurants">
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
    </section>















        <!-- <section class="restaurant-selection" id="restaurantSelection">
            <form action="dashboard.php" method="post">
                <table>
                    <tr>
                        <th>Current Station</th> <th>Order Station</th>
                    </tr>
                    <tr>
                        <td>
                        <select name="currentStation" id="currentStation">
                            <option value="Cumilla" name="cumilla">Cumilla</option>
                            <option value="Bramhanbaria" name="bramhanbaria">Bramhanbaria</option>
                            <option value="Feni" name="feni">Feni</option>
                        </select>
                        </td>
                        <td>
                        <select name="orderStation" id="orderStation">
                            <option value="Cumilla" name="cumilla">Cumilla</option>
                            <option value="Bramhanbaria" name="bramhanbaria">Bramhanbaria</option>
                            <option value="Feni" name="feni">Feni</option>
                        </select>
                        </td>
                        
                    </tr>
                </table>
            </form> -->
        </section>
        <!-- Signup-->
        <section class="signup-section" id="signup">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5">
                    <div class="col-md-10 col-lg-8 mx-auto text-center">
                        <i class="far fa-paper-plane fa-2x mb-2 text-white"></i>
                        <h2 class="text-white mb-5">Subscribe to receive updates!</h2>
                        <!-- * * * * * * * * * * * * * * *-->
                        <!-- * * SB Forms Contact Form * *-->
                        <!-- * * * * * * * * * * * * * * *-->
                        <!-- This form is pre-integrated with SB Forms.-->
                        <!-- To make this form functional, sign up at-->
                        <!-- https://startbootstrap.com/solution/contact-forms-->
                        <!-- to get an API token!-->
                        <form class="form-signup" id="contactForm" data-sb-form-api-token="API_TOKEN">
                            <!-- Email address input-->
                            <div class="row input-group-newsletter">
                                <div class="col"><input class="form-control" id="emailAddress" type="email" placeholder="Enter email address..." aria-label="Enter email address..." data-sb-validations="required,email" /></div>
                                <div class="col-auto"><button class="btn btn-primary disabled" id="submitButton" type="submit">Notify Me!</button></div>
                            </div>
                            <div class="invalid-feedback mt-2" data-sb-feedback="emailAddress:required">An email is required.</div>
                            <div class="invalid-feedback mt-2" data-sb-feedback="emailAddress:email">Email is not valid.</div>
                            <!-- Submit success message-->
                            <!---->
                            <!-- This is what your users will see when the form-->
                            <!-- has successfully submitted-->
                            <div class="d-none" id="submitSuccessMessage">
                                <div class="text-center mb-3 mt-2 text-white">
                                    <div class="fw-bolder">Form submission successful!</div>
                                    To activate this form, sign up at
                                    <br />
                                    <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                                </div>
                            </div>
                            <!-- Submit error message-->
                            <!---->
                            <!-- This is what your users will see when there is-->
                            <!-- an error submitting the form-->
                            <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3 mt-2">Error sending message!</div></div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- Contact-->
        <section class="contact-section bg-black">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5">
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card py-4 h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-map-marked-alt text-primary mb-2"></i>
                                <h4 class="text-uppercase m-0">Address</h4>
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
                                <div class="small text-black-50"><a href="#!">error.sage@gmail.com</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card py-4 h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-mobile-alt text-primary mb-2"></i>
                                <h4 class="text-uppercase m-0">Phone</h4>
                                <hr class="my-4 mx-auto" />
                                <div class="small text-black-50">+880 1602441585</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="social d-flex justify-content-center">
                    <a class="mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                    <a class="mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                    <a class="mx-2" href="#!"><i class="fab fa-github"></i></a>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="footer bg-black small text-center text-white-50"><div class="container px-4 px-lg-5">Copyright &copy; ErrorSage</div> <div class="container px-4 px-lg-5"><img src="images/ErrorSage/ERROR SAGE Logo [Color].png" alt="" width=150px></div></footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
