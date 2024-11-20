<?php
// Incluye la conexión
include('bd.php');

// Inicializar variables
$precio_total = null;
$coche = null;

// Verifica si se pasó el parámetro id en la URL
if (isset($_GET['id'])) {
    $id_coche = $_GET['id'];

    // Obtener detalles del coche basado en el id
    $sql = "SELECT * FROM automoviles WHERE id = $id_coche";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Guardamos los detalles del coche
        $coche = $result->fetch_assoc();
        echo "<h1>Reservar: ".$coche['marca']." ".$coche['modelo']."</h1>";
        echo "<img src='".$coche['imagen']."' alt='".$coche['modelo']."' />";
        echo "<p>Año: ".$coche['anio']."</p>";
        echo "<p>Color: ".$coche['color']."</p>";
        echo "<p>Precio por día: $".$coche['precio']."</p>";

        // Verifica si el formulario ha sido enviado
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $dias = $_POST['dias'];
            $ubicacion = $_POST['ubicacion'];

            // Calcular el precio total
            $precio_total = $coche['precio'] * $dias;

            // Mostrar el precio total
            echo "<h2>Resumen de tu reserva:</h2>";
            echo "<p>Precio por día: $" . number_format($coche['precio'], 2) . "</p>";
            echo "<p>Cantidad de días: " . $dias . "</p>";
            echo "<p>Precio total: $" . number_format($precio_total, 2) . "</p>";
            echo "<p>Ubicación de entrega: " . $ubicacion . "</p>";

            // Botón de pago (por ahora simula el pago)
            echo '<form method="POST" action="pago.php">';
            echo '<input type="hidden" name="id_coche" value="'.$coche['id'].'">';
            echo '<input type="hidden" name="dias" value="'.$dias.'">';
            echo '<input type="hidden" name="ubicacion" value="'.$ubicacion.'">';
            echo '<input type="hidden" name="precio_total" value="'.$precio_total.'">';
            echo '<input type="submit" value="Pagar Ahora">';
            echo '</form>';

        } else {
            // Si no se ha enviado el formulario, mostrar el formulario para días y ubicación
            echo '<form method="POST" action="reserva.php?id='.$coche['id'].'">';
            echo '<label for="dias">¿Cuántos días lo vas a rentar?</label>';
            echo '<input type="number" id="dias" name="dias" required min="1">';
            echo '<label for="ubicacion">Ubicación de entrega:</label>';
            echo '<input type="text" id="ubicacion" name="ubicacion" required>';
            echo '<input type="hidden" name="id_coche" value="'.$coche['id'].'">';
            echo '<input type="submit" value="Calcular precio">';
            echo '</form>';
        }
    } else {
        echo "Coche no encontrado.";
    }
} else {
    echo "No se ha seleccionado ningún coche.";
}

$conn->close();
?>
