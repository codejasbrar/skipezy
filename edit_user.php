<!DOCTYPE html>
<html>
<head>
  <title></title>
  <?php 
     include("navbar.php");
     include "dbconfig.php";
     include  "edit_backend_user.php";      
  ?>
</head>
<body>
   <form method="post">
      <div class="col-md-12" style="margin-top: 10%;">
         <div class="col-md-2"></div>
         <div class="col-md-8">
             <div class="panel">
                 <div class="panel-primary" style="box-shadow: 5px 5px 5px;">
                   <div class="panel-heading">Edit User Details</div>
                 </div>
                 <div class="panel-body" style="background-color:#e9e9e9;box-shadow:5px 5px 5px;">
                     <div class="col-md-6">
                        <?php  

                          $query=mysqli_query($con,"SELECT * FROM users WHERE id='$cid' ");
                          $row=mysqli_fetch_array($query);
                          $first_name=$row['first_name'];
                          $last_name=$row['last_name'];
                          $user_name=$row['user_name'];
                          $email=$row['email'];
                          $role=$row['role'];
                        ?>

                       <label for="first_name">First Name</label>
                  <div class="form-group">
                    <input type="text" name="first_name" value="<?php echo $first_name;?>" class="form-control">
                  </div>
                  <label for="user_name">User Name</label>
                  <div class="form-group">
                    <input type="text" name="user_name" value="<?php echo $user_name;?>" class="form-control">
                  </div>
                   <label for="email">Email</label>
                  <div class="form-group">
                    <input type="email" id="email" value="<?php echo $email;?>" name="email"class="form-control"> 
                  </div>
                     </div>
                     <div class="col-md-6">
                       <label for="last_name">Last Name</label>
                  <div class="form-group">
                    <input type="text" name="last_name" value="<?php echo $last_name;?>" class="form-control">
                  </div>
                   <label for="role">Role</label>
                  <div class="form-group">
                    <input type="text" name="role" value="<?php echo $role;?>" class="form-control">
                  </div>
                   <label>&ensp;</label>
                   <center><button type="submit" name="btn" class="btn btn-lg btn-block btn-success" >Update</button></center>
                     </div>
                     
                 </div>
             </div>
         </div>
         <div class="col-md-2"></div>
      </div>   
   </form>
</body>
</html>