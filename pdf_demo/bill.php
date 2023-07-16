<!DOCTYPE html> 
<html> 
<head> 
<link rel="stylesheet" href=" https://bootswatch.com/flatly/bootstrap.css">
<link rel="stylesheet" href="http://bootswatch.com/flatly/bootstrap.min.css">

    <meta charset='utf-8' /> 
    <title>Invoice Form</title> 
    <link rel="stylesheet" href="style.css" /> 
    <style>@media print {
  * {
    color: #000 !important;
    text-shadow: none !important;
    background: transparent !important;
    box-shadow: none !important;
  }</style>
</head> 
<body>
<div id="wrap"><div> 
    <h1>AGRO PHARMA NUTRITION</h1> 
<form method="post" action="create_reciept.php"> 
 <fieldset> 
    <legend>Sales Bill Information</legend> 
  <div class="col-xs-6">
  <h2>
    
      <img src="round.jpg" width="70" height="70">
    </a>
  </h2>
</div>
<div class="col-xs-6 text-right">
  <h3>Sales Bill</h3>
  <h3><small>Bill #001</small></h3>
  <h3><small>Bill Date 10/12/2016</small></h3>
</div>
<hr>
<div class="row">
        <div class="col-xs-5">
          <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4>From: <a href="#">AGRO PHARMA</a></h4>
                  </div>
                  <div class="panel-body">
                    <p>
                      Sher Jung Road <br>
                      Jagron <br>
                      M:83600 23377 <br>
                    </p>
                  </div>
                </div>
        </div>
        <div class="col-xs-5 col-xs-offset-2 text-right">
          <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4>To : <input type='text' value='Aneja Poultry Farm' name='name' /></h4>
                  </div>
                  <div class="panel-body">
                    <p>
                      Main Road <br>
                      Zira <br>
                      <input type='text' style="width:20%;" value='Zira' name='address' /> <br>
                    </p>
                  </div>
                </div>
        </div>
      </div> <!-- / end client details section --> 
</fieldset> 
<fieldset> 
    <legend>Sales Bill</legend> 
    
 <table class="table table-bordered">
        <thead>
          <tr bgcolor="#F18A8C">
            <th><h4>No.</h4></th>
            <th colspan="2"><h4>Particulars</h4></th>
            <th><h4>Batch No.</h4></th>
            <th><h4>Mfg. Dt.</h4></th>
            <th><h4>Exp Dt.</h4></th>
            <th><h4>Qty</h4></th>
            <th><h4>Rate</h4></th>
            <th><h4>Amount</h4></th>
          </tr>
        </thead>
       
        <tbody>
          
        
       
         <tr>
            <td>1</td>
            <td colspan="2" class="text-right"><input type='text' style="width:120%;" value='Agrocol Goldstar 5 LTR' name='item[]' /></td>
            <td class="text-right"><input type='text' value='Ac 023564' style="width:70%;" name='batch[]' /></td>
             <td class="text-right"><input type='text' style="width:70%;" value='OCt 2016' name='mfg[]' /></td>
              <td class="text-right"><input type='text' style="width:70%;" value='Dec 2017' name='exp[]' /></td>
              <td class="text-right"><input type='text' value='25 packets' name='qty[]' /></td>
             <td class="text-right"><input type='text' value='200.00' name='rate[]' /></td>
              <td class="text-right"><input type='text' value='5000.00' name='amount[]' /></td>
          </tr>
           <tr>
            <td>2</td>
            <td colspan="2" class="text-right"><input type='text' style="width:120%;" value='Agrocol Goldstar 5 LTR' name='item[]' /></td>
            <td class="text-right"><input type='text' value='Ac 023564' style="width:70%;" name='batch[]' /></td>
             <td class="text-right"><input type='text' style="width:70%;" value='OCt 2016' name='mfg[]' /></td>
              <td class="text-right"><input type='text' style="width:70%;" value='Dec 2017' name='exp[]' /></td>
              <td class="text-right"><input type='text' value='12 pcs' name='qty[]' /></td>
             <td class="text-right"><input type='text' value='150.00' name='rate[]' /></td>
              <td class="text-right"><input type='text' value='1800.00' name='amount[]' /></td>
          </tr>
        
       
         <tr>
            <td>3</td>
            <td colspan="2" class="text-right"><input type='text' style="width:120%;" value='Agrocol Goldstar 5 LTR' name='item[]' /></td>
            <td class="text-right"><input type='text' value='Ac 023564' style="width:70%;" name='batch[]' /></td>
             <td class="text-right"><input type='text' style="width:70%;" value='OCt 2016' name='mfg[]' /></td>
              <td class="text-right"><input type='text' style="width:70%;" value='Dec 2017' name='exp[]' /></td>
              <td class="text-right"><input type='text' value='25 packets' name='qty[]' /></td>
             <td class="text-right"><input type='text' value='200.00' name='rate[]' /></td>
              <td class="text-right"><input type='text' value='5000.00' name='amount[]' /></td>
          </tr>
        </tbody>
      </table>
      </div>
      <!-- incase we need to show him the calcualtion -->
      <!--
<div class="row text-right">
  <div class="col-xs-2 col-xs-offset-8">
    <p>
      <strong>
        Sub Total : <br>
        TAX : <br>
        Total : <br>
      </strong>
    </p>
  </div>
  <div class="col-xs-2">
    <strong>
      Rs.5400.00 <br>
      N/A <br>
      Rs.5400.00 <br>
    </strong>
  </div>
</div>
-->
    <div class="row">
  <div class="col-xs-5">
    Canara Bank Account. 2116201001391<br>
    IFSC Code: CNR 25896541 <br>Branch: Gandhi Road, Moga
  </div>
  <div class="col-xs-4">
    For Agro Pharm Nutirtion<br>Auth Signatory
  </div>
  <div class="col-xs-3 pull-right">
    <button class="btn-sm btn-success pull-right">Save & Print</button>
  </div>
</div>

</fieldset>

</div></div>
</form>
</body>