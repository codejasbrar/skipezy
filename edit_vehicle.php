<!doctype html>
<?php 
//include "admin_side_bar.php";
include "navbar.php";
include "dbconfig.php";
include "edit_backend_vehicle.php";

?>
<html>
<head>
<meta charset="utf-8">
<title>SkipTrak Software for Skip Hire Business</title>

</head>

<body>
  <form method="post">
    <div class="container-fluid">
    <div class="col-md-12" style="margin-top:7%;">
         <div class="col-md-2"></div>
         <div class="col-md-8">
             <div class="panel">
                <div class="panel-primary" style="box-shadow: 5px 5px 5px;">
                   <div class="panel-heading"><h3><center>Vehicle Detail</center></h3></div>
                </div>
                <div class="panel-body" style="background-color:#e9e9e9;box-shadow: 5px 5px 5px;">
                  <div class="col-md-6">
                  <?php
                     $query=mysqli_query($con,"SELECT * FROM vehicles WHERE id='$cid'");
                     $row=mysqli_fetch_array($query);
                     $name=$row['name'];
                     $make=$row['make'];
                     $mileage=$row['mileage'];
                     $reg_plate=$row['reg_plate'];
                     $model=$row['model'];
                     $mot_date=$row['mot_date'];
                     $service_date=$row['service_date'];

                  ?>
                  <label for="name">Name</label>
                  <div class="form-group">
                    <input type="text" id="name" name="name" value="<?php echo $name;?>" class="form-control">
                  </div>
                  <label for="make">Make</label>
                  <div class="form-group">
                    <input type="text" id="make" name="make" value="<?php echo $make;?>" class="form-control">
                  </div>
                   <label for="mileage">Mileage</label>
                  <div class="form-group">
                    <input type="text" id="mileage" name="mileage" value="<?php echo $mileage;?>" class="form-control">
                  </div>
                  <center>
                  <div id="vehicle_created"></div>
                     <button type="submit" name="btn" id="save_vehicle" class="btn btn-lg btn-block btn-primary" >Save</button>
                  </center>
              </div>
               <div class="col-md-6">
                 <label for="regplate">Reg Plate</label>
                  <div class="form-group">
                    <input type="text" id="regplate" name="regplate" value="<?php echo $reg_plate;?>" class="form-control">
                  </div>
                  <label for="model">Model</label>
                  <div class="form-group">
                    <input type="text" id="model" name="model" value="<?php echo $model;?>" class="form-control">
                  </div>
                  <label for="mot_date">MOT Date</label>
                  <div class="form-group">
                    <input type="date" id="mot_date" name="mot_date" value="<?php echo $mot_date;?>" class="form-control">
                  </div>
                  <label for="service_date">Last Service Date</label>
                  <div class="form-group">
                    <input type="date" id="service_date" name="service_date"value="<?php echo $service_date;?>" class="form-control">
                  </div>
              </div>
              <div class="col-md-12">
              
                  </div>
                  
                                                      
                  </div>
                </div>
             </div>
         </div>
        <div class="col-md-2"></div>
      </div>
    </div>
     </form>
</body>
</html>