<?php
// include autoloader
require_once 'dompdf/autoload.inc.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$html_invoice='

<div class="col-md-12">
<table id="new_invoice_table" class="table table-bordered table-hover">
                      <thead>
                       
                        
                        <tr style="background-color:#4591C1; color:#F5EFEF;">
                             <th class="col-md-1">Sr. No.</th>
                             <th class="col-md-4"><center>Item Name</center></th>
                             <th class="col-md-1"><center>Quantity</center></th>
                             <th class="col-md-1"><center>Price</center></th>
                             <th class="col-md-1"><center>Total</center></th>
						</tr>
					</thead>
				</table>	
			</div> 
							 ';
$dompdf->loadHtml($html_invoice);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
//$dompdf->stream();

// Output the generated PDF (1 = download and 0 = preview)
$dompdf->stream("demo",array("Attachment"=>0));
?>