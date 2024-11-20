<?php
// conexion.php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'wk4rent';

try {
    // Activar reporte de errores de mysqli
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    // Intentar conectar a la base de datos
    $conn = new mysqli($host, $user, $password, $dbname);
    
    // Confirmación si la conexión es exitosa
    echo "Conexión exitosa a la base de datos: $dbname";

} catch (mysqli_sql_exception $e) {
    // Si ocurre un error en la conexión, muestra el mensaje
    die("Conexión fallida: " . $e->getMessage());
}

$sql = "SELECT * FROM automoviles WHERE disponible = 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $coches = [];
    while($row = $result->fetch_assoc()) {
        $coches[] = $row;
    }
} else {
    $coches = [];
}


?>
