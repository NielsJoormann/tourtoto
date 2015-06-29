<?php

require 'displaySelect.php';

$display = new displaySelect();
  
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
    
<h1>Printen</h1>";

 $display->displayAllRenners();
 $display->displayAllTotoploegen();
 $display->displayOneRenner();
 $display->displayOneTotoploeg();




            

   echo "</body>
</html>";
        
?>
