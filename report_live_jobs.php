<?php

ob_start();
include "navbar.php";
include "dbconfig.php";
include ("dynamic_table.php");
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<form method="post" action="">
    <div class="container-fluid" style="margin-top:200x;">
        <label>
            <h2> Live Jobs Report</h2>
        </label>
        <div class="well col-md-12" style="background-color:#f8f8f8;">

            <div class="form-group col-md-2">
                <input type="text" name="from" class="from form-control" placeholder="Date From" id="from">
            </div>
            <div class="form-group col-md-2">
                <input type="text" name="to" class="to form-control" placeholder="Date To" id="to">
            </div>

            <div class="form-group col-md-2">
                <select class="form-control" name="skips">
                    <option value="">choose </option>
                    <?php
						$all_skips = "select * from skips";
						$d_sk = mysqli_query($con, $all_skips);
						while($aSkips = mysqli_fetch_array($d_sk)){
					?>
                    <option value="<?php echo $aSkips['id']; ?>"><?php echo $aSkips['size']; ?> </option>
                    <?php
						}
					?>
                </select>
            </div>

            <div class="form-group col-md-2">
                <select class="form-control" name="jobtypes">
                    <option value="">Job Type </option>
                    <?php
						$all_job_types = "select * from job_types";
						$d_jt = mysqli_query($con, $all_job_types);
						while($aJobTypes = mysqli_fetch_array($d_jt)){
					?>
                    <option value="<?php echo $aJobTypes['id']; ?>"><?php echo $aJobTypes['name']; ?> </option>
                    <?php
						}
					?>
                </select>

            </div>

            <div class="form-group col-md-2">
                <select class="form-control" name="no_of_days">
                    <option value="7">7</option>
                    <option value="14">14</option>
                    <option value="21">21</option <option value="28">28</option>

                </select>

            </div>

            <div class="form-group col-md-1">
                <input type="submit" id="select_jobs" class="btn btn-warning" value="Search Jobs">
            </div>
            <div class="form-group col-md-1">
                <input type="button" class="btn btn-primary btn-sm" onclick="printDiv('invoice')" value="Print" />
            </div>
            <!--
			<div class="col-md-2">
				<input type="button" name="btn" value="Print Invoices" id="filter_invoice" data-toggle="modal" data-target="#confirm-submit" class="btn btn-success btn-sm pull-right" />
			</div>
			-->
            <!-- now retrieve the transactions of this customer -->
        </div>

    </div>


</form>
<?php
$sql='';
$sql="SELECT  order_status.name as status, orders.start_date,orders.id AS id, orders.end_date,orders.skips,orders.exchange_skip_id as exchanged_skip, orders.comments,orders.delivery_slot, 
skips.size AS skip, customers.id AS customer_id, customers.name AS customer_name, customers.mobile as mobile, orders.amount AS total_amount, job_types.name AS job_type, payment_type.name AS payment_type,  delivery_address.address1,delivery_address.address2,delivery_address.city,delivery_address.post_code, employees.name AS driver,tip_status.name AS tip_status, orders.permit,orders.permit_permission, orders.permit_start_date, orders.permit_end_date
FROM orders
LEFT JOIN customers ON orders.customer_id = customers.id
LEFT JOIN job_types ON orders.job_type = job_types.id
LEFT JOIN payment_type ON orders.payment_status = payment_type.id
LEFT JOIN order_status ON orders.status = order_status.id
LEFT JOIN skips ON orders.skip_id = skips.id
LEFT JOIN delivery_address ON orders.address_id = delivery_address.id
LEFT JOIN employees ON orders.driver_id = employees.id
LEFT JOIN tip_status ON orders.tip_status = tip_status.id


";
$today= date('Y-m-d');
$from="";
$to="";
$company='';
if(!empty($_POST['no_of_days']))
{
$a=$_POST['no_of_days'];
$new_start_date = date('Y-m-d', strtotime('-'.$a.'days')); // 26th July - 7 19th July
}
if(!empty($_POST['jobtypes']))
{
$job_type=$_POST['jobtypes'];
}
//echo $job_type;
if (!empty($_POST['from']) && !empty($_POST['to']))
	{
	  $from=$con->real_escape_string($_POST['from']);
	  $from = str_replace("/","-",$from);
	  $from = date("Y-m-d", strtotime($from));
	  $to=$con->real_escape_string($_POST['to']);
	  $to = str_replace("/","-",$to);
	  $to = date("Y-m-d", strtotime($to));
	  $sql.=" WHERE orders.start_date BETWEEN '$from' AND '$to'";
	} else {
		
		 $sql.=" WHERE 1=1";
	}
	
	if (!empty($_POST['skips']))
	{
	  $skips=$con->real_escape_string($_POST['skips']);
	
	  $sql.=" and  orders.skip_id  = '$skips'";
	}
	
	

	if (!empty($_POST['jobtypes']))
	{
	  $jobtypes=$con->real_escape_string($_POST['jobtypes']);
	
	  $sql.=" and  orders.job_type  = '$job_type' AND orders.start_date='".$new_start_date."' order by orders.id desc";
	} // where jobtype =2 and start_date = 19-07-2023
	
