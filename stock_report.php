
<meta charset="utf-8">

<title>List of Skips</title>
<!doctype html>

<html>

<head>
  
<?php

include "dbconfig.php";

//include "css_header.php";
//include "navbar_list.php";
 include ("dynamic_table.php");
//Get the order data for this order.

$sql="SELECT * FROM skips order by size ASC";

$res=mysqli_query($con,$sql);

//echo $sql;

?>
 </head>

        <table  style="font-family:Montserrat; font-size:18px;" id="skips" class="table table-striped table-bordered table-hover" cellspacing="0">

        <thead>

            <tr class="btn-primary">

                           <th></th>
                           <th>Skip Name</th>
                           <th>Owned</th>
                           <th>Current Stock</th>
                         
            </tr>

        </thead>

        <tfoot>

            <tr class="btn-primary">
                           <th></th>
                           <th>Skip Name</th>
                           <th>Owned</th>
                           <th>Current Stock</th>
                           
            </tr>

        </tfoot>

        <tbody >

        <?php

                while($skip=mysqli_fetch_assoc($res))

                  {             
  ?>               
  							<td><img src="images/6 cu.jpg" width="80" height="80" class="img-responsive img-thumbnail"></td>
                              <td><?php echo $skip['size'];?></td>
                              <td><?php echo $skip['owned'];?></td>
                                 <td><?php 
								 $current_stock=$skip['current_stock'];
								 if($current_stock<5)
								 {
							
							    echo "<p style='background-color:#E81013; color:#F4EEEE; font-size:20px;'>Only $current_stock left.</p>";
								 }else{
									echo $current_stock; 
								 }
							?>  
                            </td>
                          </tr>
			      <?php  } ?>

            

            </tbody>

    </table>

   
<script type="text/javascript">

  $(document).ready(function() {
    $('#skips').DataTable( {
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

</script>


</body>
</html>