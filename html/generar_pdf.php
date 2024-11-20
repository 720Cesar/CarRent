<?php

require('../pdf/fpdf.php');

// Verify if the data was sent via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Data received from the form
    $id_auto = $_POST['id_auto'];
    $customer_name = $_POST['nombre_cliente'];
    $phone_number = $_POST['telefono_cliente'];
    $email = $_POST['email_cliente'];
    $delivery_location = $_POST['ubicacion_entrega'];
    $start_date = $_POST['fecha_inicio'];
    $end_date = $_POST['fecha_fin'];
    $days = $_POST['dias'];
    $total_amount = $_POST['total'];
    $issue_date = date('Y-m-d');

    // Fetch car details from the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "wk4rent";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $car_sql = "SELECT marca, modelo, precio FROM automoviles WHERE id = $id_auto";
    $car_result = $conn->query($car_sql);
    if ($car_result->num_rows > 0) {
        $car = $car_result->fetch_assoc();
        $car_brand = $car['marca'];
        $car_model = $car['modelo'];
        $price_per_day = $car['precio'];
    } else {
        die("Car details not found.");
    }

    // Create PDF with FPDF
    $pdf = new FPDF();
    $pdf->AddPage();

    // Logo on the top left and issue date on the top right
    $pdf->Image('assets/media/user/kt.jpg', 10, 10, 30);
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetXY(150, 10);
    $pdf->Cell(0, 10, 'Issue Date: ' . $issue_date, 0, 1, 'R');
    $pdf->Ln(10);

    // Header
    $pdf->SetFont('Arial', 'B', 20);
    $pdf->SetTextColor(33, 37, 41); // Dark gray text color
    $pdf->Cell(0, 15, 'Reservation Summary', 0, 1, 'C');
    $pdf->Ln(10);

    // Customer details
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->SetFillColor(230, 230, 250); // Light purple background color
    $pdf->Cell(0, 10, 'Customer Details', 0, 1, 'L', true);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(50, 10, 'Name:', 0, 0);
    $pdf->Cell(0, 10, utf8_decode($customer_name), 0, 1);
    $pdf->Cell(50, 10, 'Phone Number:', 0, 0);
    $pdf->Cell(0, 10, utf8_decode($phone_number), 0, 1);
    $pdf->Cell(50, 10, 'Email:', 0, 0);
    $pdf->Cell(0, 10, utf8_decode($email), 0, 1);
    $pdf->Ln(5);

    // Reservation details
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->SetFillColor(230, 230, 250); // Light purple background color
    $pdf->Cell(0, 10, 'Reservation Details', 0, 1, 'L', true);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(50, 10, 'Delivery Location:', 0, 0);
    $pdf->Cell(0, 10, utf8_decode($delivery_location), 0, 1);
    $pdf->Cell(50, 10, 'Start Date:', 0, 0);
    $pdf->Cell(0, 10, $start_date, 0, 1);
    $pdf->Cell(50, 10, 'End Date:', 0, 0);
    $pdf->Cell(0, 10, $end_date, 0, 1);
    $pdf->Cell(50, 10, 'Days:', 0, 0);
    $pdf->Cell(0, 10, $days, 0, 1);
    $pdf->Ln(5);

    // Car details
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->SetFillColor(230, 230, 250); // Light purple background color
    $pdf->Cell(0, 10, 'Car Details', 0, 1, 'L', true);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(50, 10, 'Car:', 0, 0);
    $pdf->Cell(0, 10, utf8_decode($car_brand . ' ' . $car_model), 0, 1);
    $pdf->Cell(50, 10, 'Price per Day:', 0, 0);
    $pdf->Cell(0, 10, '$' . number_format($price_per_day, 2), 0, 1);
    $pdf->Ln(5);

    // Total amount to pay
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->SetFillColor(240, 128, 128); // Light red background color
    $pdf->Cell(0, 10, 'Total Amount to Pay', 0, 1, 'L', true);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(50, 10, 'Total Amount:', 0, 0);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, '$' . number_format($total_amount, 2), 0, 1);

    // Office details
    $pdf->Ln(15);
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->SetFillColor(230, 230, 250); // Light purple background color
    $pdf->Cell(0, 10, 'Office Details', 0, 1, 'L', true);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, 'CALLE 28 NORTE ENTRE 5TA & 1RA AV., Playa Del Carmen, Quintana Roo.', 0, 1);

    // Footer
    $pdf->Ln(15);
    $pdf->SetFont('Arial', 'I', 10);
    $pdf->SetTextColor(128, 128, 128); // Gray
    $pdf->Cell(0, 10, 'Thank you for reserving with us. Have a wonderful trip.', 0, 1, 'C');

    // Send the PDF to the browser for download with a custom file name
    $pdf->Output('D', 'Reservation_Summary_' . $customer_name . '.pdf');
} else {
    echo "No data received to generate the PDF.";
}
?>
