<?php    

    // Conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "", "wk4rent");

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }
 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Recibir los datos del formulario
    $id_auto = $_POST['id_auto'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $dias = $_POST['dias'];
    $total = $_POST['total'];
    $ubicacion_entrega = $_POST['ubicacion_entrega'];
    $nombre_cliente = $_POST['nombre_cliente'];
    $telefono_cliente = $_POST['telefono_cliente'];
    $email_cliente = $_POST['email_cliente'];
    

    // Insertar los datos en la base de datos
    $query = "INSERT INTO reservas (id_auto, total, nombre_cliente, telefono_cliente, email_cliente, ubicacion_entrega, fecha_inicio, fecha_fin, dias, status, id_payment) 
            VALUES ('$id_auto', '$total', '$nombre_cliente', '$telefono_cliente', '$email_cliente', '$ubicacion_entrega', '$fecha_inicio', '$fecha_fin', '$dias', null, null)";

    if ($conexion->query($query) === TRUE) {
        echo json_encode(["success" => true, "message" => "Datos guardados correctamente"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al guardar los datos: " . $conexion->error]);
    }

  }  
  // Cerrar la conexión
    $conexion->close();

?>