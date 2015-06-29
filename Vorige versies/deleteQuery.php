<?php
require_once 'databaseConnector.php';
require_once 'query.php';
  
 class deleteQuery extends query  {
     
          
     var $connector;
     var $connection;
     var $query;
      
     
     public function __construct(){
         $this->connector = new databaseConnector();
         $this->connection = $this->connector->__construct();
         $this->query = new query;

    }
    
    public function deleteEmptyTotoploegrenner($totospeler_id){
        
         $opdracht = "DELETE FROM totospelerploeg WHERE totospeler_id = '$totospeler_id' AND renner_id = 'NULL'";
         $connection = $this->connection;         

         $this->executeQuery($connection, $opdracht);  
    }
    
        public function deleteOneTotoploegrenner($totospeler_id, $renner_id){
        
         $opdracht = "DELETE FROM totospelerploeg WHERE totospeler_id = '$totospeler_id' AND renner_id = '$renner_id'";
         $connection = $this->connection;         

         $this->executeQuery($connection, $opdracht);  
    }
    
 }