<?php
require_once  'query.php';
  
 class updateQuery extends query  {
     
     
          
     var $connector;
     var $connection;
     var $query;
      
     
     public function __construct(){
         $this->connector = new databaseConnector();
         $this->connection = $this->connector->__construct();
         $this->query = new query;

    }
     
     public function setReserveTotoploegrenner($renner_id, $totospeler_id){
             // verander de status van een totoploegrenner in reserve.
             $opdracht = "UPDATE totospelerploeg SET reserve = '1' WHERE renner_id = '".$renner_id."' AND totospeler_id = '".$totospeler_id."'";
             
             $connection = $this->connection;         

            $this->executeQuery($connection, $opdracht);  
             
     }
//     
     public function unsetReserveTotoploegrenner($renner_id, $totospeler_id){
             // verander de status van een totoploegrenner in actief.
             $opdracht = "UPDATE totospelerploeg SET reserve = '0' WHERE renner_id = '".$renner_id."' AND totospeler_id = '".$totospeler_id."'";
             
             $connection = $this->connection;         

            $this->executeQuery($connection, $opdracht);  
             
     }
 }