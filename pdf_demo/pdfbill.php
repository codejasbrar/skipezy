<?php
require('../fpdf.php');

	class PDF_reciept extends FPDF { 
    function __construct ($orientation = 'P', $unit = 'pt', $format = 'Letter', $margin = 40) { 
        $this->FPDF($orientation, $unit, $format); 
        $this->SetTopMargin($margin); 
        $this->SetLeftMargin($margin); 
        $this->SetRightMargin($margin); 
        $this->SetAutoPageBreak(true, $margin); 
    } 
}
//header
function Header() { 
    $this->SetFont('Arial', 'B', 20); 
    $this->SetFillColor(36, 96, 84); 
    $this->SetTextColor(225); 
    $this->Cell(0, 30, "Nettuts+ Online Store", 0, 1, 'C', true); 
}
 //footer
 function Footer() { 
    $this->SetFont('Arial', '', 12); 
    $this->SetTextColor(0); 
    $this->SetXY(0,-60); 
    $this->Cell(0, 20, "Thank you for shopping at Nettuts+!", 'T', 0, 'C'); 
}
$pdf = new PDF_receipt(); 
$pdf->AddPage(); 
$pdf->SetFont('Arial', '', 12);
//move our cursor; we can do this by using the SetY method.
$pdf->SetY(100);   
$pdf->Cell(100, 13, "Ordered By"); 
$pdf->SetFont('Arial, ''); 
$pdf->Cell(100, 13, $_POST['name']);

?>