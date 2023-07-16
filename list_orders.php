<?php

include "dbconfig.php";

//include "css_header.php";
include "navbar_list.php";

//Get the order data for this order.

$sql="SELECT customers.name AS customer_name, orders.id as job_id, orders.total_amount as amount, order_status.name as status
FROM orders
LEFT JOIN customers ON customers.id = orders.customer_id
LEFT JOIN order_status ON orders.status = order_status.id
WHERE customers.id = orders.customer_id";

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
table#vehicle tbody  tr {
    cursor : pointer;
}
 </style>
 




</head>

<body>
   <div class="container-fluid">
   <div class="row">
      <div class="col-md-12" style="margin-top: 10%;box-shadow: 5px 5px 5px;">
        
             <div class="panel">
               <div class="panel-primary">
                 <div class="panel-heading"><h4><center>List Of All  Live Jobs</center></h4></div>
               </div>
             </div>
         
      </div>
   </div>
   <div class="row">
      <div class="col-md-12">
          <div>&ensp;</div>
      </div>
   </div>
  <div class="row">
      <div class="col-md-12">
        <table id="jobs" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">

        <thead>

            <tr class="btn-primary">

                           <th>Job ID</th>
                           <th>Customer</th>
                           <th>Amount</th>
                           <th>Status</th>                           
                           <th>Edit</th>
                           <th>View</th>
                           <th>Delete</th>
            </tr>

        </thead>

        <tfoot>

            <tr class="btn-primary">
                           <th>Job ID</th>
                           <th>Customer</th>
                           <th>Amount</th>
                           <th>Status</th>                           
                           <th>Edit</th>
                           <th>View</th>
                           <th>Delete</th>
            </tr>

        </tfoot>

        <tbody >

        <?php

                while($orders=mysqli_fetch_assoc($res))

                  {

                  

                                    
  ?>               

                           <td><?php echo $orders['job_id'];?></td>
                           <td><?php echo $orders['customer_name'];?></td>
                           <td><?php echo "£".$orders['amount'];?></td>
                           <td><?php echo $orders['status'];?></td>
                           
                          
<td><a href="edit_customer.php?id=2&order_id=<?php echo $orders['id'];?>"><i class="glyphicon glyphicon-check"></i></a></td>
                           <td><a href="edit_customer.php?id=2&order_id=<?php echo $orders['id'];?>"><i class="glyphicon glyphicon-user"></i></a></td>
                           <td><a href="delete_customer.php?id=<?php echo $orders['id'];?>"><i class="glyphicon glyphicon-trash"></i>
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
<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div id="order_detail" class="modal-content">
    
    </div>
  </div>
</div>
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

  $(document).ready(function() {

    $('#jobs').DataTable();

} );

</script>


</body>
</html>