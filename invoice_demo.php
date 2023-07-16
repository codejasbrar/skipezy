<?php include "dbconfig.php";?>
<head>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
</head>
<form id="new_invoice">
    <table id="new_invoice_table" class="table table-bordered table-hover">
                      <thead>
                        
                        <tr class="btn-primary">
                             <th class="col-md-2">Sr. No.</th>
                             <th class="col-md-4"><center>Item</center></th>
                             <th class="col-md-4"><center>Quantity</center></th>
                             <th class="col-md-1"><center>Unit Price</center></th>
                             <th class="col-md-1"><center>Total</center></th>
                        </tr>     
                        </thead>
                        <tbody>
                           <tr>
                              <td class="col-md-2">&ensp;</td>
                              <td class="col-md-4">&ensp;</td>
                              <td class="col-md-4">&ensp;</td>
                              <td class="col-md-1">&ensp;</td>
                               <td class="col-md-1">&ensp;</td>
                           </tr>
                        </tbody>
                        <tbody>
                            <tr data-id="1"> 
                                <td class="row-num col-md-2">1</td>
                                <td class="col-md-4">
                                  <div class="form-group">
                                     
                                     <select id="item" name="item[]" class="form-control" style="width:70%;">
                             <option style="padding:10px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;" value="">Select a Skip </option>
                               <?php
                 
                  $customers_sql="SELECT * from skips order by size ASC";
                  $t_result=mysqli_query($con,$customers_sql);
                  while($skip=mysqli_fetch_assoc($t_result))
                  {
                  ?>
                  
  <option style="padding:10px; background-color:#9AD8EF; color:#320607; cursor:pointer;" value="<?php echo $skip['id']; ?>">
     <?php echo $skip['size']; ?>
    </option>
            <?php
            
            }
            ?>
                  </select> 
                                     
                                  </div>
                                </td>
                                <td class="col-md-4">
                                  <div class="form-group">
                                     <input id="qty_id_1" type="text" name="qty[]" class="form-control">
                                  </div>
                                </td>
                                <td class="col-md-1">
                                  <div class="form-group">
                                     <input id="unit_price_id_1"  type="text" role="unit_price1" name="unit_price[]" class="form-control">
                                  </div>
                                </td>
                                <td class="col-md-1">
                                  <div class="form-group">
                                     <input id="sub_total_id_1"  type="text" name="sub_total[]" class="form-control">
                                  </div>
                                </td>
                            </tr>
                        </tbody>
                        
                       
                      </table>
                     
                     <p><button type="button" id="add_row">Add More</button> </p>
</form>

<script src="js/jquery.js"></script>
<script src="js/init.js"></script>
<script>
var row = 1;
var qtyAttr = '',
	priceAttr = '';

$('#add_row').on('click', function(){
  row++;
  count = row-1;

  var html = '<tr data-id="'+row+'">';
  html += '<td class="row-num col-md-2"></td><td class="col-md-4">';
  html += '<div class="form-group">';
  html += '<select style="width:70%;" name="customer_name" id="item'+row+'"';
  html += 'class="form-control">';
  html += '<option style="padding:10px; background-color:#2977C9; color:#F9F0F1';
  html += 'cursor:pointer;" value=""></option></select></div></td>';
  html += '<td class="col-md-4"><div class="form-group">';
  html += '<input type="text" id="qty_id_'+row+'" name="qty[]" class="form-control">';
  html += '</div></td>';
  html += '<td class="col-md-1">';
  html += '<div class="form-group">';
  html += '<input type="text" id="unit_price_id_'+row+'" name="unit_price[]" class="form-control">';
  html += '</div></td>';
  html += '<td class="col-md-1"><div class="form-group">';
  html += '<input type="text" id="sub_total_id_'+row+'" name="sub_total[]" class="form-control">';
  html += '</div></td></tr>';
	
  $('#new_invoice_table tbody [data-id~="'+count+'"]').after(html);

});

$(window).on('click', function (event) {
	var target = $(event.target).attr('id');

	if (target.indexOf('qty_id_') == 0 || target.indexOf('unit_price_id_') == 0) {
		var len = target.length;
		var row = target.slice(len-1, len);

		set(row);
	}
});

function set(row) {
	elm1 = $('#qty_id_'+row);
	elm2 = $('#unit_price_id_'+row);

	$('#unit_price_id_'+row+', #qty_id_'+row).on('keyup', function() {
      var qty = elm1.val();
      var qty = (qty > 0) ? qty : 1 ;

      var unitPrice = elm2.val();
      var unitPrice = (unitPrice > 0) ? unitPrice : 1 ;

      var subTotal = qty * unitPrice;          
      
       $('#sub_total_id_'+row).val(subTotal);

      if (elm1.val().length < 1 && elm2.val().length < 1) {
        $('#sub_total_id_'+row).val('');
      }
  });
}

</script>