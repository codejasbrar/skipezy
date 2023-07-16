<?php
require_once("../dbconfig.php");
if(!empty($_POST["keyword"])) {
$query ="SELECT * FROM customers WHERE name like '%" . $_POST["keyword"] . "%' ORDER BY name LIMIT 0,6";
$result = $con->query($query);
$rowcount=mysqli_num_rows($result);
//echo $rowcount;
if($rowcount>0) {
?>
<ul id="name-list">
<?php
foreach($result as $customer) {
?>
<li style="cursor: pointer; width:250px;font-family:Montserrat; font-size:12px; font-weight:bold; color:#FBF2F2; padding:10px; background-color:#05629E;" onClick="selectCustomer('<?php echo $customer["id"].'-'.$customer["name"].'-'.$customer["address1"].'-'.$customer["address2"].'-'.$customer["post_code"]; ?>');"><?php echo $customer["name"]; ?></li>

<?php } ?>
<script>
 $('#new_customer').hide();
 
 

</script>

<?php }

echo '</ul>';

 } ?>
<script>
 $('#add_customer').click(function(){
	 $("#suggesstion-box").hide();
 var full_name=$('#search-name').val();	 
 $('#full_name').val(full_name);
 $('#new_customer').show();
 $("#old_customer_id").val('0');
 $("#delivery_address").hide();
 $('.job-details').show();
});
</script>