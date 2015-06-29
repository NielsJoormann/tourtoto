<?php

  require_once 'query.php';
  require_once 'deleteQuery.php';
  require_once 'insertQuery.php';
  require_once 'selectQuery.php';
  require_once 'updateQuery.php';
  
  class display {
  public function __construct(){

        $this->deleteQuery = new deleteQuery();
        $this->insertQuery = new insertQuery();
        $this->selectQuery = new selectQuery();
        $this->updateQuery = new updateQuery();
    


        
    }
  }

