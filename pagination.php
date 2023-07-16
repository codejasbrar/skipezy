<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php
include "dbconfig.php";

$query = "SELECT * from customers LIMIT 0, 10";


$start = $con->real_escape_string($_GET['s']);
$per_page = 10;
$start_page = ($start - 1) * $per_page;

$query = "SELECT * from customers LIMIT $start_page, $per_page";

//$query = "SELECT * from order_detail";
if ($result = $con->query($query)) {
$num_rows = $result->num_rows;

$total_pages =ceil($num_rows / $per_page);

if ($total_pages > 1) {
echo '<ul class="pagination">';
for ($i = 1; $i <= $total_pages; $i++) {
echo '<li><a href="customer_details.php?s='.$i.'"'>'.$i.</a></li>';
}
echo '</ul>';
}
}
?>

</body>
</html>