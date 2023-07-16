<!doctype html>
<?php 
//include "admin_side_bar.php";
include "navbar.php";

?>
<html>
<head>
   <link rel="stylesheet" href="font-awesome-4.6.3/css/font-awesome.min.css">
<meta charset="utf-8">
<title>SkipTrak Software for Skip Hire Business</title>
<script>
   
   $(document).ready(
      function () {
      $('#start_date').datepicker({
        changeMonth: true,//this option for allowing user to select month
        changeYear: true, //this option for allowing user to select from year range
        dateFormat: 'yy-mm-dd'
      });
      }
    
    );
   </script>
</head>

<body>
    <div class="container-fluid" id="vehicle_created">
     <form  id="new_vehicle_form">
    <div class="col-md-12" style="margin-top:7%;">
         <div class="col-md-2"></div>
         <div class="col-md-8">
             <div class="panel">
                <div class="panel-primary" style="box-shadow: 5px 5px 5px;">
                   <div class="panel-heading"><h3><center>Vehicle Detail</center></h3></div>
                </div>
                <div class="panel-body" style="background-color:#e9e9e9;box-shadow: 5px 5px 5px;">
                   <div class="col-md-1"></div>
                  <div class="col-md-5">
                   <label for="mileage">Mileage</label>
                  <div class="input-group">
                    <input type="text" id="mileage" name="mileage" placeholder="Enter Mileage" class="form-control">
                    <span class="input-group-btn">
                  <span class="btn btn-default pull-right"> 
                    <i class="fa fa-subway"></i>
                  </span>  
                </span>
                  </div><br>
                  <label for="road_tax_vehicle">Road Tax Vehicle</label>
                  <div class="input-group">
                    <input type="text" id="road_tax" name="road_tax" placeholder="Enter Mileage" class="form-control">
                    <span class="input-group-btn">
                  <span class="btn btn-default pull-right"> 
                    <i class="glyphicon glyphicon-calendar"></i>
                  </span>  
                </span>
                  </div><br>
                  <label for="pmi_date">PMI Date</label>
                  <div class="input-group">
                    <input type="text" id="pmi_date" name="pmi_date" placeholder="Enter Mileage" class="form-control">
                      <span class="input-group-btn">
                  <span class="btn btn-default pull-right"> 
                    <i class="glyphicon glyphicon-calendar"></i>
                  </span>  
                </span>
                  </div><br>
                  <center>
                     <button type="button" id="save_vehicle" class="btn btn-lg btn-block btn-primary" >Save</button>
                  </center>
              </div>
               <div class="col-md-5">
                 <label for="regplate">Reg Plate</label>
                  <div class="input-group">
                    <input type="text" id="reg_plate" name="reg_plate" placeholder="Enter Reg Plate" class="form-control">
                    <span class="input-group-btn">
                  <span class="btn btn-default pull-right"> 
                    <i class="fa fa-subway"></i>
                  </span>  
                </span>
                  </div><br>
                  
                  <label for="motdate">MOT Date</label>
                  <div class="input-group">
                    <input type="text" id="mot_date" name="mot_date" placeholder="Enter Mot Date" class="form-control">
                      <span class="input-group-btn">
                  <span class="btn btn-default pull-right"> 
                    <i class="glyphicon glyphicon-calendar"></i>
                  </span>  
                </span>
                  </div><br>
                  <label for="last_service_date">Last Service Date</label>
                  <div class="input-group">
                    <input type="text" id="service_date" name="service_date" placeholder="Enter Last Sirvice Date" class="form-control">
                      <span class="input-group-btn">
                  <span class="btn btn-default pull-right"> 
                    <i class="glyphicon glyphicon-calendar"></i>
                  </span>  
                </span>
                  </div><br>
                  <label for="tacograph"> Tacograph T2 T6 (Annual )</label>
                  <div class="input-group">
                    <input type="text" id="taco_date" name="taco_date" placeholder="Enter Last Sirvice Date" class="form-control">
                      <span class="input-group-btn">
                  <span class="btn btn-default pull-right"> 
                    <i class="glyphicon glyphicon-calendar"></i>
                  </span>  
                </span>
                  </div><br>
                  </label>
                   <label for="insurance_renewal_date">Insurance Renewal Date</label>
                  <div class="input-group">
                 
                    <input type="text" id="insurance_date" name="insurance_date" placeholder="Enter Last Sirvice Date" class="form-control">
                      <span class="input-group-btn">
                  <span class="btn btn-default pull-right"> 
                    <i class="glyphicon glyphicon-calendar"></i>
                  </span>  
                </span>
                  </div><br>
              </div>
              <div class="col-md-12">
              
                  </div>
                  
                   <div class="col-md-1"></div>                                   
                  </div>
                </div>
             </div>
         </div>
        <div class="col-md-2"></div>
         </form>
      </div>
    </div>
    <script type="text/javascript">
            $('#save_vehicle').click(function(){
      alert("Demo");
        var form=$('#new_vehicle_form');
       var dataString = $("#new_vehicle_form").serialize();
       alert(dataString);
                $.ajax({
                    type: "POST",
                    url: "create_vehicle.php",
                    data: form.serialize(),
                    success: function(data) {
                    //console.log(data); 
           $('#vehicle_created').html(data); 
            window.location.reload();
                }
            });
        });
   
  </script>
</body>
</html>