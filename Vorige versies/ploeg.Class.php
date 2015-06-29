<?php
require_once('entity.Class.php');

class ploeg extends entity {
     protected $code; 
     protected $naam; 
     protected $land_id; 
    
//====================================================================================================================
//PUBLIC METHODS
//====================================================================================================================	
	public function __construct($id, $conn)
	{
		$this->tablename = "ploeg";
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
        
        protected function createPloeg($naam, $landnaam){
                //toevoegen van een nieuwe ploeg
                $this->naam = $naam;
                
                //controle op al bestaande naam en code
                $this->naamControle = $this->selectOnePloegnaam($this->naam);

                if($this->naamControle !== null){
                    echo "<p>De ploeg ".$this->naam." bestaat al!</p>";
                    $validPloegnaam = false;

                    //            echo "<p>Valide ploegnaam? ";
                    //                var_dump($validPloegnaam);
                    //            echo "</p>";

                } else {
                    echo "<p>De ploeg ".$this->naam." bestaat nog niet maar wordt nu toegevoegd!</p>";
                    
                    $this->code = $this->createPloegcode($naam);

                    //controle op al bestaande ploegcode
                   
                    $ploegcodeControle = $this->selectOnePloegcode($this->code);

                    if($ploegcodeControle !== null){
                        //echo "<p>Uw ploegcode ".$this->code." is al in gebruik door een andere ploeg!</p>";
                        
                        $this->code = $this->createPloegcodeAlternative($naam);

                    }
                    
                    echo "<p>Uw ploegcode wordt ".$this->code." </p>";

                    $validPloegnaam = true; 

                };

                //controle op al bestaand land en code
                
                require_once 'land.Class.php';
                
                $land = new land();
                
                $this->land_id = $land->convertLandNaamtoId($landnaam);

                if($this->land_id == null){ //geen resultaten bij het zoeken naar dit land = dus een nieuw land dat nog niet voorkomt in de database (bijv. Verweggistan)
                    echo "<p>".$landnaam. " staat niet onze database! Het land wordt nu wel toegevoegd.</p>";

                    //aanmaken van de landcode voor dit land
                    $this->landcode = $land->createLandcode($landnaam);

                    $landcodeControle = $land->selectOneLandcode($this->landcode); //controle of deze landcode al bestaat

                    if($landcodeControle ==  false){ //de aangemaakte landcode kan niet gevonden worden of bestaat nog niet
                        
                        echo "<p>".$landnaam." krijgt de code ".$this->landcode."</p>";
                        
                        $land->createLand($landnaam, $this->landcode); //land wordt aangemaakt met de gemaakte landcode

                        $validLand = true;
                    } else { //de aangemaakte landccode komt al wel voor in de database, maar het land nog niet. Dus: maak een nieuwe landcode
                        $this->landcode = $land->createLandcodeAlternative($landnaam);        

                        echo "<p>".$landnaam." krijgt de code ".$this->landcode."</p>";

                        $land->createLand($landnaam, $this->landcode); //land wordt aangemaakt met de gemaakte landcode

                        $validLand = true;

                    }
                } else { //land bestaat al, ploeg kan hier vandaan komen
                   // echo "<p>".$landnaam." staat al in onze database. Uw ploeg valt vanaf nu onder dit land. </p>";
                   $validLand = true; 
                };

                if($validPloegnaam == true && $validLand == true){ //aanmaken van de nieuwe ploeg
                    $opdracht = "INSERT INTO $this->tablename (code, naam, land_id) VALUES ('$this->code', '$this->naam', '$this->land_id')"; 

                    $this->executeQuery($opdracht);  

                    echo "<p>Uw ploeg ".$this->naam." is toegevoegd aan de database met als code ".$this->code ;

                 } else {
                    echo "<p>Uw ploeg ".$this->naam."  kon niet worden toegevoegd</p>";
                };

            }

        protected function createPloegcode($naam){
            $this->naam = $naam;
            $this->i = 0;
            $this->code = $this->naam[$this->i];
            $this->code .= $this->naam[$this->i+1];
            $this->code .= $this->naam[$this->i+2];
            $this->code = strtoupper($this->code);
            return $this->code;
        }
        
        protected function createPloegcodeAlternative($naam){
            $this->naam = $naam;
            $this->i = 0;
            $this->code = $this->naam[$this->i];
            $this->code .= $this->naam[$this->i+2];
            $this->code .= $this->naam[$this->i+3];
            $this->code = strtoupper($this->code);
            return $this->code;

        }

        ////////////////
        //READ METHODS
    
            protected function selectOnePloegcode($ploegcode){
                $opdracht = "SELECT code FROM $this->tablename ploeg WHERE code = ".$ploegcode;

                $this->executeQuery($opdracht);  

               // return $ploegcode;
            }
     
            protected function selectOnePloegnaam($naam){
                $opdracht = "SELECT naam FROM $this->tablename ploeg WHERE naam = ".$naam;

                 $this->executeQuery($opdracht);  
            }
        
        //////////////
        //UPDATE METHODS
     
            protected function convertPloegIdtoNaam ($ploegId){
        
            // zet de id van een ploeg om in de naam

            $opdracht = "SELECT naam FROM $this->tablename Ploeg WHERE id =".$ploegId." ORDER BY naam ASC" ; 
   
            $this->executeQuery($opdracht);   

        }
        

        //////////////
        //DELETE METHODS
        
            protected function deleteOnePloeg ($naam){
                //verwijder 1 ploeg met een gegegeven naam
                
                $opdracht = "DELETE * FROM $this->tablename WHERE naam =".$naam;
                
                $this->executeQuery($opdracht);
            }

//===================================================================================================
//PUBLIC METHODS
//===================================================================================================
     
          
        public function getCode()
	{
		return $this->code;
	}
	public function getNaam()
	{
		return $this->naam;
	}
	public function getLand_id()
	{
		return $this->land_id;
	}
	
        
        public function setCode($code)
	{
		$this->code = $code;
		return $this->code;
	}
	public function setNaam($naam)
	{
		$this->naam = $naam;
		return $this->naam;
	}
	public function setLand_id($land_id)
	{
		$this->land_id = $land_id; 
		return $this->land_id;
	}
	
        public function displayNewPloeg(){
            //nieuwe ploeg aanmaken
            //ploegnaam en land zijn afkomstig uit form
             
             $naam = "De Zijwieltjes";
             $landnaam = "Verweggistan"; 
         
             echo "<h2>Nieuwe ploeg invoeren</h2>";
             echo "<p>U voert in: </p>";
             echo "<p>Team: ".$naam."</p>";
             echo "<p>Land: ".$landnaam."</p>";             
              
             $this->createPloeg($naam, $landnaam);
     }
     
 };
 

