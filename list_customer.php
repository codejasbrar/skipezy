<?php

include "dbconfig.php";

//include "css_header.php";
include "navbar_list.php";

//Get the order data for this order.

$sql="SELECT  customers.id,customers.name, customers.address1, customers.address2, customers.city, customers.post_code FROM customers";

$res=mysqli_query($con,$sql);

//echo $sql;
?>
<meta charset="utf-8">

<title>List of Orders</title>
<!doctype html>

<html>

<head>
   <?php include("dynamic_table.php");?>
<style>
table#customer tbody  tr {
    cursor : pointer;
}
 </style>
 

<script type="text/javascript">

	$(document).ready(function() {

    $('#customer').DataTable();

} );

</script>
</head>

<body>
<form method="post">
<div class="container-fluid">
<div class="row">
      <div class="col-md-12" style="margin-top: 10%;box-shadow: 5px 5px 5px;">
        
             <div class="panel">
               <div class="panel-primary">
                 <div class="panel-heading"><h4><center>List Of All Customer</center></h4></div>
               </div>
             </div>
         
      </div>
   </div>
	<div class="row">
    <div class="col-md-12">
      <table id="customer" class="table table-striped table-bordered table-hover" cellspacing="0">
         <thead>
              <tr class="btn-primary">
                           <th>Id</th>
                           <th>Name</th>
                           <th>Address Line1</th>
                           <th>Address Line2</th>
                           <th>City</th>
                           <th>Post Code</th>
                           <th>Edit</th>
                           <th>View</th>
                           <th>Delete</th>
              </tr>
        </thead>
        <tfoot>
              <tr class="btn-primary">
                           <th>Id</th>
                           <th>Name</th>
                           <th>Address Line1</th>
                           <th>Address Line2</th>
                           <th>City</th>
                           <th>Post Code</th>
                           <th>Edit</th>
                           <th>View</th>
                           <th>Delete</th>
              </tr>
        </tfoot>
        <tbody >

        <?php

                while($customers=mysqli_fetch_assoc($res))

                  {                                    
  ?>               
                           <td><?php echo $customers['id'];?></td>
                           <td><?php echo $customers['name'];?></td>
                           <td><?php echo $customers['address1'];?></td>
                           <td><?php echo $customers['address2'];?></td>
                           <td><?php echo $customers['city'];?></td>
                           <td><?php echo $customers['post_code'];?></td>
<td><a href="edit_customer.php?cid=<?php echo $customers['id'];?>"><i class="glyphicon glyphicon-user"></i></a>
</td>
                           <td><a href="customer_details.php?customer_id=<?php echo $customers['id'];?>"><i class="glyphicon glyphicon-user"></i></a></td>
                           <td><a href="delete_customer.php?customer_id=<?php echo $customers['id'];?>"><i class="glyphicon glyphicon-trash"></i>
                </a></td>

                

            </tr>

            

      <?php           

        }

                

        ?>

            

            </tbody>
      </table>
  </div>
</div>
</div>
<!-- Edit Modal -->

<!-- Edit Modal End -->
</form>

<script type="text/javascript">
$('.order_detail').click(function(){
  
var order_id = $(this).attr('data-order-id');
  var dataString = 'order_id=' + order_id;
  $.ajax({
    type: "POST",
    url: 'get_order.php',
    data: dataString,
    success: function(data) {
      $('#order_detail').html(data);
      $('#myModal').modal('show');
    }
  });
});  
</script>
    
</body>

</html>