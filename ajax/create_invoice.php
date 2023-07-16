 <?php
 include "../dbconfig.php";
 error_reporting(E_ALL);
//require('../pdf_demo/rotation.php'); 
   	if (ISSET($_POST)) {
		/*
		echo '<pre>';
				print_r($_POST);
		echo '</pre>';
		exit;
		*/
	
		$customer_id=$con->real_escape_string($_POST['customer_name']);
		$invoice_date=$con->real_escape_string($_POST['invoice_date']);
		$invoice_date = str_replace('/', '-', $invoice_date);
		$invoice_date = date("Y-m-d", strtotime($invoice_date));
		
		// Now get invoice data
		$sub_total=$con->real_escape_string($_POST['sub_total']);
		$vat_p=$con->real_escape_string($_POST['vat_p']);
		$vat=$con->real_escape_string($_POST['vat']);
		$nett=$con->real_escape_string($_POST['nett']);
		$permit=$con->real_escape_string($_POST['permit']);
		$gross=$con->real_escape_string($_POST['gross']);
		
		$notes=$con->real_escape_string($_POST['notes']);
		
		$sql = "INSERT INTO `invoices`(`customer_id`, `date`, `sub_total`, `vat_p`, `vat`, `nett`, `permit`,`gross`,`notes`,status) VALUES ($customer_id,'$invoice_date','$sub_total','$vat_p','$vat','$nett','$permit','$gross','$notes','N')";
				
					  
					  if (!mysqli_query($con,$sql)) 
					  { 	
						  echo '<p style="color:black; background-color:red; padding:20px; font-size:20px; font-weight:bold;"> error 478';
						 
						  die('INSERT SQL 2 SAID -Error : ' . mysqli_error($con)); 
						  echo $sql;
						  exit;
					  }//if (!mysqli
					  
				$invoice_number=mysqli_insert_id($con);	
				 
				 $count = count($_POST['item']);
				for ($i = 0; $i < $count; $i++) {
					$srno=$i+1;
					$item = $con->real_escape_string($_POST['item'][$i]);
					$qty = $con->real_escape_string($_POST['quantity'][$i]);
					$unit_price = $con->real_escape_string($_POST['price'][$i]);
					$sub_total = $con->real_escape_string($_POST['amount'][$i]);
					
					$sql = "INSERT into invoice_details (invoice_no,srno,item,qty,unit_price,sub_total) VALUES ($invoice_number,$srno,'$item','$qty','$unit_price','$sub_total')";
				//echo $sql;
					//echo $sql.'<br />';
					
					if (!mysqli_query($con,$sql)) 
					  { 	
						  echo '<p style="color:black; background-color:red; padding:20px; font-size:20px; font-weight:bold;"> error 497 Something Went Wrong, did you filled all fields?';                   echo $sql;
						  exit;
						  die('INSERT SQL 2 SAID -Error : ' . mysqli_error($con));
					  }//if (!mysqli
					  
					 	} 
					// Now save invoice summary in the invoice table
					
					
					//echo '<p style="color:black; background-color:#36EB34; padding:20px; font-size:20px; font-weight:bold;"> Invoice No.'.$invoice_no.' Inserted Successfully. <a href="new_invoice.php" class="btn btn-primary btn-sm pull-right">Add New Invoice</a></p>';
			
	}
?>
<?php $customers_sql="SELECT * from skips order by size ASC";
                  $t_result=mysqli_query($con,$customers_sql);
                  while($items=mysqli_fetch_assoc($t_result))
                  {
					  $item_name[$items['id']]=$items['size'];
                  }
				 // print_r($item_name);
				  //print_r($_POST['item']);
				  //exit;
?>
<?php $customers_sql="SELECT * from customers WHERE id=".$customer_id." order by name ASC";
                  $t_result=mysqli_query($con,$customers_sql);
				  
                  while($customers=mysqli_fetch_assoc($t_result))
                  {
					 $customer_array[$customers['id']]= array('name'=>$customers['name'],'address1'=>$customers['address1'],'post_code'=>$customers['post_code']);
					 $customer_name= $customer_array[$customers['id']]['name'];
					 $address= $customer_array[$customers['id']]['address1'];
					 $post_code= $customer_array[$customers['id']]['post_code'];
					 
                  }
				
?>

