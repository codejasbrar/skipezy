<html>
<head>
<?php include "navbar.php"; 
	include "dbconfig.php";
	?>
   <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
 <script src="//code.jquery.com/jquery-1.10.2.js"></script>
 <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
   <script>
  $(document).ready(function () {
      $('#start_date').datepicker({
        changeMonth: true,//this option for allowing user to select month
        changeYear: true, //this option for allowing user to select from year range
        dateFormat: 'yy-mm-dd'
      });
  });
  
  </script>
  

</head>
<body>

   <form method="post" action="create_waybridge.php">
   <input type="hidden" name="create_artic">
   <br><br>
      <div class="container-fluid">
         <div class="row">
            <div>&ensp;</div>
            <div>&ensp;</div>
            <div>&ensp;</div>
            <div>&ensp;</div>
         </div>
         <div class="row">
            <div class="col-md-12">
               <div class="col-md-2"></div>
               <div class="col-md-8">
                
                    <div class="panel" style="box-shadow: 5px 5px 5px;">
                     <div class="panel-primary">
                        <div class="panel-heading"><h5><center>In/Out Track Weekly</center></h5></div>
                     </div>
                     <div class="panel-body" style="background-color:#e9e9e9;">
                           <div class="col-md-6">
                             <label for="date" class="col-sm-3">Date</label>
                             <div class="form-group col-sm-9" data-provide="datepicker">
                             <input type="text" id="start_date" name="start_date"  placeholder="Select a Date" class="form-control input_class">
                              </div>
                           
                         <label for="size" class="col-sm-3">Size</label>
                        <div class="form-group col-sm-9">
                           <select name="size" class="form-control">
                              <option value="select_please">Select Please</option>
                              <option value="6 cu yd">6 cu yd</option>
                              <option value="8 cu yd">8 cu yd</option>
                              <option value="10 cu yd">10 cu yd</option>
                              <option value="12 cu yd">12 cu yd</option>
                              <option value="14 cu yd">14 cu yd</option>
                              <option value="20 cu yd">20 cu yd</option>
                              <option value="35 cu yd">35 cu yd</option>
                              <option value="40 cu yd">40 cu yd</option>
                           </select>
                        </div>
                        <label for="material" class="col-sm-3">Material</label>
                        <div class="form-group col-sm-9">
                           <select name="material" class="form-control">
                              <option value="select_please">Select Please</option>
                              <option value="Mixed" selected>Mixed</option>
                              <option value="Metal">Metal</option>
                              <option value="Wood">Wood</option>
                              <option value="Hard Core">Hard Core</option>
                              <option value="Paper">Paper</option>
                              <option value="Rubbish">Rubbish</option>
                              <option value="Soil">Soil</option>
                           </select>
                        </div>
                        </div>
                           <div class="col-md-6">
                              <label class="col-sm-4">Entry Type</label>
                              <div class="col-sm-8">
                                 <select name="entry_type" class="form-control">
                              
                              <option value="in">In</option>
                              <option value="out">Out</option>
                           </select>
                              </div><br><br>
                               <label class="col-sm-4">Vehicle Type</label>
                              <div class="col-sm-8">
                                 <select name="vehicle_type" class="form-control">
                              <option value="Skip Lorry">Skip Lorry</option>
                              <option value="Artic">Artic</option>
                              <option value="Tipper">Tipper</option>
                              <option value="Grab Lorry">Grab Lorry</option>
                              <option value="Van Tipper">Van Tipper</option>
                           </select>
                           <br><br>
                              <label for="quantity" class="col-sm-4">Quantity</label>
                              <div class="form-group col-sm-8">
                                 <input type="text" style="width:80%;" name="quantity" value="1" class="form-control" readonly>
                              </div>
                               <div class="form-group col-sm-12">
                                <input type="submit" style="cursor: pointer; font-family:Montserrat; font-size:18px; font-weight:bold; color:#FBF2F2; padding:10px; background-color:#46A818;"  class="btn-sm pull-right" value="Save">
                              </div>
                           </div>
                     </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-2"></div>
            </div>
         </div>
      </div>
   </form>
   
</body>
</html>