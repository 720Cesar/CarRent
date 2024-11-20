<?php
include('bd.php');  // Incluir el archivo de conexión

// Verificar la conexión
if ($conn->connect_error) {
    echo "Conexión fallida: " . $conn->connect_error;
} else {
    echo "Conexión exitosa a la base de datos $dbname";
}

// Cerrar la conexión después de la prueba
$conn->close();
?>
