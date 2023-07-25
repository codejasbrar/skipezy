<?php

include('messagefile.php');

?>
<meta charset="utf-8">

<title>List of Skips</title>
<!doctype html>

<html>

<head>

    <?php
 include "dbconfig.php";
 //include "css_header.php";
//  include "navbar_list.php";
include "navbar.php";
 include ("dynamic_table.php");
//Get the order data for this order.
$sql="SELECT * from skips ORDER BY id desc";
$res=mysqli_query($con,$sql);

//echo $sql;

?>
</head>

<body style="font-family:Montserrat; font-size:13px;">

    <div class="row" style="margin-bottom:20px; float:left; width: 100%;">
        <h4>
            <center>Skips Stock Report</center>
        </h4>
        <div class="col-md-2"> </div>
        <div class="col-md-8">
            <table style="font-family:Montserrat; font-size:18px;" id="skips"
                class="table table-striped table-bordered table-hover" cellspacing="0">

                <thead>

                    <tr class="btn-primary">

                        <th>Skip</th>
                        <th>Out</th>
                        <th>In Yard</th>
                        <th>Total</th>

                    </tr>

                </thead>

                <tfoot>

                    <tr class="btn-primary">
                        <th>Skip</th>
                        <th>Out</th>
                        <th>In Yard</th>
                        <th>Total</th>


                    </tr>

                </tfoot>

                <tbody>

                    <?php

                while($skip=mysqli_fetch_assoc($res))

                  {             
                
                              echo '<td>'.$skip['size'].'</td>';
                              echo '<td>'.
							  // stock for the road
								 $on_road=$skip['current_stock'];
								 $in_yard=$skip['owned'];
								 
								 $total=$on_road+$in_yard;
								 $on_road.'</td>';
								 echo '<td>'.$in_yard.'</td>';
								 echo '<td>'.$total.'</td>';
								 ?>
                    </tr>
                    <?php  } ?>



                </tbody>

            </table>

        </div>


    </div>
    </div>
    <!-- <div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div id="order_detail" class="modal-content">
    
    </div>
  </div>
</div> -->
    <script type="text/javascript">
    $(document).ready(function() {
        $('#skips').DataTable({
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


</body>

</html>