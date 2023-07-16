<?php
require_once("../dbconfig.php");
if(!empty($_POST["keyword"])) {
$query ="SELECT invoice_no from invoices WHERE invoice_no like '%" . $_POST["keyword"] . "%' ";
//echo $query;
$result = $con->query($query);
$rowcount=mysqli_num_rows($result);
//?>
<ul id="name-list">
<?php
if($rowcount>0) {
echo '<li style="background-color:#F90004; color:#F0E4E4;padding:10px;" class="btn btn-sm" >Invoice Number Taken</li>';
?>
<script>
 $('#new_customer').hide();
 
 

</script>

<?php }
else{
	echo '<li style="cursor: pointer; width:250px;font-family:Montserrat; font-size:12px; font-weight:bold; color:#000000; padding:10px; background-color:#0AF10F;" id="add_customer" class="btn btn-sm" >Available</li>';
	}
echo '</ul>';

 } ?>
<script>
 $('#add_customer').click(function(){
 var full_name=$('#search-name').val();	 
 $('#full_name').val(full_name);
 $('#new_customer').show();
 $("#old_customer_id").val('0');
 $("#delivery_address").hide();
 $('.job-details').show();
});
</script>