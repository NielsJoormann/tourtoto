<?php
require_once 'databaseConnector.php';
 
class query extends databaseConnector {
     var $query;
     var $connection;
     var $connector;
     var $opdracht;
     var $result;
     var $return;
    
     public function __construct(){
        $host = "localhost";
        $user = "root";
        $password = "";
        $dbname = "tourtoto";
        $this->connection = mysqli_connect($host, $user, $password, $dbname) or die ("Geen verbinding mogelijk");
        //var_dump($this->connection);
        //print_r($this->connection);

        return $this->connection;
     }
     
     
     
      public function executeQuery ($connection, $opdracht){
      // algemene opbouw van een query:
          if($opdracht !== null){
//            echo "<p>";
//              print_r($opdracht);
//            echo "</p>";
            
//             
          
            
            $this->query = mysqli_query($this->connection, $opdracht);
         
//            echo "<p>";
//              print_r($this->query);
//            echo "</p>";
            
            $this->result = mysqli_fetch_assoc($this->query);

            return $this->result;
          } else {
              echo "<p>Geen geldige query opgegeven!</p>";
          }
     }
      
};