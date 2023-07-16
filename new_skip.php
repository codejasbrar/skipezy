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
   <form name="new_skip_form" id="new_skip_form">
<input type="hidden" name="new_skip_form"/>
      <div class="col-md-12" style="margin-top: 7%;">
        <div class="col-md-2"></div>
        <div class="col-md-8">
           <div class="panel">
              <div class="panel-primary" style="box-shadow: 5px 5px 5px;">
                 <div class="panel-heading">Creat Skip</div>
              </div>
              <div class="panel-body" style="background-color:#e9e9e9;box-shadow: 5px 5px 5px;">
                  <div class="col-md-6">
                  <label for="size">Size</label>
                  <div class="form-group">
                    <input type="text" id="size" name="size" placeholder="Enter Size" class="form-control">
                  </div>
              </div>
              <div class="col-md-6">
                 <label for="stock">Stock In Hand</label>
                  <div class="form-group">
                    <input type="text" id="stock" name="stock" placeholder="Enter Color" class="form-control">
                  </div>
              </div>
              <center>
              <div id="skip_created"></div><input style="background-color:#3699EB;"   id="save_skip" value="save" type="button" class="add_skip btn-large btn-lg pull-center btn-primary" ></center>
              </div>
           </div>
        </div>
        <div class="col-md-2"></div>
      </div>
      </form>
   </div>
   <!-- Script Start -->
        <script type="text/javascript">
            $('#save_skip').click(function(){
        alert("Demo");
              var form=$('#new_skip_form');
       var dataString = $("#new_skip_form").serialize();
       alert(dataString);
                $.ajax({
                    type: "POST",
                    url: "post_process.php",
              data: form.serialize(),
                    success: function(data) {
                     console.log(data); 
           $('#skip_created').html(data); 
                }
            });
        });
   
  </script>
   <!-- Script End -->
</body>
</html>