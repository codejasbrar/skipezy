<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Print Invoice</title>
    <?php

	include "navbar.php";
?>
</head>

<body>
    <form id="form1" runat="server">
    <div id="printablediv" style="width: 100%; background-color: Blue; height: 200px">
        Print me I am in 1st Div
    </div>
    <div id="donotprintdiv" style="width: 100%; background-color: Gray; height: 200px">
        I am not going to print
    </div>
    <input type="button" value="Print 1st Div" onclick="javascript:printDiv('printablediv')" />
    </form>



    <script language="javascript" type="text/javascript">
        function printDiv(divID) {
            //Get the HTML of div
            var divElements = document.getElementById(divID).innerHTML;
            //Get the HTML of whole page
            var oldPage = document.body.innerHTML;

            //Reset the page's HTML with div's HTML only
            document.body.innerHTML = 
              "<html><head><title></title></head><body>" + 
              divElements + "</body>";

            //Print Page
            window.print();

            //Restore orignal HTML
            document.body.innerHTML = oldPage;

          
        }
    </script>
</body>
</html>