<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Car Rental || E-Learning HTML Template">

    <title>Car rental</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/media/user/wk.jpg">

    <!-- All CSS files -->
    <link rel="stylesheet" href="assets/css/vendor/font-awesome.css">
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/vendor/slick.css">
    <link rel="stylesheet" href="assets/css/vendor/slick-theme.css">
    <link rel="stylesheet" href="assets/css/vendor/smoothScorllbar.css">
    <link rel="stylesheet" href="assets/css/vendor/classic.css">
    <link rel="stylesheet" href="assets/css/vendor/classic.date.css">
    <link rel="stylesheet" href="assets/css/app.css">

    <!-- Add Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

    <style>
        .car-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            padding: 20px;
        }

        .car-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            width: 300px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            transition: transform 0.4s, box-shadow 0.4s;
            background-color: #ffffff;
        }

        .car-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
        }

        .car-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .car-info {
            padding: 20px;
            transition: background-color 0.4s;
        }

        .car-info:hover {
            background-color: #007bff;
            color: #ffffff;
        }

        .car-info h3 {
            font-size: 24px;
            margin: 10px 0;
            color: #333;
        }

        .car-info p {
            font-size: 16px;
            color: #555;
            margin: 5px 0;
        }

        .car-info:hover h3,
        .car-info:hover p,
        .car-info:hover .price {
            color: #ffffff;
        }

        .price {
            font-size: 20px;
            color: #e63946;
            font-weight: bold;
        }

        .reserve-btn {
            display: inline-block;
            margin-top: 15px;
            padding: 12px 20px;
            background-color: #007bff;
            color: #ffffff;
            font-weight: bold;
            text-transform: uppercase;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.4s;
        }

        .car-info:hover .reserve-btn {
            color: #007bff;
            background-color: #ffffff;
        }

        .reserve-btn:hover {
            background-color: #0056b3;
        }

        .section-title {
            font-size: 36px;
            font-weight: bold;
            text-align: center;
            color: #333;
            margin-bottom: 40px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }
    </style>

</head>

