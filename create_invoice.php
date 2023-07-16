<?php
   include "dbconfig.php";
 //$customer_id=$con->real_escape_string($_POST['']);
 //$start_date=$con->real_escape_string($_POST['start_date']);
 //$end_date=$con->real_escape_string($_POST['end_date']);
 $sql="SELECT orders.id, order_details.start_date, order_details.id AS order_id, order_details.end_date, order_details.skips, order_details.amount, order_details.vat, order_details.net, order_details.gross, order_details.permit, customers.name AS customer_name, customers.mobile, customers.address1, customers.address2, customers.city, customers.post_code, orders.total_amount AS total_amount, job_types.name AS job_type, payment_type.name AS payment_type, order_status.name AS order_status, skips.size AS size
FROM order_details
LEFT JOIN orders ON order_details.order_id = orders.id
LEFT JOIN customers ON order_details.customer_id = customers.id
LEFT JOIN job_types ON order_details.job_type = job_types.id
LEFT JOIN payment_type ON order_details.payment_status = payment_type.id
LEFT JOIN order_status ON orders.status = order_status.id
LEFT JOIN skips ON order_details.skip_id = skips.id
WHERE order_details.customer_id =12
AND order_details.invoice =1
AND start_date BETWEEN '2016-06-01' AND '2016-06-30'
";

$res=mysqli_query($con,$sql);
$invoice_result=mysqli_query($con,$sql);
?>
 
    <div class="row col-md-8">
   <div class="panel-body" style="background-color:#e9e9e9;">
        
                  <div class="col-md-4">
      <?php
      
      $row=mysqli_fetch_assoc($res);
       ?>
      <?php echo  $row['customer_name'];?><br>
                  <?php echo  $row['address1'];?><br>
                  <?php echo  $row['address2'];?><br>
                  <?php echo  $row['city'];?><br>
                  <?php echo  $row['post_code'];?><br>
                  
                  </div>
                  <div class="col-md-4"></div>

                  <div class="col-md-4"><p>P&L Sunrise Skip Hire Limited</p>
             <p>1-3 Business Park</p>
             <p>Hayes</p>
             <p>Ub6 7UB</p>
             <p>Middlesex</p>
             
             <p>T: 0208-895-6969</p>
                    <p>E: info@sunriseskips.com</p>
                    </div>
                    </div>
          
        </div>
        
        <div class="row col-md-8">
          <table class="table table-bordered">
           <thead>
            <tr class="btn-primary">
              <th>Job No.</th>           
              <th>Date</th>
              <th>Job Type</th>
              <th>Size</th>
              <th>Qty</th>
                              <th>Unit Price</th>
                              <th>VAT</th>
                              <th>Permit</th>
                              <th>Gross</th>
                              
            </tr>
           </thead>
           <tfoot>
            <tr class="btn-primary">
              <th colspan="9" style="text-align:center;">Thank You for Your Business</th>
            </tr>
           </tfoot>
         <?php
    $amount=0;
    $gross=0;
    $vat=0;
                while($invoice=mysqli_fetch_array($invoice_result))
            {
       $amount+=$invoice['amount'];
      $gross+=$invoice['gross'];
      $vat+=$invoice['vat'];
      $date=$invoice['start_date'];
       $order_detail_date=stristr($date,"00:00:00",true);
              ?>
           <tbody>
              <tr>
                <td><?php echo $invoice['id'];?></td>
                <td><?php echo $order_detail_date;?></td>
                <td><?php echo $invoice['job_type'];?></td>
                <td><?php echo $invoice['size'];?></td>
                <td><?php echo $invoice['skips'];?></td>
                <td style="text-align:right;"><?php echo "£".$invoice['amount'];?></td>
                              <td style="text-align:right;"><?php echo "£".$invoice['vat'];?></td>
                               <td style="text-align:right;"><?php echo "£".$invoice['permit'];?></td>
                                <td style="text-align:right;"><?php echo "£".$invoice['gross'];?></td>
              </tr>
         <?php
            }
           ?>
           </tbody>
        
              <tr>
                <td>&ensp;</td>
                <td>&ensp;</td>
                <td>&ensp;</td>
                <td>&ensp;</td>
                <td>&ensp;</td>
                <td>&ensp;</td>
              </tr>
           </tbody>
           <tbody style="text-align:right;">
              <tr>
                
                <td colspan="4" style="background-color: white;">Total</td>
                <td style="background-color: white;"><?php echo "£".number_format($amount,2);?></td>
               <td style="background-color: white;">VAT</td>
                <td style="background-color: white;"><?php echo "£".number_format($vat,2);?></td>
                              <td style="background-color: white;">Gross Total</td>
                <td style="background-color: white;"><?php echo "£".number_format($gross,2);?></td>
                           </tr>
           </tbody>
          
          </table>
         </div>
         <form method="POST">
          <button type="submit" name="btn-crtinvoice">Create PDF</button>
         </form>
<?php
ob_start();
if(isset($_POST['btn-crtinvoice']))
{
require('WriteHTML.php');

$pdf=new PDF_HTML();

$pdf->AliasNbPages();
$pdf->SetAutoPageBreak(true, 15);

$pdf->AddPage();

$pdf->SetFont('Arial','B',7);
$pdf->WriteHTML("Invoice<br/><br/>".$row['customer_name']."<br/>".$row['address1']."<br/>".$row['address2']."<br/>".$row['city']."<br/>".$row['post_code']."<br/>"."<p>P&L Sunrise Skip Hire Limited</p><br/>
             <p>1-3 Business Park</p><br/>
             <p>Hayes</p><br/>
             <p>Ub6 7UB</p><br/>
             <p>Middlesex</p><br/>
             <br/><br/>
             <p>T: 0208-895-6969</p><br/>
                    <p>E: info@sunriseskips.com</p><br/>");

$pdf->SetFont('Arial','B',7); 
$pdf->Output(); 
ob_end_flush();
}
 ?>