<?php
require_once('entity.Class.php');

 class land  extends entity {
     protected $code; 
     protected $naam; 
     
//====================================================================================================================
//PUBLIC METHODS
//====================================================================================================================	
	public function __construct($id, $conn)
	{
		$this->tablename = "land";
		parent::__construct($id, $conn);
                
         
                
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
        public function createLand($naam, $code){
            //toevoegen van een nieuw land

            //echo "<p>Er wordt een nieuw land genaamd ".$naam." toegevoegd</p>";

            //controle op al bestaand land
            $landControle = $this->selectOneLandnaam($naam);
            
            if($landControle == null){
                    $opdracht = "INSERT INTO land (code, naam) VALUES ('$code', '$naam')";
                    $this->executeQuery($opdracht);
                    echo "<p>Het land genaamd ".$naam." is toegevoegd met als code ".$code."</p>";

            } else {
                    echo "<p>Het land genaamd ".$naam."  kon niet worden toegevoegd.</p>";
            };
        }
        
        public function createLandcode($naam){
            $this->i = 0;
            $this->landcode = "(";
            $this->landcode .= $naam[$this->i];
            $this->landcode .= $naam[$this->i+1];
            $this->landcode .= $naam[$this->i+2];
            $this->landcode .= ")";
            $this->landcode = strtoupper($this->landcode);
            return $this->landcode;
        }
        
        public function createLandcodeAlternative($naam){
            $this->landcode = "(";
            $this->landcode .= $naam[$this->i];
            $this->landcode .= $naam[$this->i+2];
            $this->landcode .= $naam[$this->i+3];
            $this->landcode .= ")";
            $this->landcode = strtoupper($this->landcode);
            return $this->landcode;

        }
        
        ////////////////
        //READ METHODS
        
        public function selectOneLand($land_id){
            $opdracht = "SELECT id FROM $this->tablename WHERE id = ".$land_id;

            $this->executeQuery($opdracht);  
        }
        
        public function selectOneLandnaam($naam){
            
            $opdracht = "SELECT naam FROM $this->tablename WHERE naam = ".$naam;

            $this->result = $this->executeQuery($opdracht);  
                 
            if($this->result == null){
                     //echo "<p>Er bestaat (nog) geen land met de naam ".$naam."</p>";

            } else {
                     $this->naam =  $this->result['naam'];
                     return $this->naam;
            }
        }
        
        public function selectOneLandcode($code){
            $opdracht = "SELECT code FROM $this->tablename WHERE code = ".$code;

            $this->result = $this->executeQuery($opdracht);  

            if($this->result == null){
                //echo "<p>Landcode ".$code." is nog niet aanwezig in de database</p>";
            } else {
               $code = $this->result["code"];
               echo $code;
               return $code;
            };
        }
        
        
        //////////////
        //UPDATE METHODS
        
        protected function convertLandIdtoNaam ($landId){
             
            // zet de id van een land om in de naam

            $opdracht = "SELECT naam FROM $this->tablename WHERE id =".$landId; 

            $landNaam = $this->executeQuery($opdracht);  

            return $landNaam;
        }
        
        public function convertLandNaamtoId ($landnaam){
             
             // zet de naam van een land om in de id

        $opdracht = "SELECT id FROM $this->tablename WHERE naam =".$landnaam; 
       
        $this->result = $this->executeQuery($opdracht);  
        
            if($this->result == null){
                //echo "<p>Geen land gevonden met als naam ".$landnaam."</p>";
            } else {
                $this->landid = $this->result["id"];
                echo $this->landid;
                return $this->landid;

            };
        
        }
        
        //////////////
        //DELETE METHODS

//===================================================================================================
//PUBLIC METHODS
//===================================================================================================
        
   	
   	public function getCode()
	{
		return $this->code;
	}
   
        public function setCode($code)
	{
		$this->code = $code;
		return $this->code;
	}  
        
           	public function getNaam()
	{
		return $this->naam;
	}
   
        public function setNaam($naam)
	{
		$this->naam = $naam;
		return $this->naam;
	}  
     
 };
 

