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
foreach($result as $country) {
?>
<li style="cursor: pointer; font-family:Montserrat; font-size:14px; font-weight:bold; color:#FBF2F2; padding:10px; background-color:#46A818;" onClick="selectCountry('<?php echo $country["id"].'-'.$country["name"]; ?>');"><?php echo $country["name"]; ?></li>
<?php } ?>


<?php }
else{
	echo '<li style="cursor: pointer; font-family:Montserrat; font-size:18px; font-weight:bold; color:#FBF2F2; padding:10px; background-color:#46A818;" id="add_customer" class="btn btn-sm" >Add New Customer</li>';
	}
echo '</ul>';

 } ?>
<script>
 $('#add_customer').click(function(){
 $('search_text').hide();
 $('#new_customer').show();
});
</script>