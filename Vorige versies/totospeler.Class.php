<?php
 require_once('entity.Class.php');

 
 
 
 class totospeler extends entity {
     
     
      protected $naam; 

//====================================================================================================================
//PUBLIC METHODS
//====================================================================================================================	
	public function __construct($id, $conn)
	{
		$this->tablename = "totospeler";
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
        public function createTotospeler ($naam){
        // maak een nieuwe totospeler aan
              
         
            $duplicaat = $this->selectOneTotospeler($naam); //controle op duplicaat, zoek de ingevoerde naam op in de database


            if($duplicaat == false){ //geen duplicaat aangetroffen!

                    $toevoegbaar = true; 

                    echo "<p>".$naam." is toegevoegd aan de database </p>";

                    $opdracht = "INSERT INTO $this->tablename VALUES (naam, '$naam')";

                    $this->executeQuery($opdracht);

            } else { 
                $toevoegbaar = false;    
                echo "<p>Er is al een totospeler actief met de naam [ ".  $naam." ]. Kies alstublieft een andere naam.</p>";

            };

            return $toevoegbaar;
        }
        
        ////////////////
        //READ METHODS
    
        public function selectOneTotospeler($naam){
         
                    // selecteer 1 totospeler


                   $opdracht = "SELECT * FROM $this->tablename WHERE naam = ".$naam;

                   //print_r($opdracht);

                   $this->result = $this->executeQuery($opdracht); 

                   if ($this->result == null){ // geen resultaat betekent geen duplicaat

                   //    echo "<p>Er is gezocht naar ".$naam.". Deze komt nog niet voor in onze database.</p>";
                       $duplicaat = false;

                   } else { //duplicaat gevonden!
                       echo "<p>De naam ".$naam." is al in gebruik.</p>";
                       $duplicaat = true;

                   };


                   return $duplicaat;
         }

        public function selectOneTotospelerId($naam){

            // selecteer de id van 1 totospeler

           $opdracht = "SELECT id FROM $this->tablename WHERE naam = ".$naam;

           $this->return = $this->result["id"];

           $this->executeQuery($opdracht);   

        }

        
        //////////////
        //UPDATE METHODS
        public function convertTotospelerIdtoNaam ($id){
            
                    // zet de id van een speler om in de naam

                     $opdracht = "SELECT naam FROM $this->tablename WHERE id = ".$id; 

                     $this->executeQuery($opdracht);   
  
            }

        protected function convertPloegIdtoSpelerNaam ($totospeler_id){
            
                    // selecteer de naam van een speler aan wie renners zijn toegewezen in een totoploeg

                    $opdracht = "SELECT naam FROM $this->tablename Totospeler WHERE id = ".$totospeler_id;

                    $this->result = $this->result["id"];

                    $this->executeQuery($opdracht);   

        }
        
        protected function convertTotospelerNaamtoId ($naam){
         
                    //zet de naam van een speler om in zijn id
                    
                    $opdracht = "SELECT id FROM $this->tablename WHERE naam = '".$naam."'";
                           
                    $this->result = $this->executeQuery($opdracht);
                    
                    if($this->result["id"] == null){
                        echo "Geen speler gevonden met deze naam!";
                        
                    } else {
                        //echo "Deze speler heeft als id ".$this->result["id"];
                        $this->id = $this->result["id"];
                    }
                    
                    return $this->id;
        }
        
        ////////////////
        //DELETE METHODS
   
        
//===================================================================================================
//PUBLIC METHODS
//===================================================================================================        
   public function getId(){
       return $this->id;
   }
   
   public function setId(){
       return $this->id;
   }
   
   public function getNaam(){
       return $this->naam;
   }
   
   public function setNaam(){
       return $this->naam;
   }
   
   public function displayNewTotospeler(){
         //Invoeren van nieuwe speler + aanmaken bijbehorende totoploeg
        //deze naam moet gegenereerd worden op basis van de input van een form
         
         echo "<h2>Invoeren van nieuwe speler + aanmaken bijbehorende totoploeg</h2>";
         
         //$naam = "Speler1"; //deze naam is sowieso al in gebruik en kan gebruikt worden voor controle op duplicaten
         
         $this->naam = "Speler".rand(5, 10); 
         
         echo "<p>De speler die u wilt toevoegen heet ".$this->naam.".  </p>";
         
         $naam = $this->naam;
         $toevoegbaar = $this->createTotospeler($naam);
         

         
         if($toevoegbaar == true){
             
              $this->totoploegId = $this->createTotospelerploeg($naam);
              
              if($this->totoploegId !== null){
                    echo "<p>".$naam." is succesvol toegevoegd en speelt mee met ploeg #".$this->totoploegId."</p>";
                } else {
                    echo "<p>Er is iets misgegaan bij het toevoegen: geen totospelersploeg opgegeven</p>";
             };
         } else {
 
             echo "<p>Er is iets misgegaan bij het toevoegen. Gekozen naam is al in gebruik</p>";
         }
         
         return $naam;
     }
     
 }