

<?php
 //voorbeeld van de opbouw van een class
require_once('entity.Class.php');

 class leeg extends entity {
 protected $voornaam; 
     
//====================================================================================================================
//PUBLIC METHODS
//====================================================================================================================	
	public function __construct($id, $conn)
	{
		$this->tablename = "leeg";
		parent::__construct($id, $conn);
                
                $host = "localhost";
                $user = "root";
                $password = "";
                $dbname = "tourtoto";
                $this->connection = mysqli_connect($host, $user, $password, $dbname) or die ("Geen verbinding mogelijk");
                return $this->connection;
                
	}
        
        public function executeQuery ($opdracht){
            // algemene opbouw van een query:
          if($opdracht !== null){
            $connection = $this->connection;  
            $this->query = mysqli_query($connection, $opdracht);
            
            $this->result = mysqli_fetch_assoc($this->query);

            return $this->result;
          } else {
              echo "<p>Geen geldige query opgegeven!</p>";
          }
        }  
        
//===================================================================================================
//PROTECTED METHODS
//===================================================================================================
        //////////
        //CREATE METHODS
        
        ////////////////
        //READ METHODS
        
        //////////////
        //UPDATE METHODS
                
        //////////////
        //DELETE METHODS

//===================================================================================================
//PUBLIC METHODS
//===================================================================================================
        
        public function getVoornaam()
	{
		return $this->voornaam;
	}
        
        public function setVoornaam($voornaam)
	{
		$this->voornaam = $voornaam;
		return $this->voornaam;
	}
 };