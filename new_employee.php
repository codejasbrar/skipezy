<!doctype html>
<?php 
include "navbar.php";

?>
<html>
<head>
<meta charset="utf-8">
<title>SkipTrak Software for Skip Hire Business</title>

</head>

<body>
   <div class="container-fluid">
      <div class="col-md-12" style="margin-top: 7%;">
         <div class="col-md-2"></div>
         <div class="col-md-8">
         <form name="new_employee_form" id="new_employee_form">
      <input type="hidden" name="new_employee_form"/>
            <div class="row">
               <div class="panel">
                  <div class="panel-primary" style="box-shadow: 5px 5px 5px;">
                      <div class="panel-heading"><center><h4>Personal Detail</h4></center></div>
                  </div>
                  <div class="panel-body" style="background-color:#e9e9e9; box-shadow: 5px 5px 5px;">
                      <div class="col-md-6">
                        <label for="name">Name</label>
                         <div class="form-group">
                          <input type="text" id="name" name="name" placeholder="Enter Name..." class="form-control">
                         </div>
                         <label for="mobile">Mobile</label>
                         <div class="form-group">
                           <input type="text" id="mobile" name="mobile" placeholder="Enter Mobile Number..." class="form-control">
                         </div>
                      </div>
                      <div class="col-md-6">
                        <label for="phone">Phone</label>
                         <div class="form-group">
                          <input type="text" id="phone" name="phone" placeholder="Enter Phone..." class="form-control">
                         </div>
                         <label for="email">Email</label>
                         <div class="form-group">
                           <input type="email" id="email" name="email" placeholder="Enter Email..." class="form-control">
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
                    <input type="text" id="address1" name="address1" placeholder="Enter Address..." class="form-control">
                  </div>
                  <label for="city">City</label>
                  <div class="form-group">
                    <input type="text" id="city" name="city" placeholder="Enter City..." class="form-control">
                  </div>
                  </div>
                  <div class="col-md-6">
                    <label for="address2">Address Line2</label>
                  <div class="form-group">
                    <input type="text" id="address2" name="address2" placeholder="Enter Address" class="form-control">
                  </div>
                   <label for="post_code">Post Code</label>
                  <div class="form-group">
                    <input type="text" id="post_code" name="post_code" placeholder="Enter Post Code" class="form-control">
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
                    <input type="text" id="emergency_contact" name="emergency_contact" placeholder="Enter Contact" class="form-control">
                  </div>
                  <label for="emergency_phone">Emergency Phone</label>
                  <div class="form-group">
                    <input type="text" id="emergency_phone" name="emergency_phone" placeholder="Enter Emergency Phone" class="form-control">
                  </div>
                        </div>
                        <div class="col-md-6">
                          <label for="relation">Relation</label>
                  <div class="form-group">
                    <input type="text" id="relation" name="relation" placeholder="Enter Relation..." class="form-control">
                  </div>
                  <label for="job_title">Job Title</label>
                  <div class="form-group">
                    <input type="text" id="job_title" name="job_title" placeholder="Enter job title" class="form-control">
                  </div>
              </div>
               </div>
                  </div>
                    </div>
                     </form>
                               <div class="row">
                    <div class="panel">
                      <div class="panel-primary" style="box-shadow: 5px 5px 5px;">
                        <div class="panel-heading"><center><h4>Document</h4></center></div>
                      </div>
                        <div class="panel-body" style="background-color:#e9e9e9; box-shadow: 5px 5px 5px;">
                           <div class="col-md-6">
                           <label for="license_type">License Type</label>
                           <div class="form-group">
                            <input type="text" id="license_type" name="license_type" placeholder="Enter License Type" class="form-control">
                           </div>
                           <label for="photo">Photo</label>
                           <div class="form-group">
                            <input type="file" id="photo" name="photo" class="form-control">
                          </div>
                          <label for="passport">Passport</label>
                          <div class="form-group">
                            <input type="file" name="passport" id="passport" class="form-control">
                         </div>
                           </div>
                        <div class="col-md-6">
                       <label for="license_number">License Number</label>
                      <div class="form-group">
                       <input type="text" id="license_number" name="license_number" placeholder="Enter License Number" class="form-control">
                     </div>
                     <label for="license_document">License Document</label>
                     <div class="form-group">
                      <input type="file" id="license_document" name="license_document" class="form-control">
                     </div>
                     <label for="p45">P45</label>
                     <div class="form-group">
                      <input type="file" id="p45" name="p45" class="form-control">
                     </div>
                           </div>
                            <div id="employee_created"></div>
               <center><button id="save_employee" class="btn btn-lg btn-primary" type="button" name="btn">Save</button></center>
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
            <script type="text/javascript">
            $('#save_employee').click(function(){
        alert("Demo");
              var form=$('#new_employee_form');
       var dataString = $("#new_employee_form").serialize();
       alert(dataString);
                $.ajax({
                    type: "POST",
                    url: "post_process.php",
              data: form.serialize(),
                    success: function(data) {
                     console.log(data); 
           $('#employee_created').html(data); 
                }
            });
        });
   
  </script>
         <!-- Script End -->
</body>
</html>