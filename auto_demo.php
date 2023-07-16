<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<?php include "navbar.php";?>
</head>

<body>
<div>&nbsp;</div>
<input type="text" id="search-name" class="form-control" placeholder="Type a Customer Name" />

<div id="suggesstion-box"></div>
<script>
$(document).ready(function(){
	$("#search-name").keyup(function(){
		//$("#delivery_address").hide();
		//if any other div are open close them or hide them
		
		$.ajax({
		type: "POST",
		url: "find_customer.php",
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			$("#search-name").css("background","#FFF url(images/LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#search-name").css("background","#green");
		}
		});
	});
});

</script>
</body>
</html>