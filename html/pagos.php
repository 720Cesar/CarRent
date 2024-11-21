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

                    $payment_id = $_GET['payment_id'];
                    $id_auto = $_GET['external_reference'];
                    $status = $_GET['status'];
                    
                    require '../vendor/autoload.php';

                    use MercadoPago\MercadoPagoConfig;
                    use MercadoPago\Client\Preference\PreferenceClient;
                    use MercadoPago\Resources\Payment;
                    use MercadoPago\Client\Payment\PaymentClient;


                    MercadoPagoConfig::setAccessToken("TEST-2221383748999612-111815-1d20bf7cec550a1fa34354c6d415f622-386056396");

                    $client = new PaymentClient();

                    // echo $payment_id;
                    // echo $id_auto;
                    // echo $status;

                    // Conexión a la base de datos
                    $conexion = new mysqli("localhost", "root", "", "wk4rent");

                    if ($conexion->connect_error) {
                        die("Conexión fallida: " . $conexion->connect_error);
                    }
                    
                    $sql_ultimo_id = "SELECT MAX(id) AS ultimo_id FROM reservas";

                    $result = $conexion->query($sql_ultimo_id);

                    if ($result->num_rows > 0) {
                        // Obtener el último ID
                        $row = $result->fetch_assoc();
                        $ultimo_id = $row['ultimo_id'];
                    } else {
                        echo "No se encontraron registros.";
                    }

                    $update_sql = "UPDATE reservas SET id_payment = '$payment_id' WHERE id = '$ultimo_id'";
                    if ($conexion->query($update_sql) === TRUE) {
                        //echo "Registro actualizado correctamente.";
                    } else {
                        echo "Error al actualizar: " . $conexion->error;
                    }

                    $update_sql2 = "UPDATE reservas SET status = '$status' WHERE id_payment = '$payment_id'";
                    if ($conexion->query($update_sql2) === TRUE) {
                        //echo "Status actualizado.";
                    } else {
                        echo "Error al actualizar: " . $conexion->error;
                    }
                    
                    $update_sql3 = "UPDATE automoviles SET disponible = 0 WHERE id = $id_auto";
                    if ($conexion->query($update_sql3) === TRUE) {
                        //echo "Disponibilidad actualizado.";
                    } else {
                        echo "Error al actualizar: " . $conexion->error;
                    }

                    $sqlReservas = "SELECT * FROM reservas WHERE id_payment = ?";

                    $stmt = $conexion->prepare($sqlReservas);
                    $stmt->bind_param("i", $payment_id);  // El parámetro 'i' es para un entero
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                    
                        // Asignar los datos a las variables
                        $id_auto = $row['id_auto'];
                        $nombre_cliente = $row['nombre_cliente'];
                        $telefono_cliente = $row['telefono_cliente'];
                        $email_cliente = $row['email_cliente'];
                        $ubicacion_entrega = $row['ubicacion_entrega'];
                        $fecha_inicio = $row['fecha_inicio'];
                        $fecha_fin = $row['fecha_fin'];
                        $dias = $row['dias'];
                        $total = $row['total'];
                    } else {
                        echo "No se encontró el registro.";
                        exit;  // Terminar ejecución si no se encuentra el auto
                    }
                    

                    $car_sql = "SELECT marca, modelo, precio FROM automoviles WHERE id = $id_auto";
                    $car_result = $conexion->query($car_sql);
                    if ($car_result->num_rows > 0) {
                        $car = $car_result->fetch_assoc();
                        echo "<li class='list-group-item'><strong>Car:</strong> " . htmlspecialchars($car['marca']) . " " . htmlspecialchars($car['modelo']) . "</li>";
                        echo "<li class='list-group-item'><strong>Price per Day:</strong> $" . number_format($car['precio'], 2) . "</li>";
                    }
                    echo "</ul>";

                    // Cerrar la conexión
                    $stmt->close();
                    $conexion->close();

                    echo "<div class='alert alert-success'>Reservation completed successfully</div>";
                    echo "<ul class='list-group'>";
                    echo "<li class='list-group-item'><strong>Name:</strong> $nombre_cliente</li>";
                    echo "<li class='list-group-item'><strong>Phone Number:</strong> $telefono_cliente</li>";
                    echo "<li class='list-group-item'><strong>Email:</strong> $email_cliente</li>";
                    echo "<li class='list-group-item'><strong>Delivery Location:</strong> $ubicacion_entrega</li>";
                    echo "<li class='list-group-item'><strong>Start Date:</strong> $fecha_inicio</li>";
                    echo "<li class='list-group-item'><strong>End Date:</strong> $fecha_fin</li>";
                    echo "<li class='list-group-item'><strong>Days:</strong> $dias</li>";
                    echo "<li class='list-group-item'><strong>Total Amount to Pay:</strong> $" . number_format($total, 2) . "</li>";
                    


                ?>
            </div>
        </div>


        <form method="post" action="generar_pdf.php" class="mt-3">
        <!-- Campos ocultos para pasar los datos -->
            <input type="hidden" name="id_auto" value="<?= htmlspecialchars($id_auto); ?>">
            <input type="hidden" name="nombre_cliente" value="<?= htmlspecialchars($nombre_cliente); ?>">
            <input type="hidden" name="telefono_cliente" value="<?= htmlspecialchars($telefono_cliente); ?>">
            <input type="hidden" name="email_cliente" value="<?= htmlspecialchars($email_cliente); ?>">
            <input type="hidden" name="ubicacion_entrega" value="<?= htmlspecialchars($ubicacion_entrega); ?>">
            <input type="hidden" name="fecha_inicio" value="<?= htmlspecialchars($fecha_inicio); ?>">
            <input type="hidden" name="fecha_fin" value="<?= htmlspecialchars($fecha_fin); ?>">
            <input type="hidden" name="dias" value="<?= htmlspecialchars($dias); ?>">
            <input type="hidden" name="total" value="<?= htmlspecialchars($total); ?>">
            <button type="submit" class="btn btn-secondary">Descargar PDF</button>
        </form>

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
