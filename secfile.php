<tbody>
              <tr>
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
                  <option style="padding:10px; background-color:#9AD8EF; color:#320607; cursor:pointer;" value="<?php echo $skip['id']; ?>"> <?php echo $skip['size']; ?> </option>
                  <?php
            
            }
            ?>
                </select>
              </div>
              
              </td>
            <td class="col-md-4"><div class="form-group">
                <input id="qty" type="text" name="qty[]" class="form-control">
              </div></td>
            <td class="col-md-1"><div class="form-group">
                <input id="unit_price"  type="text" name="unit_price[]" class="form-control">
              </div></td>
            <td class="col-md-1"><div class="form-group">
                <input id="sub_total"  type="text" name="sub_total[]" class="form-control">
              </div></td>
          </tr>
            </tbody>