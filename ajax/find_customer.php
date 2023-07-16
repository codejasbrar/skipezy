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
<li style="cursor: pointer; margin-left:0px; width:250px;font-family:Montserrat; font-size:12px; border-style:groove;font-weight:bold; color:#000000; padding:6px; list-style:none;  background-color:#F4F306;" onmouseover="hover(this)" onMouseOut="not_hover(this)" onClick="selectCustomer('<?php echo $customer["id"].'-'.$customer["name"].'-'.$customer["mobile"]; ?>');"><?php echo $customer["name"]." - ".$customer["mobile"]; ?></li>

<?php } ?>

<?php }
/*
else{
	echo '<li style="cursor: pointer; width:250px;font-family:Montserrat; font-size:12px; font-weight:bold; color:#FBF2F2; padding:10px; background-color:#05629E;" id="add_customer" class="btn btn-sm" >Add New Customer</li>';
	}
	*/
echo '</ul>';

 } ?>
<script>
function hover(element)
{
    element.style.backgroundColor = "red";
}
function not_hover(element)
{
    element.style.backgroundColor = "#F4F306";
}
 $('#add_customer').click(function(){
 var full_name=$('#search-name').val();	 
 $('#full_name').val(full_name);
 $('#new_customer').show();
 $("#old_customer_id").val('0');
 $("#delivery_address").hide();
 $('.job-details').show();
});
</script>