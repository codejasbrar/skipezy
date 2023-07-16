<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>


<link rel="stylesheet" href=" https://bootswatch.com/spacelab/bootstrap.css">
<link rel="stylesheet" href="http://bootswatch.com/spacelab/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>

<body>
<h1><p id="clickme">I am a id - Click Me</p></h1>
<h2><p class="clickme"> I am a class - Click Me</p></h2>

<div class="col-lg-12">
<h2>4. Delete Issue</h2>
<table><tr><td>
                            <a href="#" data-href="yourfile.php?id=<?php echo "your_url";?>" data-toggle="modal" data-target="#confirm-delete"><i class="glyphicon glyphicon-trash"></i> Click to Delete</a><br><a>
                </a>
                </td>
                
                </tr></table>
                </div>
                <!-- Delete Modal -->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Confirm Cancellation?</h4>
                </div>
            
                <div class="modal-body">
                    <p style="background-color:#EF0E12; color:white; font-size:20px;">Are you 100% Sure and Manager has Authorised?<img width="100" height="100" src="images/delete.png" class="img-thumbnail responsive">
                    </p>
                    
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">I am not Sure</button>
                    <a class="btn btn-danger btn-ok">I am sure - Cancel Job </a>
                </div>
            </div>
        </div>
    </div>
<!-- Delete Modal Ends -->
<script type="text/javascript">
 $( document ).ready(function() {
	 

 });
 $('#clickme').click(function(){
	document.bgColor='green';

	alert("You clicked id paragraph");
	});
	
	$('.clickme').click(function(){
	document.bgColor='red';

	alert("Class Clicked");
	
	});
	// Delete button Request yes no

        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            
        });
</script>
<br><br>
<b><a class="btn btn-primary btn-sm" href="https://drive.google.com/open?id=18fux2jXfraw7rfl-8upPJnziUyjBY-HXat6MzPZWhyE"> I have Many Php Learners - You can be one - Click Here</a>
</body>
</html>