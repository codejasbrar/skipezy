<!doctype html>
<html>
<head>

<meta charset="utf-8">
<title>Untitled Document</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<?php  include "navbar.php";?>
</head>

<body>
<br><br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<div class="frmSearch">
	<input type="text" id="search-box" placeholder="Country Name" />
	<div id="suggesstion-box"></div>
</div>
<script>
// AJAX call for autocomplete 
$(document).ready(function(){
	$("#search-box").keyup(function(){
		//alert("Demo");
		$.ajax({
		type: "POST",
		url: "customer_id.php",
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			//$("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#search-box").css("background","#FFF");
		}
		});
	});
});
//To select country name
function selectCountry(val) {
$("#search-box").val(val);
$("#suggesstion-box").hide();
}
</script>
</body>
</html>