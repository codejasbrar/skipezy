<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<?php 
$address_variable="SL2 1NE, SL2 5JP";
 $address = str_replace(" ", "+",$address_variable);
?>
<iframe style="width:100%;height:50%;" frameborder="0" id="cusmap" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.it/maps?q=<?php echo $address; ?>&output=embed"></iframe>
</body>
</html>