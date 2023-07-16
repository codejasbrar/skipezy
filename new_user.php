<!doctype html>
<?php 
//include "admin_side_bar.php";
include "navbar.php";

?>
<html>
<head>
<meta charset="utf-8">
<title>SkipTrak Software for Skip Hire Business</title>

</head>

<body>
    <div class="container-fluid">
    <form name="new_user_form" id="new_user_form">
    <input type="hidden" name="new_user_form"/>
        <div class="col-md-12"  style="margin-top:7%;">
           <div class="col-md-2"></div>
           <div class="col-md-8">
               <div class="panel">
                  <div class="panel-primary" style="box-shadow: 5px 5px 5px;">
                    <div class="panel-heading"><h3><center>User Details</center></h3></div>
                  </div>
                  <div class="panel-body"  style="background-color:#e9e9e9; box-shadow: 5px 5px 5px;">
                     <div class="col-md-6">
                  <label for="first_name">First Name</label>
                  <div class="form-group">
                    <input type="text" id="first_name" name="first_name" placeholder="Enter First Name" class="form-control">
                  </div>
                  <label for="user_name">User Name</label>
                  <div class="form-group">
                    <input type="text" id="user_name" name="user_name" placeholder="Enter User Name" class="form-control">
                  </div>
                   <label for="email">Email</label>
                  <div class="form-group">
                    <input type="email" id="email" name="email" placeholder="Enter Email" class="form-control">
                  </div>
              </div>
              <div class="col-md-6">
                 <label for="last_name">Last Name</label>
                  <div class="form-group">
                    <input type="text" id="last_name" name="last_name" placeholder="Enter Last name" class="form-control">
                  </div>
                  <label for="password">Password</label>
                  <div class="form-group">
                    <input type="password" id="password" name="password" placeholder="Enter Password" class="form-control">
                  </div>
                   <label for="role">Role</label>
                  <div class="form-group">
                    <input type="text" id="role" name="role" placeholder="Enter Role" class="form-control">
                  </div>
              </div>
              <div class="col-md-4 pull-right">
              <center>
                <div id="user_created"></div><p style="background-color:#3699EB;"   id="save_user" class="add_customer btn-large btn-lg pull-center btn-default" >Save</p>
              </center>
              </div>
                  </div>
               </div>
           </div>
           <div class="col-md-2"></div>
        </div>
        </form>
    </div>
    <script type="text/javascript">
            $('#save_user').click(function(){
        alert("Demo");
              var form=$('#new_user_form');
       var dataString = $("#new_user_form").serialize();
       alert(dataString);
                $.ajax({
                    type: "POST",
                    url: "post_process.php",
              data: form.serialize(),
                    success: function(data) {
                     console.log(data); 
           $('#user_created').html(data); 
                }
            });
        });
   
  </script>
</body>
</html>