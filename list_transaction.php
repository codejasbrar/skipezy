<!doctype html>
<?php 
include "dbconfig.php";

//include "css_header.php";
include "navbar_list.php";

//Get the order data for this order.

$sql="SELECT * FROM ";

$res=mysqli_query($con,$sql);

?>
<html>
<head>
<meta charset="utf-8">
<title>SkipTrak Software for Skip Hire Business</title>
  <?php include("dynamic_table.php");?>
<style>
table#vehicle tbody  tr {
    cursor : pointer;
}
 </style>
 <script type="text/javascript">

  $(document).ready(function() {

    $('#transaction').DataTable();

} );

</script>
</head>

<body>
   <div class="container-fluid">
       <div class="col-md-12" style="margin-top: 10%;">
           <table id="transaction" class="table table-striped table-bordered table-hover" cellspacing="0">
              <thead>
                <tr class="btn-primary">
                  <th>Date</th>
                  <th>Source</th>
                  <th>Money In</th>
                  <th>Money Out</th>
                  <th>Balance</th>
                  <th>Edit</th>
                  <th>View</th>
                  <th>Delete</th>
                </tr>  
              </thead>
               <tfoot>
                <tr class="btn-primary">
                  <th>Date</th>
                  <th>Source</th>
                  <th>Money In</th>
                  <th>Money Out</th>
                  <th>Balance</th>
                  <th>Edit</th>
                  <th>View</th>
                  <th>Delete</th>
                </tr>  
              </tfoot>
              <tbody>
                 <tr>
                    <td>12/02/03</td>
                    <td>ATM</td>
                    <td>$200</td>
                    <td>$500</td> 
                    <td>$1000</td>
<td><a href="edit_customer.php?id=2&order_id=<?php echo $customer['id'];?>"><i class="glyphicon glyphicon-check"></i></a></td>
<td><a href="edit_customer.php?id=2&order_id=<?php echo $customer['id'];?>"><i class="glyphicon glyphicon-user"></i></a></td>
<td><a href="delete_customer.php?id=<?php echo $customer['id'];?>"><i class="glyphicon glyphicon-trash"></i>
                </a></td>

                 </tr>
              </tbody>
              <tbody>
                 <tr class="info">
                    <td>12/02/03</td>
                    <td>Cash</td>
                    <td>$300</td>
                    <td>$600</td> 
                    <td>$1200</td>
<td><a href="edit_customer.php?id=2&order_id=<?php echo $customer['id'];?>"><i class="glyphicon glyphicon-check"></i></a></td>
<td><a href="edit_customer.php?id=2&order_id=<?php echo $customer['id'];?>"><i class="glyphicon glyphicon-user"></i></a></td>
<td><a href="delete_customer.php?id=<?php echo $customer['id'];?>"><i class="glyphicon glyphicon-trash"></i>
                </a></td>
                 </tr>
              </tbody>
           </table>
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