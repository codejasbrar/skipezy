<!doctype html>
<?php 
ini_set('display_errors',1); // enable php error display for easy trouble shooting
error_reporting(E_ALL); // set error display to all
include "navbar_list.php";
include "dbconfig.php";
include "php_functions.php";
$sql = "SELECT * FROM users order by first_name";
      //echo $sql;
      if (!mysqli_query($con,$sql)) 
        {   
          
          die('Select SQL SAID -Error : ' . mysqli_error($con));
        }
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

    $('#user').DataTable();

} );

</script>

</head>

<body>
  <div class="container-fluid">
   <div class="row">
    <div class="col-md-12" style="margin-top: 10%;box-shadow: 5px 5px 5px;">
    <div class="panel">
               <div class="panel-primary">
                 <div class="panel-heading"><h4><center>List Of All User</center></h4></div>
               </div>
             </div>
  </div>
  </div>
       <div class="row"> 
         <div class="col-md-12">    
                 <table id="user" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr class="btn-primary">
                           <th>First Name</th>
                           <th>Last Name</th>
                           <th>Role</th>
                           <th>Edit</th>
                           <th>View</th>
                           <th>Delete</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr class="btn-primary">
                           <th>First Name</th>
                           <th>Last Name</th>
                           <th>Role</th>
                           <th>Edit</th>
                           <th>View</th>
                           <th>Delete</th>
                        </tr>
                    </tfoot>
                    <?php
                        while($users=mysqli_fetch_assoc($res))
                         {
                    ?>
                    <tbody>
                        <tr>
                           <td><?php echo $users['first_name'];?></td>
                           <td><?php echo $users['last_name'];?></td>
                           <td><?php echo $users['role'];?></td>
                           <td><a  href="edit_user.php?cid=<?php echo $users['id'];?>"><i class="glyphicon glyphicon-check"></i></a></td>
                           <td><a href="edit_customer.php?id=2&order_id=<?php echo $user['id'];?>"><i class="glyphicon glyphicon-user"></i></a></td>
                           <td><a href="delete_customer.php?id=<?php echo $user['id'];?>"><i class="glyphicon glyphicon-trash"></i>
                </a></td>
                        </tr>
                        
                    </tbody>
                    <?php
                      }
                    ?>
                 </table>
                 </div>
             </div>
         </div>
         <!-- Modal -->
         <!-- End Modal -->
</body>
</html>