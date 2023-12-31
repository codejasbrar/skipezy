
  <?php
    // include autoloader
    require_once 'dompdf/autoload.inc.php';

    // reference the Dompdf namespace
    use Dompdf\Dompdf;

    // instantiate and use the dompdf class
    $dompdf = new Dompdf();

    $dompdf->loadHtml('<h1>Welcome</h1>');

    // (Optional) Setup the paper size and orientation

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream('Invoice.pdf');
