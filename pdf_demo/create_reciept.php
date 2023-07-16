<?php
require('fpdf.php');

	class PDF_reciept extends FPDF 
	
	{ 
    public function __construct($orientation = 'P', $unit = 'pt', $format = 'Letter', $margin = 20)
{
    parent::__construct($orientation, $unit, $format, $margin);
    //$this->FPDF($orientation, $unit, $format);
    $this->SetTopMargin($margin);
    $this->SetLeftMargin($margin);
    $this->SetRightMargin($margin);
    $this->SetAutoPageBreak(false, $margin);
}
	
	
	function PriceTable($item,$batch,$mfg,$exp, $qty,$rate,$amount) { 

    $this->SetFont('Arial', 'B', 9); 
    $this->SetTextColor(0,0,0); 
    $this->SetFillColor(248, 232,232); 
    $this->SetLineWidth(1); 


	
	$this->Cell(100, 25, "Sr.No.", 'LTR', 0, 'C', true); 
    $this->Cell(230, 25, "Description", 'LTR', 0, 'C', true);
	/*$this->Cell(80, 25, "Batch No.", 'LTR', 0, 'C', true);
	$this->Cell(60, 25, "Mfg. Date", 'LTR', 0, 'C', true);
	$this->Cell(60, 25, "Exp Date", 'LTR', 0, 'C', true);*/
	$this->Cell(90, 25, "Qty", 'LTR', 0, 'C', true); 
    $this->Cell(80, 25, "Unit Price", 'LTR', 0, 'C', true);
	$this->Cell(70, 25, "Amount", 'LTR', 1, 'C', true); 
 
    $this->SetFont('Arial', 'B', 9);  
    $this->SetFillColor(238); 
    $this->SetLineWidth(0.2); 
    $fill = false; 
    
	//set initial y axis position per page
	$y_axis_initial = 25;
	//initialize counter
	$rows = 0;
	//Set maximum rows per page
	$max = 5;

	//Set Row Height
	$row_height = 6;

    for ($i = 0; $i < count($item); $i++) { 
	   
		if($rows==$max){ 
		$this->AddPage();
		
		$this->SetY(170);
		$this->SetX(25);
		$this->SetFillColor(248, 232,232); 
		$this->Cell(100, 25, "Sr.No.", 'LTR', 0, 'C', true); 
    $this->Cell(230, 25, "Description", 'LTR', 0, 'C', true);
	/*$this->Cell(80, 25, "Batch No.", 'LTR', 0, 'C', true);
	$this->Cell(60, 25, "Mfg. Date", 'LTR', 0, 'C', true);
	$this->Cell(60, 25, "Exp Date", 'LTR', 0, 'C', true);*/
	$this->Cell(90, 25, "Qty", 'LTR', 0, 'C', true); 
    $this->Cell(80, 25, "Unit Price", 'LTR', 0, 'C', true);
	$this->Cell(70, 25, "Amount", 'LTR', 1, 'C', true); 
		$rows=0;
		
		
		}
		$this->SetFillColor(232, 232,232); 
		$this->SetX(25);
	    $this->Cell(100, 20, $i+1, 1, 0, 'L', $fill);
		$this->Cell(230, 20, $item[$i], 1, 0, 'L', $fill); 
		/*$this->Cell(80, 20, $batch[$i], 1, 0, 'L', $fill);
		$this->Cell(60, 20, $mfg[$i], 1, 0, 'L', $fill);
		$this->Cell(60, 20, $exp[$i], 1, 0, 'L', $fill);*/
		$this->Cell(90, 20, $qty[$i], 1, 0, 'L', $fill);
        $this->Cell(80, 20, $rate[$i], 1, 0, 'R', $fill);
		$this->Cell(70, 20, $amount[$i], 1, 1, 'R', $fill); 
        $fill = !$fill; 
		$rows=$rows+1;	
			
    } 
    $this->Ln(5);
	$this->SetX(425); 
    $this->Cell(100, 20, "Total", 1,'R');
	$total= number_format(array_sum($amount),2);
    $this->Cell(70, 20,$total, 1, 1, 'R'); 
	
}

function grand_total($amount){
	return array_sum($amount);
}

//header
function Header() {
	
    $this->SetFont('Arial', 'B', 20); 
    $this->SetFillColor(255,0,0); 
    $this->SetTextColor(225); 
    $this->Cell(0, 30, "Sunrise Skip Hire Invoice", 0, 0, 'L', true); 

    $this->SetY(85);   
    $this->SetTextColor(0); 
 	$this->SetFont('Arial', '', 10); 
	$this->Cell(100, 10, "Sunrise Skip Hire Ltd.",0,1);
	//$this->Ln(35);
	$this->SetY(105); 
	$this->Cell(100, 10, "Address: 89 Woodrow Avenue,");

	$this->SetXY(62,115); 
	$this->Cell(100, 10, "Hayes,");

	$this->SetXY(62,125); 
	$this->Cell(100, 10, "UB2 8LP");
	//$this->Ln(15);
	//$this->SetY(135); 
	//$this->Cell(100, 10, "District: ".$_POST['address'],0,1); 

	$this->SetXY(280,85);   
    $this->SetTextColor(0); 
 	$this->SetFont('Arial', '', 10); 
	$this->Cell(100, 10, "Phone: +52369874");
	//$this->Ln(35);
	$this->SetXY(280,105);
	$this->Cell(100, 10, "Email: info@example.com");
	//$this->Ln(15);
	/*$this->SetXY(250,125);
	$this->Cell(100, 10, "District: ".$_POST['address'],0,1); */

	//$this->setX(400);
	$this->Image('Lorry.png',490,65,90);


}
 //footer
 function Footer() { 
    $this->SetFont('Arial', '', 10); 
    $this->SetTextColor(0); 
    $this->SetXY(0,-60); 
    $this->Cell(0, 20, "Thank you for ordering at the Agro Pharma Nuitrition", 'T', 0, 'C');
	
	//$this->Image('footer.JPG',0,750,620,50); 
}

// Add Watermark
function RotatedText($x, $y, $txt, $angle)
{
    //Text rotated around its origin
    $this->Rotate($angle,$x,$y);
    $this->Text($x,$y,$txt);
    $this->Rotate(0);
}

}

