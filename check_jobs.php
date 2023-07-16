<!doctype html>
<html>
<head>
<?php
//include "navbar_list.php";
include "dbconfig.php";

//include "css_header.php";

 $today= date('Y-m-d');
 ?>
<meta charset="utf-8">
<title>Check Job Status</title>
</head>

<body>
<?php
$reminder = date('Y-m-d',(strtotime('-28 day', time())));


 $sql="SELECT orders.id, orders.start_date, delivery_address.address1, delivery_address.address2, delivery_address.city, delivery_address.post_code, customers.mobile  from orders 
LEFT JOIN delivery_address ON orders.address_id = delivery_address.id
LEFT JOIN customers ON orders.customer_id = customers.id
WHERE orders.start_date>'$reminder' AND orders.status=2 OR orders.payment_status=2 order by orders.start_date ASC"; 
 
// $sql="SELECT * from orders WHERE orders.start_date > '$reminder' AND orders.status=1 OR orders.payment_status=2";
 
//echo $sql;
$res=mysqli_query($con,$sql);
$rowcount=mysqli_num_rows($res);
      
		 
		 ?>
         <?php $message ='
		 <html><head><link href="https://fonts.googleapis.com/css?family=Coda+Caption:800|Pacifico|Hind|Anton|Chewy|Bangers|Montserrat:400,700" rel="stylesheet" type="text/css"></head><body>
		 <p><h3> Dear Admin User, <br>Life is busy and sometime we forget the things. Skip Easy Software want to remind you: <br>Some jobs are still pending <br>OR <br> Some jobs are waiting for payment to be collected. You need LOG IN TO SYSTEM NOW.</h3></p>
		 
		 <br>
		 <table cellpadding=5"  style="font-family:Montserrat; font-size:13px;" id="jobs" class="table list_jobs" cellspacing="0" border="1">

        <thead>
			
            <tr class="btn-primary" bgcolor="#3FC6E8">

                           <th>Job ID</th>
                           <th>Start Date</th>
                           <th>Pending From</th>
                           <th>Phone Number </th>
                           <th>Address</th>
                          
                           
            </tr>

        </thead>

        <tfoot>

            <tr class="btn-primary" bgcolor="#3FC6E8">
                           <th>Job ID</th>
                           <th>Start Date</th>
                           <th>Pending From</th>
                           <th>Phone Number </th>
                           <th>Address</th>
                        
                           
            </tr>

        </tfoot>

        <tbody>
		';
		?>
			<?php
            


while($job=mysqli_fetch_assoc($res))
{
		   
               $from = new DateTime($job['start_date']); 
               $today = new DateTime();
              if($today>$from)
			  {
			   $no_of_days = $today->diff($from)->format("%a"); 
			   $days= $no_of_days." days";
			  }
              $job_id=$job['id'];
			  $start_date = date("d/m/y", strtotime($job['start_date'])); 
			 
			 
			     $address_id=$job['address1'].' '.$job['address2'].' '.$job['city'];
			    $post_code=$job['post_code'];
			    $mobile=$job['mobile'];
			 			   
			 
			  if($no_of_days>28)

			{
	 	
		 $message .= "
		 <tr>
		 	<td> $job_id</td>
			<td> $start_date</td>
			<td> $days</td>
			<td> <a href='tel:$mobile'><b>$mobile</b></a></td>
			<td> $address_id <b>$post_code</b></td>
		
		 </tr>
		
		 ";
		 
    }     
         
	}//Whihle loop	 
	 $message .= "
	</table>
	<br><h3><b><a href='http://webezy.co.uk/SCJ-Transport'>Click Here to Log In to Software</a></b</h3>
		 <br>
		 <p>If you need any further assistance then give us a call, we are here to help you.</p>
		 <p>Kind Regards
		 <br>
		 Jas Brar
		 <br>
		 M: 07792560326
		 <br>
	
		 </p>
		 
		 </body></html>";
	     //echo $message;
		 //exit;
	    // $name="Mr. Dhillon";
		 
		 $to = "bal.skiphire@gmail.com";
         $subject = "Reminder of Pending Jobs";
		 $sender = "info@webezy.co.uk";
	     
		 $header = "From: Skip Easy Software $sender\n";
    
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";

         
         $retval = mail ($to,$subject,$message,$header);
         
         if( $retval == true ) {
            echo "Message sent successfully...";
         }else {
            echo "Message could not be sent...";
         }	  
?>
</body>
</html>