
<meta charset="utf-8">

<title>List of Orders</title>
<!doctype html>

<html>

<head>
  <?php

include "dbconfig.php";

//include "css_header.php";
include "navbar.php";

//Get the order data for this order.

$sql="SELECT * FROM vehicles ";

$res=mysqli_query($con,$sql);

//echo $sql;

?>


</head>

<body>
<div class="container-fluid">
<div class="row">
  <div class="col-md-12" style="margin-top: 10%;box-shadow: 5px 5px 5px;">
    <div class="panel">
               <div class="panel-primary">
                 <div class="panel-heading"><h4><center>List Of All Vehicle</center></h4></div>
               </div>
             </div>
  </div>
</div>
   <div class="row">
      <div>&ensp;</div>
      
   </div>
	<div class="row">
    	<div class="col-md-12">
        <table id="vehicle" class="table table-striped table-bordered table-hover" cellspacing="0">

        <thead>

            <tr class="btn-primary">

                           <th>Reg Plate</th>
                           <th>MOT Date</th>
                           <th>PMI Date</th>
                           <th>Taco Date</th>
                           <th>Road Tax</th>
                           <th>Service Date</th>
                           <th>Insurance</th>

            </tr>

        </thead>

        <tfoot>

            <tr class="btn-primary">
                           <th>Reg Plate</th>
                           <th>MOT Date</th>
                           <th>PMI Date</th>
                           <th>Taco Date</th>
                           <th>Road Tax</th>
                           <th>Service Date</th>
                           <th>Insurance</th>
            </tr>

        </tfoot>

        <tbody >

        <?php

                while($vehicles=mysqli_fetch_assoc($res))

									{

									

                                    
	?>               

                           
                           <td><?php echo $vehicles['reg_plate'];?></td>
                          <?php $start = date("d/m/y", strtotime($vehicles['mot_date'])); 
						   
						     ;?>
                           <?php
						   $from = new DateTime($vehicles['mot_date']); 
               
               $today = new DateTime();
               $no_of_days = $today->diff($from)->format("%a"); 
           ?>
               <td style="color:#F7F4F4; background-color:#D30D11;"><?php echo $start." Due  in ".$no_of_days."Days";?></td>
               <?php $start = date("d/m/y", strtotime($vehicles['pmi_date'])); 
						   
						     ;?>
                           <?php
						   $from = new DateTime($vehicles['pmi_date']); 
               
               $today = new DateTime();
               $no_of_days = $today->diff($from)->format("%a"); 
           ?>
               <td style="color:#F7F4F4; background-color:#D30D11;"><?php echo $start." Due  in ".$no_of_days."Days";?></td>
               
                 <?php $start = date("d/m/y", strtotime($vehicles['taco_date'])); 
						   
						     ;?>
                           <?php
						   $from = new DateTime($vehicles['taco_date']); 
               
               $today = new DateTime();
               $no_of_days = $today->diff($from)->format("%a"); 
           ?>
               <td style="color:#F7F4F4; background-color:#D30D11;"><?php echo $start." Due  in ".$no_of_days."Days";?></td>                       <?php $start = date("d/m/y", strtotime($vehicles['road_tax'])); 
						   
						     ;?>
                           <?php
						   $from = new DateTime($vehicles['road_tax']); 
               
               $today = new DateTime();
               $no_of_days = $today->diff($from)->format("%a"); 
           ?>
               <td style="color:#F7F4F4; background-color:#D30D11;"><?php echo $start." Due  in ".$no_of_days."Days";?></td>                       <?php $start = date("d/m/y", strtotime($vehicles['service_date'])); 
						   
						     ;?>
                           <?php
						   $from = new DateTime($vehicles['service_date']); 
               
               $today = new DateTime();
               $no_of_days = $today->diff($from)->format("%a"); 
           ?>
               <td style="color:#F7F4F4; background-color:#D30D11;"><?php echo $start." Due  in ".$no_of_days."Days";?></td>                       <?php $start = date("d/m/y", strtotime($vehicles['insurance_date'])); 
						   
						     ;?>
                           <?php
						   $from = new DateTime($vehicles['insurance_date']); 
               
               $today = new DateTime();
               $no_of_days = $today->diff($from)->format("%a"); 
           ?>
               <td style="color:#F7F4F4; background-color:#D30D11;"><?php echo $start." Due  in ".$no_of_days."Days";?></td>     

                

            </tr>

            

			<?php						

				}

								

				?>

            

            </tbody>

    </table>

    </div>

    </div>

    </div>
<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div id="order_detail" class="modal-content">
    
    </div>
  </div>
</div>


    
</body>

</html>