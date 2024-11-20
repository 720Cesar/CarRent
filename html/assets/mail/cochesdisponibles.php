<?php
// Incluye la conexión
include('bd.php');

// Obtener coches disponibles
$sql = "SELECT * FROM automoviles WHERE disponible = 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Mostrar coches disponibles
    while($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<img src='".$row['imagen']."' alt='".$row['modelo']."' />";
        echo "<h3>".$row['marca']." ".$row['modelo']."</h3>";
        echo "<p>Año: ".$row['anio']."</p>";
        echo "<p>Color: ".$row['color']."</p>";
        echo "<p>Precio por día: $".$row['precio']."</p>";
        echo "<p><a href='reserva.php?id=".$row['id']."'>Reservar</a></p>";
        echo "</div>";
    }
} else {
    echo "No hay coches disponibles.";
}

$conn->close();
?>