<?php
require('../pdf_demo/fpdf.php');
define('£',chr(163));
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
	
	
	function PriceTable($item, $qty,$rate,$amount,$item_name) { 

    $this->SetFont('Arial', 'B', 9); 
    $this->SetTextColor(0,0,0); 
    $this->SetFillColor(135,206,250);  
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
    $this->SetFillColor(135,206,250); 
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
	$total_amount=0;
    for ($i = 0; $i < count($item); $i++) { 
	   
		if($rows==$max){ 
		$this->AddPage();
		
		$this->SetY(170);
		$this->SetX(25);
		$this->SetFillColor(135,206,250); 
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
		$this->Cell(230, 20, $item_name[$item[$i]], 1, 0, 'L', $fill); 
		/*$this->Cell(80, 20, $batch[$i], 1, 0, 'L', $fill);
		$this->Cell(60, 20, $mfg[$i], 1, 0, 'L', $fill);
		$this->Cell(60, 20, $exp[$i], 1, 0, 'L', $fill);*/
		$this->Cell(90, 20, $qty[$i], 1, 0, 'L', $fill);
        $this->Cell(80, 20, £.number_format($rate[$i],2), 1, 0, 'R', $fill);
		$this->Cell(70, 20, £.number_format($amount[$i],2), 1, 1, 'R', $fill);
		$total_amount=$total_amount+$amount[$i]; 
        $total_amount=number_format($total_amount,2);
		$fill = !$fill; 
		$rows=$rows+1;	
			
    } 
    $this->Ln(5);
	
	$this->SetX(425); 
    $this->Cell(100, 20, "Total", 1,'R');
	//$total= 100;//number_format(array_sum($amount),2);
    $this->Cell(70, 20,£.$total_amount, 1, 1, 'R'); 
	
}

//header
function Header() {
	
    $this->SetFont('Arial', 'B', 20); 
    $this->SetFillColor(70,130,180); 
    $this->SetTextColor(255,255,255); 
	$this->SetX(200);  
    $this->Cell(0, 30, "Sunrise Skip Hire Ltd", 0, 0, 'L', true); 
    
	$this->Ln(12); 
	$this->SetFont('Arial', 'B', 14); 
	$this->Cell(100, 10, "Sunrise Skip Hire Ltd.",0,1);
	$this->SetFont('Arial', '', 13);
	$this->Ln(10); 
	$this->Cell(100, 10, "89 Woodrow Avenue,");

	$this->Ln(15);
	$this->Cell(100, 10, "Hayes,");

	$this->Ln(15); 
	$this->Cell(100, 10, "UB2 8LP");
	$this->Ln(15); 
	$this->Cell(100, 10, "Phone: +52369874"); 
    $this->Ln(15); 
	
	
	
	//$this->setX(400);
	//$this->Image('Lorry.png',490,65,90);


}
 //footer
 function Footer() { 
    $this->SetFont('Arial', '', 10); 
    $this->SetTextColor(0); 
    $this->SetXY(0,-60); 
    $this->Cell(0, 20, "Thank you for ordering at the Sunrise Skip Hire", 'T', 0, 'C');
	
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
$pdf->Image('..//images/logo.jpg',400,10,200,150);
$pdf->SetFont('Arial', 'B', 13);
//move our cursor; we can do this by using the SetY method.
 $pdf->SetXY(20,160);   
 $pdf->Cell(100, 10, "Invoice To:");

$pdf->Ln(15);
$pdf->SetXY(20,180); 
$pdf->Cell(100, 10,$customer_name);
$pdf->SetFont('Arial', '', 13);
$pdf->SetXY(20,195); 
$pdf->Cell(100, 10,$address);
$pdf->SetXY(20,210); 
$pdf->Cell(100, 10,$post_code);

$pdf->SetXY(430,170); 
$pdf->SetFont('Arial', 'B'); 
$pdf->Cell(90, 10, 'Invoice Date: '); 
$pdf->SetFont('Arial', ''); 
$pdf->Cell(130, 10, date("d/m/Y",strtotime($invoice_date)), 0, 1);
$pdf->Ln(15);
$pdf->SetX(430);
$pdf->SetFont('Arial', 'B'); 
$pdf->Cell(80, 10, 'Invoice No.: '); 
$pdf->SetFont('Arial', ''); 
$pdf->Cell(100, 10, $invoice_number, 0, 1); 

///// Details Section Starts

//$pdf->Line(0, 240, 700, 240);
$pdf->Ln(30);
setlocale(LC_MONETARY, 'en_IN');

$pdf->Ln(10);
$pdf->SetX(25);
// Table of products

//$grand="6800.00";
//


$pdf->PriceTable($_POST['item'],$_POST['quantity'],$_POST['price'],$_POST['amount'],$item_name);
$pdf->Ln(5);
$pdf->SetX(425); 
$total_amount=$_POST['sub_total'];
$vat=$total_amount*.20;
$vat=number_format($vat,2);
$pdf->Cell(100, 20, "VAT", 1,'R'); 
$pdf->Cell(70, 20, £.$vat , 1, 1, 'R');
$pdf->Ln(5);

$grand=$total_amount+$vat;
   
$grand = number_format($grand,2);
$pdf->SetX(425); 
$pdf->Cell(100, 20, "Grand Total", 1,'R'); 
$pdf->Cell(70, 20,£.$grand, 1, 1, 'R'); 

$pdf->SetX(20); 
	$pdf->Cell(100, 20, "Notes:", 0,'L');
	$pdf->Ln(15);
	$pdf->SetX(20);
	$pdf->Cell(50, 20, $notes, 0,'L');

$filename="../invoices/".$invoice_number."_".$customer_name."_".$invoice_date;//$filename.".pdf",'D'
$pdf->Output();
///$pdf->Output();
//$pdf_image->Output();
?>

