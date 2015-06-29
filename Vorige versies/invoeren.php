<?php

require 'displayInsert.php';

$display = new displayInsert();
  
echo "<!DOCTYPE html>

<html>
    <head>
        <meta http-equiv='content-type' content='text/html; charset=utf-8'></meta>
        <title></title>
    </head>
    <body>
    <a href='printen.php'>Printen</a>
    <a href='wijzigen.php'>Wijzigen</a>
    <a href='invoeren.php'>Invoeren</a>
    
<h1>Invoeren</h1>";

//$display->displayNewTotospeler();
//$display->displayNewTotoploegrenner();
//$display->displayNewTotoploegreserverenner();

$display->displayNewPloeg();






            

   echo "</body>
</html>";
        
?>
