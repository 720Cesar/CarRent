<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags and CSS links -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Reservation</title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/media/user/wk.jpg">
    <!-- CSS Files -->
    <link rel="stylesheet" href="assets/css/vendor/font-awesome.css">
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/app.css">

    <!-- Permite el uso de AJAX -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        .form-container {
            padding: 30px;
            border-radius: 15px;
            background-color: #f8f9fa;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .form-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

        .form-label {
            font-weight: bold;
            color: #555;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 10px;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            background-color: #007bff;
            color: white;
            text-align: center;
            font-weight: bold;
            padding: 15px;
        }

        .card-body {
            padding: 20px;
        }

        .summary-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .summary-icon {
            font-size: 24px;
            color: #007bff;
            margin-right: 15px;
        }

        .summary-label {
            font-weight: bold;
            color: #333;
            width: 150px;
        }

        .summary-value {
            flex: 1;
            font-size: 16px;
            color: #555;
        }

        .card-footer {
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
            background-color: #f1f1f1;
            padding: 20px;
            text-align: center;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn-success:hover {
            background-color: #218838;
            transform: translateY(-2px);
        }
    </style>
</head>

<body class="x-hidden">

    <!-- Header -->
    <header class="header my-40">
        <div class="container-fluid">
            <nav class="navigation d-flex align-items-center justify-content-between">
                <a href="index.html" class="logo">
                    <img src="assets/media/user/kt.jpg" alt="/logo" class="header-logo" style="width: 200px;">
                </a>

                <div class="menu-button-right">
                    <div class="main-menu__nav">
                        <ul class="main-menu__list">
                            <li><a href="index.html">Home</a></li>
                            <li class="dropdown">
                                <a href="javascript:void(0);">Rental</a>
                                <ul>
                                    <li><a href="rental.html">Rental</a></li>
                                    <li><a href="rental-sidebar.html">Rental sidebar</a></li>
                                    <li><a href="vehicle-details.html">Vehicle details</a></li>
                                </ul>
                            </li>
                            <li><a href="about.html">About us</a></li>
                            <li><a href="contact.html">Contact us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="main-menu__right">
                    <div class="search-heart-icon d-md-flex d-none align-items-center gap-24">
                        <a href="book-now.html" class="cus-btn">
                            <span class="btn-text">Book now</span>
                            <span>Book now</span>
                        </a>
                    </div>
                    <a href="#" class="d-xl-none d-flex main-menu__toggler mobile-nav__toggler">
                        <i class="fa-light fa-bars"></i>
                    </a>
                </div>
            </nav>
        </div>
    </header>

    <main>
    <script>
        $(document).ready(function() {
            $('#btn-goBack').on('click', function() {
                //Función para eliminar el registro de reserva
                $.ajax({
                    url: 'delete_info.php', 
                    type: 'POST',           
                    data: {},      
                    success: function(response) {
                        console.log('Registro eliminado exitosamente');
                        
                        window.location.href = 'http://localhost/wk4rent/html/allcoches.php';
                    },
                    error: function() {
                        console.error('Error de eliminación');
                        alert('Error en la eliminación');
                    }
                });
            });
        });
    </script>

    <h1 class="mb-4 text-center"><strong> PAYMENT DECLINED </strong></h1>
    <p class="text-muted text-center"> We are sorry! The payment process was interrupted, please try again</p>

    <div style="display: flex; justify-content: center; align-items: center; height: 15vh;">
        <button type="button" class="btn btn-danger" id="btn-goBack">Go back</button>

    </div>

    </main>

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
                        <input type="email" name="email" id="eMail" class="form-input" placeholder=" Your email address">
                        <button type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <g clip-path="url(#clip0_383_5670)">
                                    <path d="M19.8284 0.171647C19.6626 0.00586635 19.414 -0.0451101 19.1965 0.041921L0.36834 7.57308C0.152911 7.65925 0.00865304 7.86441 0.00037181 8.09632C-0.00787036 8.32819 0.121504 8.54308 0.330254 8.64433L7.75477 12.2451L11.3556 19.6697C11.4538 19.8722 11.6589 19.9999 11.8827 19.9999C11.8896 19.9999 11.8966 19.9998 11.9036 19.9995C12.1355 19.9913 12.3407 19.847 12.4268 19.6316L19.9581 0.803599C20.0451 0.585943 19.9941 0.337389 19.8284 0.171647ZM2.0349 8.16862L16.9812 2.19016L8.07383 11.0974L2.0349 8.16862ZM11.8313 17.9651L8.90246 11.926L17.8099 3.01875L11.8313 17.9651Z" fill="#2D74BA" />
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
                                    <a href="https://www.tiktok.com/@whiteknightcarforrent" target="_blank" class="text-white mx-2">
                                        <i class="fab fa-tiktok fa-lg"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.facebook.com/61567088864735" target="_blank" class="text-white mx-2">
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

    <!-- JS -->
    <script src="assets/js/vendor/bootstrap.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>
</html>