$pdf = new PDF_reciept(); 
$pdf->AddPage(); 
$pdf->SetFont('Arial', 'B', 10);
//move our cursor; we can do this by using the SetY method.
$pdf->SetY(150);   
 
$pdf->Cell(100, 10, "Customer Name: Billa Builder");
$pdf->Ln(15);
$pdf->Cell(100, 10, "Address: 25 Bedfont Avenue");
$pdf->Ln(15);
//$pdf->Cell(100, 10, "District: ".$_POST['address'],0,1);
$pdf->Ln(15);
$pdf->SetXY(65,175);
$pdf->Cell(100, 10, "Hayes,");

$pdf->SetXY(65,185); 
$pdf->Cell(100, 10, "UB3 4JP"); 

$pdf->SetY(150);
$pdf->SetX(430);
$pdf->SetFont('Arial', 'B'); 
$pdf->Cell(60, 10, 'Invoice Date: '); 
$pdf->SetFont('Arial', ''); 
$pdf->Cell(100, 10, date(' F j, Y'), 0, 1);
$pdf->Ln(15);
$pdf->SetX(430);
$pdf->SetFont('Arial', 'B'); 
$pdf->Cell(60, 10, 'Invoice No.: '); 
$pdf->SetFont('Arial', ''); 
$pdf->Cell(100, 10, '1402', 0, 1); 

$pdf->Ln(35);

$pdf->Ln(10);
$pdf->SetX(25);
// Table of products
$tax=5; //or $_POST['tax']
//$grand="6800.00";
$pdf->PriceTable($_POST['item'],$_POST['batch'],$_POST['mfg'],$_POST['exp'], $_POST['qty'],$_POST['rate'],$_POST['amount']);
$pdf->Ln(5);
$pdf->SetX(425); 
$pdf->Cell(100, 20, "VAT", 1,'R'); 
$pdf->Cell(70, 20, $tax , 1, 1, 'R');
$pdf->Ln(5);
$grand=$pdf->grand_total($_POST['amount']);
$grand=$grand+$tax;
setlocale(LC_MONETARY, 'en_IN');

$grand = number_format($grand,2);
$pdf->SetX(425); 
$pdf->Cell(100, 20, "Grand Total", 1,'R'); 
$pdf->Cell(70, 20,$grand, 1, 1, 'R');
$pdf->Output();
?>

