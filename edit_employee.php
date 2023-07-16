<!doctype html>
<?php 
include "navbar.php";
include "dbconfig.php";
include "edit_backend_employee.php";
?>
<html>
<head>
<meta charset="utf-8">
<title>SkipTrak Software for Skip Hire Business</title>

</head>

<body>
<form method="post">
   <div class="container-fluid">
      <div class="col-md-12" style="margin-top: 7%;">
         <div class="col-md-2"></div>
         <div class="col-md-8">
            <div class="row">
               <div class="panel">
                  <div class="panel-primary" style="box-shadow: 5px 5px 5px;">
                      <div class="panel-heading"><center><h4>Personal Detail</h4></center></div>
                  </div>
                  <div class="panel-body" style="background-color:#e9e9e9; box-shadow: 5px 5px 5px;">
                      <div class="col-md-6">
                      <?php 
                          $query=mysqli_query($con,"SELECT * FROM employees WHERE id='$cid' ");
                          $row=mysqli_fetch_array($query);
                          $name=$row['name'];
                          $mobile=$row['mobile'];
                          $phone=$row['phone'];
                          $email=$row['email'];
                          $address1=$row['address1'];
                          $address2=$row['address2'];
                          $city=$row['city'];
                          $post_code=$row['post_code'];
                          $emergency_contact=$row['emergency_contact'];
                          $emergency_phone=$row['emergency_phone'];
                          $relation=$row['relation'];
                          $job_title=$row['job_title'];
                      ?>

                        <label for="name">Name</label>
                         <div class="form-group">
                          <input type="text" name="name" value="<?php echo $name;?>" class="form-control">
                         </div>
                         <label for="mobile">Mobile</label>
                         <div class="form-group">
                           <input type="text" name="mobile" value="<?php echo $mobile;?>" class="form-control">
                         </div>
                      </div>
                      <div class="col-md-6">
                        <label for="phone">Phone</label>
                         <div class="form-group">
                          <input type="text" name="phone" value="<?php echo $phone;?>" class="form-control">
                         </div>
                         <label for="email">Email</label>
                         <div class="form-group">
                           <input type="email" name="email" value="<?php echo $email;?>" class="form-control">
                         </div>
                      </div>
                  </div>
               </div>
            </div>
            <div class="row">
              <div class="panel">
                <div class="panel-primary" style="box-shadow: 5px 5px 5px;">
                   <div class="panel-heading"><center><h4>Address Detail</h4></center></div>
                </div>
                <div class="panel-body" style="background-color:#e9e9e9; box-shadow: 5px 5px 5px;">
                  <div class="col-md-6">
                   <label for="address1">Address Line1</label>
                  <div class="form-group">
                    <input type="text" name="address1" value="<?php echo $address1;?>" class="form-control">
                  </div>
                  <label for="city">City</label>
                  <div class="form-group">
                    <input type="text" name="city" value="<?php echo $city;?>" class="form-control">
                  </div>
                  </div>
                  <div class="col-md-6">
                    <label for="address2">Address Line2</label>
                  <div class="form-group">
                    <input type="text" name="address2" value="<?php echo $address2;?>" class="form-control">
                  </div>
                   <label for="post_code">Post Code</label>
                  <div class="form-group">
                    <input type="text" name="post_code" value="<?php echo $post_code;?>" class="form-control">
                  </div>
                  </div>
                </div>
              </div>
            </div> 
                <div class="row">
                  <div class="panel">
                    <div class="panel-primary" style="box-shadow: 5px 5px 5px;">
                      <div class="panel-heading"><center><h4>Emergency Contact Details</h4></center></div>
                    </div>
                    <div class="panel-body" style="background-color:#e9e9e9; box-shadow: 5px 5px 5px">
                        <div class="col-md-6">
                          <label for="emergency_contact">Emergency Contact</label>
                  <div class="form-group">
                    <input type="text" name="emergency_contact" value="<?php echo $emergency_contact;?>" class="form-control">
                  </div>
                  <label for="emergency_phone">Emergency Phone</label>
                  <div class="form-group">
                    <input type="text" name="emergency_phone" value="<?php echo $emergency_phone;?>" class="form-control">
                  </div>
                        </div>
                        <div class="col-md-6">
                          <label for="relation">Relation</label>
                  <div class="form-group">
                    <input type="text" name="relation" value="<?php echo $relation;?>" class="form-control">
                  </div>
                  <label for="job_title">Job Title</label>
                  <div class="form-group">
                    <input type="text" name="job_title" value="<?php echo $job_title;?>" class="form-control">
                  </div>
              </div>
               <center><button class="btn btn-lg btn-primary" type="submit" name="btn">Save</button></center>
               </div>
                  </div>
                    </div>
                     
                  </div>
                </div> 
         </div>
         </div>
         <div class="col-md-2"></div>
      </div>
     
   </div>

   
  <!-- Script Start -->
         <!-- Script End -->
         </form>
</body>
</html>