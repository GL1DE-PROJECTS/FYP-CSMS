<?php
require_once '../vendor/autoload.php';

use dompdf\dompdf as Dompdf;

    // Retrieve the HTML content sent from the AJAX request
    $html = $_POST['html'];

    // Create an instance of Dompdf
    $dompdf = new Dompdf();

    // Load the HTML into Dompdf
    $dompdf->loadHtml($html);

    // (Optional) Adjust Dompdf settings, if needed
    $dompdf->setPaper('A4', 'landscape');

    // Render the PDF
    $dompdf->render();

    // Set the response headers for downloading the PDF
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="output.pdf"');

    // Output the generated PDF
    echo $dompdf->output();
?>