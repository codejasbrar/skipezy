<!doctype html>
<html>
<head>
<?php include "navbar.php";?>
<meta charset="utf-8">
<title>Untitled Document</title>

</head>

<body>
<br><br><br><br>
<table><tr>
<td class="map_address" style="cursor:pointer;"><b>UB3 4DD</b> </td>
</tr></table>
<iframe id="map" width="100%" height="450" frameBorder="0"></iframe>
<script type="text/javascript">

$('.map_address').click(function(){
	
var address = $(this).text();
alert(address);
$('#map_frame').html('<iframe id="map" width="100%" height="450" frameBorder="0"></iframe>');
var q=encodeURIComponent(address);
$('#map').attr('src','https://www.google.com/maps/embed/v1/place...');
$('html, body').animate({
scrollTop: $('#distributors_map').offset().top
}, 2000);

return false;
})
</script>
</body>
</html>