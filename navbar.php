<?php

include('messagefile.php');

?>
<?php date_default_timezone_set ("Europe/London");?>

<link rel="stylesheet" href="bs3/css/bootstrap.css">
<link rel="stylesheet" href="bs3/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-latest.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/style.css">
<link
    href='https://fonts.googleapis.com/css?family=Coda+Caption:800|Pacifico|Hind|Anton|Chewy|Bangers|Montserrat:400,700'
    rel='stylesheet' type='text/css'>
<style>
* {
    font-size: 12px;
    font-family: arial;
}

table th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: center;
    background-color: #4CAF50;
    color: white;
}

table td {
    align-content: center;
    margin-left: 2px;
    padding-left: 5px;
    padding-right: 5px;
    padding-top: 2px;
}

table {
    width: 100%;
    table-layout: auto;
}

table tr:nth-child(even) {
    background-color: #E0DFDF;
}

.navbar-inverse {
    background-color: #F3DB08;

    border-color: #f1f1f1;
}
</style>
<?php include "navbar_content.inc.php";?>