<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(window).on('load',function(){
        $('#myModal').modal('show');
    });
    
    $(function() {
      $('#myModal').modal({
        show: true,
        keyboard: false,
        backdrop: 'static'
      });
    });
    
    
    $(function() {
	$(this).bind("contextmenu", function(e) {
		e.preventDefault();
	});
});
    
</script>


<?php
    
    $cuurrent = date("Y-m-d");
    
    if( $cuurrent < '2019-09-14' ){
        
     ?>
     
     <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
    
      <div class="modal-body">
        <div class="QucikMessage">
    
    <h1>Your payment is due Now £500 + £100 is due</h1>
    
    <h1>Please pay today. Software will stop </h1>
    
</div>

<!-- Modal -->


<style>
    /*
    .QucikMessage {
    float: left;
    width: 100%;
    text-align: center;
}

.QucikMessage h1 {
    color: red;
    font-weight: 800;
}
    
    .QucikMessage h1 {
    color: red;
    font-weight: 800;
    font-size: 80px;
}
.modal-dialog {
    width: 1100px !important;
    margin: 30px auto;
}
    .body {
    background-color: rgba(1, 1, 1, 0.7);
    bottom: 0;
    left: 0;
    position: fixed;
    right: 0;
    top: 0;
}

.modal-backdrop.in {
    opacity: 0.9 !important;
  
}

.QucikMessage h1 {
    color: #FFEB3B !important;
    font-weight: 800;
    font-size: 80px;
}
.modal-body {
    position: relative;
    padding: 20px;
    float: left;
}

*/
</style>
      </div>
     <!--- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>--->
    </div>

  </div>
</div>
     
     
     <?php
        
    }

?>


