<?php
require_once('../resources/library/controllers/mainController.class.php');
session_start();    
$controller = new mainController();
$controller -> handleRequest();
