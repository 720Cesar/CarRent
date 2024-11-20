<?php
// Verificar que los datos fueron enviados correctamente
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_coche = $_POST['id_coche'];
    $dias = $_POST['dias'];
    $ubicacion = $_POST['ubicacion'];
    $precio_total = $_POST['precio_total'];

    // Mostrar los datos de la reserva y simular el proceso de pago
    echo "<h1>Confirmación de Reserva</h1>";
    echo "<p>Gracias por tu reserva. A continuación se muestra el resumen de tu solicitud:</p>";
    echo "<p>Coche seleccionado: ID " . $id_coche . "</p>";
    echo "<p>Cantidad de días: " . $dias . "</p>";
    echo "<p>Ubicación de entrega: " . $ubicacion . "</p>";
    echo "<p>Precio total: $" . number_format($precio_total, 2) . "</p>";
    
    // Simulando el proceso de pago
    echo "<p><strong>¡Pago procesado con éxito!</strong></p>";
    echo "<p>Recibirás un correo electrónico con los detalles de tu reserva.</p>";
} else {
    echo "No se han recibido los datos de pago.";
}
?>
