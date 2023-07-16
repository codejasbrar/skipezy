
<meta charset="utf-8">

<title>List of Jobs</title>
<!doctype html>

<html>

<head>
  
<?php

include "dbconfig.php";

//include "css_header.php";
include "navbar_list.php";
 include ("dynamic_table.php");
//Get the order data for this order.

$sql="SELECT invoices.invoice_no,invoices.date, invoices.customer_id, customers.name,customers.mobile,customers.email, invoices.sub_total, invoices.vat, invoices.nett, invoices.permit, invoices.gross, invoices.paid, invoices.due, invoices.status
FROM invoices
LEFT JOIN customers ON invoices.customer_id = customers.id";

$res=mysqli_query($con,$sql);

//echo $sql;

?>
 </head>

<body style="font-family:Montserrat; font-size:13px;">

<div class="row">
      <div class="col-md-12" style="margin-top: 10%;box-shadow: 5px 5px 5px;">
        
             <div class="panel">
               <div class="panel-primary">
                 <div class="panel-heading"><h4><center>Send Reminder to Customers</center></h4></div>
               </div>
             </div>
         
      </div>
   </div>
          <!-- this is end of start block and driver dropdown -->
	<div>&nbsp;</div>
  <div class="row col-md-8 col-md-offset-2">
  
  <form name="allocate" method="post">
   <div class="panel" style="box-shadow: 5px 5px 5px;">
             <div class="panel-primary">
                <div class="panel-heading">Select Reminder</div>
             </div>
             <div class="panel-body" style="background-color: #e9e9e9;">
                     <div class="row">
                        <div class="form-group col-md-4">
                           <select name="reminder" style="width:70%;" id="reminder" class="form-control">
                                   <option style="padding:15px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;" value="0" selected>Select A Reminder </option>
                                   <option style="padding:15px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;" value="1" selected>Late Payment </option>
                                   <option style="padding:15px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;" value="2" selected>Job Confirmation </option>
                                   <option style="padding:15px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;" value="3" selected>Job Delayed </option>
                                   <option style="padding:15px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;" value="4" selected>Keep In Touch </option>
                                   <option style="padding:15px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;" value="5" selected>Happy Diwali </option>
                                   <option style="padding:15px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;" value="6" selected>Merry Christmas </option>
                               
                                </select>
             </div>
             
             <label class="form-group col-md-2"> Add Notes</label>
            
             
             
             
            <textarea name="reminder_content" id="reminder_content" cols="45" rows="5"></textarea>
            
          <div>&nbsp;</div>
           
            <div class="form-group col-md-6 pull-right">
             <input  type="submit" name="send_reminder" class="btn btn-round btn-success col-md-4" style="float:right;padding:15px;" value="Send Reminder">
             </div>
           </div>
          </div>
        </div>
       <!-- this is end of button block and driver dropdown -->
       
      
      
      
      <div id="job_done"></div>
      <div>&nbsp;<hr class="solid"></div>
      
       <table  style="font-family:Montserrat; font-size:13px;" id="invoices" class="table table-striped table-bordered table-hover" cellspacing="0">

        <thead>

            <tr class="btn-primary">

                           <th>Invoice Number</th>
                           <th>Date</th>
                           <th>Customer</th>
                           <th>Age</th>
                           <th>Amount</th>
                           <th>VAT</th>
                           <th>Nett</th>
                           <th>Permit</th>
                           <th>Gross</th>
                           <th>Amount Paid</th>
                           <th>Balance Due</th>
                           <th>Paid</th>
                          
                           <th>Select</th>
            </tr>

        </thead>

        <tfoot>

            <tr class="btn-primary">
                          <th>Invoice Number</th>
                           <th>Date</th>
                           <th>Customer</th>
                           <th>Age</th>
                           <th>Amount</th>
                           <th>VAT</th>
                           <th>Nett</th>
                           <th>Permit</th>
                           <th>Gross</th>
                          <th>Amount Paid</th>
                           <th>Balance Due</th>
                           <th>Paid</th>
                           <th>Select</th>
                          
            </tr>

        </tfoot>

        <tbody >

        <?php

                while($invoice=mysqli_fetch_assoc($res))

                  {

                  

                                    
  ?>               

                           <td><?php echo $invoice['invoice_no'];?></td>
                           <td>
						   <?php $start = date("d/m/y", strtotime($invoice['date'])); 
						   
						   echo $start  ;?></td>
                            <td><?php echo $invoice['name']." <br><b>M: ".$invoice['mobile']."</b>";?></td>
                           <?php
						   $start_date = new DateTime($invoice['date']); 
               
               $today = new DateTime();
               $no_of_days = $today->diff($start_date)->format("%a"); 
               if($no_of_days>20){?>
               <td style="color:#F7F4F4; background-color:#D30D11;"><?php echo "Raised ".$no_of_days." days ago";?></td>  
               <?php }else{?>
               <td><?php echo "Raised ".$no_of_days." days ago";?></td>  
              <?php }   ?>
                        
                           <td><?php echo "£".$invoice['sub_total'];?></td>
                           <td><?php echo "£".$invoice['vat'];?></td>
                           <td><?php echo "£".$invoice['nett'];?></td>
                           <td><?php echo "£".$invoice['permit'];?></td>
                           <td><?php echo "£".$invoice['gross'];?></td>
                           <td><?php echo "£".$invoice['paid'];?></td>
						   <td><?php echo "£".$invoice['due'];?></td>
                           
                          <?php 
						   
						   
						   $status=$invoice['status'];?>
                           <?php
                           if($status=='Y'){?>
                           <td bgcolor="#0C9402" style="color:#F7F4F4;" ><?php echo $invoice['status'];?></td>
                           <?php }elseif($status=='N'){?>
                           <td style="color:#F7F4F4; background-color:#D30D11;"><?php echo $invoice['status'];}?></td>
                           
                           <td><input type="checkbox" name="selected_customer[]" value=<?php echo $invoice['email'];?>> </td>
                        </tr>
      <?php } ?>
        </tbody>
    </table>
       <!-- Now allocate job to selected driver -->
       <?php
       if(isset($_POST['send_reminder'],$_POST['selected_customer']))
			{
				
				$selected_customer=$_POST['selected_customer'];
				$reminder=$_POST['reminder_content'];
				//print_r($_POST);
				//echo $id;
			    //exit;
			
			foreach($selected_customer as $customer=>$email)
				{
				  //Send Emails
				  
				  $sql="SELECT name from customers WHERE email='$email'";

				  //echo $sql;
				  $res=mysqli_query($con,$sql);
				  $customer=mysqli_fetch_assoc($res);
				  $customer_name=$customer['name'];
				  
				  //echo $customer_name;
				  
				  
				   $name=$customer_name;
				   
				   $from="jaspinder32@gmail.com";
				   $to = "jaspinder32@gmail.com";
				   $subject = "Late Payment Reminder";
				   $message='';
				   $message .= "<h1>Late Payment Reminder for $name</h1><br>";
				   $message .= "Dear $name <br>This is to inform you that your Payment was due on 12/06/2016. Pleaes clear ASAP <br>Sunrise Skip Hire Ltd.";
				  
				   //echo $message;
				   //exit;
				   $header = "MIME-Version: 1.0" . "\r\n";
				   $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
					
				   $header .= "From: Sunrise Skips Ltd ".$from."\r\n";
				   //echo $header."<br>";
				   $header .= "Cc:jaspinder32@gmail.com \r\n";
				 
				   $retval = mail ($to,$subject,$message,$header);
				   //echo $header."<br>";
				   
				 if( $retval == true ) {
				   echo '<p style="color:black; background-color:#36EB34; padding:20px; font-size:20px; font-weight:bold;"> Email has been sent successfully to '.$email.'</p>';
				 }else {
					echo "Message could not be sent...";
				 }
     
      
				  
				}//for loop
			}//isset
			?> 

            
   

    </div>
</form>

    </div>


<script type="text/javascript">
$('.allocate_jsob').click(function(){
  
var send_reminder = "yes";
 
  $.ajax({
    type: "POST",
    url: 'send_reminder.php',
    data: dataString,
    success: function(data) {
      $('#job_done').html(data);
    }
  });
});

  $(document).ready(function() {
    $('#invoices').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5',
			'print'
			        ]
    } );
} );

$('#reminder').change(function(){
	var reminder_id=$(this).val();
	if(reminder_id==1){
	
	$('#reminder_content').html("Dear Customer , We have not recieved your payment of Invoice Number 526975.   Please advise us with your payment arrangement. Regards Quick Skip Hire");
	$('#reminder_content').css('background-color','#46F84A');	
	}
	if(reminder_id==3){
	
	$('#reminder_content').html("Dear Customer , We are sorry to inform you that your job has been delayed. Regards Quick Skip Hire");
	$('#reminder_content').css('background-color','#E7B933');	
	}
	if(reminder_id==6){
	
	$('#reminder_content').html("Dear Customer , Quick Skip Hire Wish you a Merry Christmas");
	$('#reminder_content').css('background-color','#E52A2D');	
	}
	

});

</script>


</body>
</html>