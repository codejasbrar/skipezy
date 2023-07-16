<?php
require_once("dbconfig.php");
if(!empty($_POST["keyword"])) {
$query ="SELECT * FROM customers WHERE name like '" . $_POST["keyword"] . "%' ORDER BY name LIMIT 0,6";
$result = $con->query($query);
$rowcount=mysqli_num_rows($result);
//echo $rowcount;
if($rowcount>0) {
?>
<ul id="name-list">
<?php
foreach($result as $customer) {
?>
<li style="cursor: pointer; width:250px;font-family:Montserrat; font-size:12px; font-weight:bold; color:#FBF2F2; padding:10px; background-color:#46A818;" onClick="selectCustomer('<?php echo $customer["id"].'-'.$customer["name"]; ?>');"><?php echo $customer["name"]." - ".$customer["post_code"]; ?></li>
<div class="clearfix"></div>
<div>&nbsp;</div>
<script>
 $('#new_customer').hide();
 
 

</script>
<?php } ?>


<?php }
else{
	echo '<li style="cursor: pointer; width:250px;font-family:Montserrat; font-size:12px; font-weight:bold; color:#FBF2F2; padding:10px; background-color:#46A818;" id="add_customer" class="btn btn-sm" >Add New Customer</li>';
	}
echo '</ul>';

 } ?>
<script>
 $('#add_customer').click(function(){
 $('#new_customer').show();
 $("#old_customer_id").val('0');
 $("#customer_delivery_address").hide();
 
});
</script>