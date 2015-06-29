<?php

 class databaseConnector {
    var $connection;
    
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
     
     public function __destruct() {
         $this->thread = mysqli_thread_id($this->connection);
         mysqli_kill($this->connection, $this->thread);
         mysqli_close($this->connection);
     }
  }


 ?>