<body class="x-hidden">

    <header class="header my-40">
        <div class="container-fluid">
            <nav class="navigation d-flex align-items-center justify-content-between">
                <a href="index.html" class="logo">
                    <img src="assets/media/user/kt.jpg" alt="/logo" class="header-logo" style="width: 200px;">
                </a>

                <div class="menu-button-right">
                    <div class="main-menu__nav">
                        <ul class="main-menu__list">
                            <li>
                                <a href="index.html">Home</a>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:void(0);">Rental</a>
                                <ul>
                                    <li><a href="rental.html">Rental</a></li>
                                    <li><a href="rental-sidebar.html">Rental sidebar</a></li>
                                    <li><a href="vehicle-details.html">Vehicle details</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="about.html">About us</a>
                            </li>
                            <li>
                                <a href="contact.html">Contact us</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="main-menu__right">
                    <div class="search-heart-icon d-md-flex d-none align-items-center gap-24">
                        <a href="book-now.html" class="cus-btn">
                            <span class="btn-text">
                                Book now
                            </span>
                            <span>
                                Book now
                            </span>
                        </a>
                    </div>
                    <a href="#" class="d-xl-none d-flex main-menu__toggler mobile-nav__toggler">
                        <i class="fa-light fa-bars"></i>
                    </a>
                </div>
            </nav>
        </div>

    </header>

    <section>
        <div class="container py-5">
            <h1 class="section-title">Vehicles Available for Rental</h1>

            <div class="car-list">
                <?php
                // Connect to the database
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "wk4rent";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Query to get available cars
                $sql = "SELECT * FROM automoviles WHERE disponible = 1";
                $result = $conn->query($sql);
                ?>

                <div class="car-grid">
                    <?php
                    // Show available cars
                    if ($result->num_rows > 0) {
                        while ($car = $result->fetch_assoc()) {
                            echo '
                                <div class="car-card">
                                    <img src="' . $car['imagen'] . '" alt="Image of ' . $car['modelo'] . '" class="car-image">
                                    <div class="car-info">
                                        <h3>' . $car['marca'] . ' ' . $car['modelo'] . '</h3>
                                        <p>Year: ' . $car['anio'] . '</p>
                                        <p>Color: ' . $car['color'] . '</p>
                                        <p class="price">Price per day: $' . number_format($car['precio'], 2) . '</p>
                                        <a href="reservaciones.php?id=' . $car['id'] . '" class="reserve-btn">Reserve</a>
                                    </div>
                                </div>';
                        }
                    } else {
                        echo "<p class='text-center'>No cars are available at the moment.</p>";
                    }
                    ?>
                </div>
            </div>
        </div>

    </section>

    <!-- Footer -->
    <footer class="pt-40">
        <div class="container-fluid">
            <div class="row mb-16 row-gap-4">
                <div class="col-lg-3">
                    <div class="txt-block">
                        <a href="index.html">
                            <img src="assets/media/footer/logo.png" alt="logo">
                            <img src="assets/media/footer/Frame-173.png" alt="Frame">
                        </a>
                    </div>
                    <p class="mb-32">Welcome to White Knight vehicle Rental, offering safety, and reliability for
                        international customers in Quintana roo and Yucatan.</p>

                    <h6 class="white mb-16">Subscribe To Our Newsletter</h6>
                    <form action="index.html" class="newsletter-form">
                        <input type="email" name="email" id="eMail" class="form-input"
                            placeholder=" Your email address">
                        <button type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                                fill="none">
                                <g clip-path="url(#clip0_383_5670)">
                                    <path
                                        d="M19.8284 0.171647C19.6626 0.00586635 19.414 -0.0451101 19.1965 0.041921L0.36834 7.57308C0.152911 7.65925 0.00865304 7.86441 0.00037181 8.09632C-0.00787036 8.32819 0.121504 8.54308 0.330254 8.64433L7.75477 12.2451L11.3556 19.6697C11.4538 19.8722 11.6589 19.9999 11.8827 19.9999C11.8896 19.9999 11.8966 19.9998 11.9036 19.9995C12.1355 19.9913 12.3407 19.847 12.4268 19.6316L19.9581 0.803599C20.0451 0.585943 19.9941 0.337389 19.8284 0.171647ZM2.0349 8.16862L16.9812 2.19016L8.07383 11.0974L2.0349 8.16862ZM11.8313 17.9651L8.90246 11.926L17.8099 3.01875L11.8313 17.9651Z"
                                        fill="#2D74BA" />
                                </g>
                            </svg>
                        </button>
                    </form>
                </div>
                <div class="col-lg-5 col-md-8 offset-lg-1">
                    <div class="row">
                        <div class="col-6">
                            <div class="links-block">
                                <h6 class="mb-32">Quick Links</h6>
                                <ul class="unstyled">
                                    <li class="mb-12">
                                        <a href="index.html">Home </a>
                                    </li>
                                    <li class="mb-12">
                                        <a href="about.html">About Us</a>
                                    </li>
                                    <li class="mb-12">
                                        <a href="blogs.html">Blogs</a>
                                    </li>
                                    <li class="mb-12">
                                        <a href="contact.html">Contact Us</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="links-block">
                                <h6 class="mb-32">Information</h6>
                                <ul class="unstyled">
                                    <li class="mb-12">
                                        <a href="rental.html">Rentals</a>
                                    </li>
                                    <li class="mb-12">
                                        <a href="book-now.html">Booking Form</a>
                                    </li>
                                    <li class="mb-12">
                                        <a href="booking.html">Booking Details</a>
                                    </li>
                                    <li class="mb-12">
                                        <a href="index.html">Brands</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4">
                    <div class="links-block">
                        <div class="mb-24">
                            <h6 class="mb-32">Contact info</h6>
                        </div>
                        <ul class="unstyled">
                            <li class="mb-16">
                                <div class="contact">
                                    <img src="assets/media/footer/uil-outgoing-call.png" alt="call-logo">
                                    <a href="tel:+12345678">+52 1 984 164 2359</a>
                                </div>
                            </li>
                            <li class="mb-16">
                                <div class="contact">
                                    <img src="assets/media/footer/uil-map-marker.png" alt="logo">
                                    <p>Playa del Carmen, Quintana roo</p>
                                </div>
                            </li>
                            <li class="mb-24">
                                <div class="contact">
                                    <img src="assets/media/footer/uil-envelope.png" alt="logo">
                                    <a href="mailto:example@company.com">gemacar4rent@gmail.com</a>
                                </div>
                            </li>
                        </ul>
                        <h5>Follow us!</h5>
                        <div class="social-icons mb-12">
                            <ul class="d-flex unstyled gap-12">
                                <li>
                                    <a href="https://www.instagram.com" target="_blank" class="text-white mx-2">
                                        <i class="fab fa-instagram fa-lg"></i>
                                    </a>
                                </li>

                                <li>
                                    <a href="https://www.tiktok.com/@whiteknightcarforrent" target="_blank"
                                        class="text-white mx-2">
                                        <i class="fab fa-tiktok fa-lg"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.facebook.com/61567088864735" target="_blank"
                                        class="text-white mx-2">
                                        <i class="fab fa-facebook fa-lg"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hr-line  bg-light-gray"></div>
            <p class="mt-32 pb-32 text-center">@2024 All Rights Copyright <span class="fw-700 color-sec">White knight
                    vehicle rental car.</span>
                Design & Developed By abnerck</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="assets/js/vendor/jquery.min.js"></script>
    <script src="assets/js/vendor/bootstrap.bundle.min.js"></script>
    <script src="assets/js/vendor/slick.min.js"></script>
    <script src="assets/js/vendor/smooth-scrollbar.js"></script>
    <script src="assets/js/vendor/jquery.datetimepicker.full.js"></script>
    <script src="assets/js/app.js"></script>

</body>

</html>
