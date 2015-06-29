<?php
require_once ('databaseConnection.Class.php');
require_once ('etapperegel.Class.php');
require_once ('totospelerploeg.Class.php');
require_once ('totospeler.Class.php');
require_once ('config.php');
require_once('dataProvider.Class.php');
$conn = new DBconnection($pdoconfig);
$dataprovider = new Dataprovider($conn);
$renners = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25);
$dataprovider->addNewTotoPloeg('Speler1',$renners);

?>