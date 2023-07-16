<?php
require_once("../dbconfig.php");
if(!empty($_POST["customer_id"])) {
$query ="SELECT * FROM delivery_address WHERE customer_id = '" . $_POST["customer_id"] . "' AND address1 like '%" . $_POST["address"] . "%' ORDER BY post_code";
//echo $query;
$result = $con->query($query);
$rowcount=mysqli_num_rows($result);

if($rowcount>0) {
?>
<ul id="name-list">
<?php
foreach($result as $customer) {
?>
<li style="cursor: pointer; margin-left:0px; width:250px;font-family:Montserrat; font-size:12px;border-style:groove; font-weight:bold; color:#FBF2F2; padding:6px; background-color:#05629E;" onmouseover="hover(this)" onMouseOut="not_hover(this)"  onClick="selectAddress('<?php echo $customer["id"].'-'.$customer["address1"]." - ".$customer["post_code"]." - ".$customer["city"]." - ".$customer["site"]."-".$customer["post_code"]; ?>');"> <?php echo $customer["address1"]." - ".$customer["post_code"]; ?></li>

<?php } ?>

<?php }

echo '</ul>';

 } ?> 
 
 <script>
 function hover(element)
{
    element.style.backgroundColor = "red";
}
function not_hover(element)
{
    element.style.backgroundColor = "#05629E";
}
 </script>