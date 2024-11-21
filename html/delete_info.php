<?php

    $conexion = new mysqli("localhost", "root", "", "wk4rent");


    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    $sql_ultimo_id = "SELECT MAX(id) AS ultimo_id FROM reservas";

    $result = $conexion->query($sql_ultimo_id);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
        $ultimo_id = $row['ultimo_id'];
    } else {
        echo "No se encontraron registros.";
    }

    $sql = "DELETE FROM reservas WHERE id = $ultimo_id";

    $result = $conexion->query($sql);

    if ($result->affected_rows > 0) {
        echo "Registro eliminado exitosamente.";
    } else {
        echo "No se encontró el registro o hubo un error al eliminar.";
    }

    $conexion->close();

?>