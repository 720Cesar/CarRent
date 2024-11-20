<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta etiquetas y enlaces a CSS -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car rental</title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/media/user/wk.jpg">
    <!-- Archivos CSS -->
    <link rel="stylesheet" href="assets/css/vendor/font-awesome.css">
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/vendor/slick.css">
    <link rel="stylesheet" href="assets/css/vendor/slick-theme.css">
    <link rel="stylesheet" href="assets/css/vendor/smoothScorllbar.css">
    <link rel="stylesheet" href="assets/css/vendor/classic.css">
    <link rel="stylesheet" href="assets/css/vendor/classic.date.css">
    <link rel="stylesheet" href="assets/css/app.css">
</head>

<body class="x-hidden">

    <!-- Header (respetando el diseño anterior) -->
    <header class="header my-40">
        <div class="container-fluid">
            <nav class="navigation d-flex align-items-center justify-content-between">
                <a href="index.html" class="logo">
                    <img src="assets/media/user/kt.jpg" alt="/logo" class="header-logo" style="width: 200px;">
                </a>

                <style>
                    .logo h2 {
                        font-family: 'Haarlem Sans';
                        font-size: 50px;
                        font-weight: bold;
                        color: #333;
                        margin: 0;
                        padding: 0;
                        text-transform: uppercase;
                    }
                </style>
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
                                <!-- SVG aquí -->
                            </span>
                            <span>
                                Book now
                                <!-- SVG aquí -->
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

    <!-- PHP Reserva (con formato Bootstrap en el contenido principal) -->
    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                <?php

                if(isset($_GET['external_reference'])){
                
                    $externalReference = $_GET['external_reference'];


                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "wk4rent";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("<div class='alert alert-danger'>Conexión fallida: " . $conn->connect_error . "</div>");
                    }

                    $sql = "SELECT * FROM `reservas` WHERE `external_reference` = ?;";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s",$externalReference);
                    $stmt->execute();

                    //$stmt->bind_result($columna1, $columna2);

                    $transaccion = $stmt->fetch();

                    if ($transaccion) {
                        echo "<h1>Datos de la Transacción</h1>";
                        echo "<p>ID Auto: " . $transaccion['id_auto'] . "</p>";
                        echo "<p>Total: " . $transaccion['total'] . "</p>";
                        echo "<p>Cliente: " . $transaccion['nombre_cliente'] . "</p>";
                        echo "<p>Email: " . $transaccion['email_cliente'] . "</p>";
                        echo "<p>Ubicación: " . $transaccion['ubicacion_entrega'] . "</p>";
                        echo "<p>Fechas: " . $transaccion['fecha_inicio'] . " a " . $transaccion['fecha_fin'] . "</p>";
                    } else {
                        echo "<p>Error por la falta de datos.</p>";
                    }
            }

                ?>
            </div>
        </div>
    </div>

    <!-- JavaScript Files -->
    <script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="assets/js/vendor/bootstrap.bundle.min.js"></script>

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
                                    <path d="M19.8284 0.171647C19.6626 0.00586635 19.414 -0.0451101 19.1965 0.041921L0.36834 7.57308C0.152911 7.65925 0.00865304 7.86441 0.00037181 8.09632C-0.00787036 8.32819 0.121504 8.54308 0.330254 8.64433L7.75477 12.2451L11.3556 19.6697C11.4538 19.8722 11.6589 19.9999 11.8827 19.9999C11.8896 19.9999 11.8966 19.9998 11.9036 19.9995C12.1355 19.9913 12.3407 19.847 12.4268 
