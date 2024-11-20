<?php
// Iniciar sesión para almacenar el mensaje
session_start();

// Incluir las clases de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Cargar el autoloader de Composer
require __DIR__ . '/../../../vendor/autoload.php';

// Crear una instancia de PHPMailer
$mail = new PHPMailer(true);

try {
    // Configuración del servidor SMTP
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'abnerck9@gmail.com';
    $mail->Password   = 'viig xfjk xomv thzt';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Destinatarios
    $mail->setFrom('abnerck9@gmail.com', 'Formulario de Contacto');
    $mail->addAddress('abnerck9@gmail.com', 'Administrador');

    // Obtener los datos del formulario
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Configuración del contenido del correo
    $mail->isHTML(true);
    $mail->Subject = 'Nuevo contacto desde el formulario web';
    $mail->Body    = "Nombre: $name<br> Teléfono: $phone <br> Asunto: $subject <br>Mensaje: $message";

    // Intentar enviar el correo
    if ($mail->send()) {
        $_SESSION['message'] = 'Nos comunicaremos pronto.';
    } else {
        $_SESSION['message'] = 'Error al enviar el mensaje: ' . $mail->ErrorInfo;
    }

} catch (Exception $e) {
    $_SESSION['message'] = "No se pudo enviar el mensaje. Error de PHPMailer: {$mail->ErrorInfo}";
}

// Redirigir al usuario de vuelta a la página de contacto
header('Location: /wk4rent/html/contact.html');
exit;
?>