//$sql.=" ORDER BY orders.id DESC
//";


$res=mysqli_query($con,$sql);
$rowcount=mysqli_num_rows($res);

//echo $sql;


?>
<?php
$invoice_sum=mysqli_query($con,$sql);
$total_skips=mysqli_num_rows($invoice_sum);
$res=mysqli_query($con,$sql);

//echo $sql;
?>

</head>

<body>

    <?php $invoice_html=
					 '   
					 <!doctype html>
					  <html>
					  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
					  	
                     <div id="invoice">
					 <h3>Total Live Jobs:'.$total_skips.'</h3>
					 <div class="table-responsive">
				   	  <table class="table table-striped table-bordered table-hover" id="alljobs">
			    		<thead class="blue-background btn-success">
						 <tr>
                           <th>Job ID</th>
                           <th>Start Date</th>
                           <th width="10%">Skip</th>
                           <th>Job Type</th>
                           <th  width="10%">Customer</th>
                           <th  width="25%">Delivery Address</th>
                           <th>Status</th>
						   <th>Amount</th>
						   <th>Permit?</th>
						   <th>Start date</th>
						   <th>End date</th>
						   <th>Comments</th>
						   <th>Permit amount</th>
                           
						</tr>

					</thead>

					<tbody style="font-size:18px;">
        ';?>

    <?php
				$total=0;
				$total_nett=0;
				$total_vat=0;
				$total_gross=0;
				$sr_no=0;
                while($job=mysqli_fetch_assoc($res))
				
                  {
					  //echo $job['payment_type'];
					  //exit;
					 $sr_no=$sr_no+1;
					 $id=$job['id'];
					 $start_date=date("d/m/Y", strtotime($job['start_date']));
					 $skip=$job['skip'];
					 $job_type=$job['job_type'];
					 $customer_name=$job['customer_name'];
					 $customer_id=$job['customer_id'];
					 
					 $comments=$job['comments'];
					 
					 $phone=$job['mobile'];
					 $address=$job['address1'].",".$job['post_code'];
					 $total_gross=$total_gross +$total_amount=$job['total_amount'];
					  
					 if(is_null($job['driver']) == true)
					 {
						 $driver='Assign Driver';
				     }else{
						 $driver=$job['driver'];
				     }
					 $tip_status=$job['tip_status'];
					 $status=$job['status'];
					 
					 
					 $permit=$job['permit'];
					 $permit_permission=$job['permit_permission'];
					 $permit_start_date=$job['permit_start_date'];
					  $permit_start_date=date("d/m/Y", strtotime($permit_start_date));
					 $permit_end_date=$job['permit_end_date'];
					  $permit_end_date=date("d/m/Y", strtotime($permit_end_date));
					  
					  if($permit_permission == 'yes'){
						   $permit_start_date=$job['permit_start_date'];
					  $permit_start_date=date("d/m/Y", strtotime($permit_start_date));
					 $permit_end_date=$job['permit_end_date'];
					  $permit_end_date=date("d/m/Y", strtotime($permit_end_date));
						  
					  } else {
						   $permit_end_date = '';
						    $permit_start_date = '';
 						  
					  }
					 
					 
                     ?>
    <?php
					 
					 $invoice_html.=
					 '
					 <tr>
                           <td><p>'.$id.'</p></td>
						   <td><p>'.$start_date.'</p></td>
						   <td><p>'.$skip.'</p></td>
						   <td><p>'.$job_type.'</p></td>
						   
						   <td><p>'.$customer_name.'('.$customer_id.')<br><b>'.$phone.'</b></p></td>
						   <td><p>'.$address.' <br/> <b>Driver : </b>'.$driver.'</p></td>
						   
						   <td><p>'.$status.'</p></td>
						   <td><p>£'.$total_amount.'</p></td>
						 <td><p>'.$permit_permission.'</p></td>
						  <td><p>'.$permit_start_date.'</p></td>
						  <td><p>'.$permit_end_date.'</p></td>
						  <td><p>'.$comments.'</p></td>
						 <td><p>£'.$permit.'</p></td>
						   
					</tr>
					';
				 } ?>
    <?php 
				
				 $invoice_html.='
			
					  <tr><td colspan="12" align="right">Total  £'.number_format($total_gross,2).'</td></tr> 
					</tbody>
				 </table>
				</div>
				</div>
					 
               ';?>

    <?php 
				   
				   echo 
				   '<div class="container-fluid">
				   <div id="invoice_div">'.$invoice_html.'</div>
				   </div>'
				  
				   ;?>
    <script>
    $('#to').datepicker({

        onSelect: function() {

            $("#to").datepicker("option", "dateFormat", "dd/mm/yy");

        }
    });
    $('#from').datepicker({

        onSelect: function() {

            $("#from").datepicker("option", "dateFormat", "dd/mm/yy");

        }
    });
    </script>
    <script type="text/javascript">
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
    </script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#alljobs').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5',
                'print'
            ]
        });
    });
    </script>