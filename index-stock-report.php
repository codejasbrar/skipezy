<?php

//include "dbconfig.php";

$sql="SELECT * FROM skips order by size ASC";

$res=mysqli_query($con,$sql);

//echo $sql;

?>

     
      <div class="col-md-12">
        <table  style="font-family:Montserrat; font-size:18px;" id="skips" class="table table-striped table-bordered table-hover" cellspacing="0">

        <thead>

            <tr class="btn-primary">

                           <th>Skip</th>
                           <th>Out</th>
                           
                         
            </tr>

        </thead>

        <tfoot>

            <tr class="btn-primary">
                           <th>Skip</th>
                           <th>Out</th>
                         
                           
            </tr>

        </tfoot>

        <tbody >

        <?php

                while($skip=mysqli_fetch_assoc($res))

                  {             
  ?>               
                              <td><?php echo $skip['size'];?></td>
                              
                     
                             <td><?php 
							 $current_stock=$skip['current_stock'];
							 echo $skip['owned']-$current_stock;?></td>
                          
                          </tr>
			      <?php  } ?>

            

            </tbody>

    </table>

    </div>
