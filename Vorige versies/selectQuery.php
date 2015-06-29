<?php
require_once 'databaseConnector.php';
require_once 'query.php';
require_once 'displayInsert.php';
 


 
 class selectQuery extends query  {
     
     var $connector;
     var $connection;
     var $query;
     var $selectQuery;
     
     
     public function __construct(){
         $this->connector = new databaseConnector();
         $this->connection = $this->connector->__construct();
         
         $this->query = new query;
 
    }





    
     
     public function selectOnePloegcode($ploegcode){
        $opdracht = "SELECT code FROM ploeg WHERE code = ".$ploegcode;
         
        $connection = $this->connection;
        
        $this->executeQuery($connection, $opdracht);  
        
       // return $ploegcode;
     }
     
     public function selectOnePloegnaam($ploegnaam){
       $opdracht = "SELECT naam FROM ploeg WHERE naam = ".$ploegnaam;
         
        $connection = $this->connection;
        
        $this->executeQuery($connection, $opdracht);  
     }

     public function selectOneLand($land_id){
       $opdracht = "SELECT id FROM land WHERE id = ".$land_id;
         
        $connection = $this->connection;
        
        $this->executeQuery($connection, $opdracht);  
     }
     
    public function selectOneLandnaam($landnaam){
       $opdracht = "SELECT naam FROM land WHERE land = ".$landnaam;
         
        $connection = $this->connection;
        
        $this->result = $this->executeQuery($connection, $opdracht);  
            if($this->result == null){
                //echo "<p>Er bestaat (nog) geen land met de naam ".$landnaam."</p>";
                
            } else {
                $this->landnaam =  $this->result['naam'];
                return $this->landnaam;
            }
     }
//     
     public function selectOneLandcode($landcode){
        $opdracht = "SELECT code FROM land WHERE code = ".$landcode;
         
        $connection = $this->connection;
        
        $this->result = $this->executeQuery($connection, $opdracht);  
        
        if($this->result == null){
            //echo "<p>Landcode ".$landcode." is nog niet aanwezig in de database</p>";
        } else {
           $landcode = $this->result["code"];
           echo $landcode;
           return $landcode;
         }
     }
     
     
     
      public function selectOneRenner ($renner_id){
         

          
         $opdracht = "SELECT * FROM renner WHERE id = ".$renner_id;
         
         $renner = $this->executeQuery($this->connection, $opdracht);  
         
         return $renner;
         
     }
     
     
     public function selectOneTotospeler($naam){
         
         // selecteer 1 totospeler
        echo "<p>Er wordt gezocht naar ".$naam."</p>";
         
        $opdracht = "SELECT * FROM totospeler WHERE naam = '".$naam."'" ;
        
        print_r($opdracht);
        
        $this->result = $this->executeQuery($this->connection, $opdracht); 
        
//        echo "<p>Resultaat:";
//        print_r($this->result);
//        echo "</p>";

        if ($this->result == null){ // geen resultaat betekent geen duplicaat
           
            echo "<p>Er is gezocht naar ".$naam.". Deze komt nog niet voor in onze database.</p>";
            $duplicaat = false;
 
            
        } else { //duplicaat gevonden!
            echo "<p>De naam ".$naam." is al in gebruik.</p>";
            $duplicaat = true;
 
        };
        
    
        return $duplicaat;


        
  

     }
     
     public function selectAllTotoploegrenners($totospeler_id){
        
        // selecteer alle renners die bij een bepaalde totospeler horen zonder de status reserve
        
        $opdracht = "SELECT * FROM totospelerploeg WHERE totospeler_id =  '".$totospeler_id."' AND reserve = '0' ";
        
        $connection = $this->connection;         
        
        $resultaat = $this->executeQuery($connection, $opdracht);
    
        $aantalRenners = mysqli_num_rows($this->query);
        echo "<p>Aantal renners in deze ploeg: ".$aantalRenners."</p>";
        return $aantalRenners;
          
     }
     
    public function selectAllTotoploegreserverenners($totospeler_id){
//        
         // selecteer alle renners die bij een bepaalde totospeler horen met de status reserve
//        
        $opdracht = "SELECT * FROM totospelerploeg WHERE totospeler_id =  '".$totospeler_id."' AND reserve = '1' ";
        $connection = $this->connection;         

        $this->executeQuery($connection, $opdracht); 

        $resultaat = $this->executeQuery($connection, $opdracht);
    
        $aantalReserverenners = mysqli_num_rows($this->query);
        echo "<p>Aantal reserverenners in deze ploeg: ".$aantalReserverenners."</p>";
        return $aantalReserverenners;
        }
     
     
     public function selectOneTotoploeg($totospeler_id){
        
        //  selecteer 1 totoploeg, d.w.z. alle renners die bij een bepaalde totospeler horen
        
        $opdracht = "SELECT * FROM totospelerploeg WHERE totospeler_id = ".$totospeler_id;
        $connection = $this->connection;         

        $renners = $this->executeQuery($connection, $opdracht); 
        
        return $renners;
         
     }
     
    public function selectOneTotoploegId($totospeler_id){
        
         // selecteer de id van 1 totoploeg, d.w.z. alle renners die bij een bepaalde totospeler horen
        
        $opdracht = "SELECT id FROM totospelerploeg WHERE totospeler_id = '".$totospeler_id."'";
        $connection = $this->connection;         

         $this->result = $this->executeQuery($connection, $opdracht); 
         
//         echo "<p>Resultaat: ";
//         \print_r($this->result );
//         echo "</p>";
//         
//        echo "<p>Resultaat: ";
//         \print_r($this->result["id"] );
//         echo "</p>";
         
         if($this->result["id"] !== null){
           
            //echo "Deze ploeg heeft als id ".$this->result["id"];
            $this->id = $this->result["id"];
         } else {
             //echo "<p>Foutmelding: nog geen ploeg gevonden met dit nummer</p>";
         };
                    
        return $this->id;
         
         
     }
     
    public function selectOneTotoploegrenner($renner_id, $totospeler_id){
        
         // selecteer 1 totoploegrenner, één renner uit een bepaalde totoploeg
        
        $opdracht = "SELECT renner_id FROM totospelerploeg WHERE totospeler_id =  '".$totospeler_id."' AND renner_id  = '".$renner_id."'";

        
        $this->duplicaat = $this->executeQuery($this->connection, $opdracht);  

        return $this->duplicaat;
         
     }
     
     
     
     public function selectOneTotospelerId($naam){
         
         // selecteer de id van 1 totospeler
        
        $opdracht = "SELECT id FROM totospeler WHERE naam = '".$naam."'";

        $this->return = $this->result["id"];
        $connection = $this->connection;         

         $this->executeQuery($connection, $opdracht);   
        
     }


     public function selectAllRenners (){
         
         // selecteer alle renners
       
        $opdracht = "SELECT * FROM Renner";

        
        $result = $this->executeQuery($this->connection, $opdracht);   
        
        return $result;
   

     }
     
     
     public function selectAllActiveRenners (){
         
         // selecteer alleen nog actieve renners
       
        $opdracht = "SELECT * FROM Renner WHERE active = '1' ORDER BY achternaam ASC";
        $connection = $this->connection;         

         $this->executeQuery($connection, $opdracht);   
   

     }
     
     public function selectAllTotoploegen (){
         
         // selecteer de verschillende totoploegen
         
        $opdracht = "SELECT DISTINCT totospeler_id, punten FROM Totospelerploeg ORDER BY punten DESC";
         $connection = $this->connection;         

         $this->executeQuery($connection, $opdracht);   
   
     }
     
     public function convertLandIdtoNaam ($landId){
             
             // zet de id van een land om in de naam

        $opdracht = "SELECT naam FROM Land WHERE id =".$landId; 
       
        $connection = $this->connection;         

        $landNaam = $this->executeQuery($connection, $opdracht);  
        
        return $landNaam;
     }
     
     public function convertLandNaamtoId ($landnaam){
             
             // zet de naam van een land om in de id

        $opdracht = "SELECT id FROM Land WHERE naam =".$landnaam; 
       
        $connection = $this->connection;         

        $this->result = $this->executeQuery($connection, $opdracht);  
        
        if($this->result == null){
            //echo "<p>Geen land gevonden met als naam ".$landnaam."</p>";
        } else {
            $this->landid = $this->result["id"];
            echo $this->landid;
            return $this->landid;

        }
        
     }
//     
     
    public function convertPloegIdtoNaam ($ploegId){
        
            // zet de id van een ploeg om in de naam

            $opdracht = "SELECT naam FROM Ploeg WHERE id =".$ploegId." ORDER BY naam ASC" ; 
          $connection = $this->connection;         
  
         $this->executeQuery($connection, $opdracht);   


    }
    
    public function convertTotospelerIdtoNaam ($id){
            
           // zet de id van een speler om in de naam

            $opdracht = "SELECT naam FROM Totospeler WHERE id = ".$id; 
            
            $connection = $this->connection;         
   
            $this->executeQuery($connection, $opdracht);   
  
    }
    
    public function convertPloegIdtoSpelerNaam ($totospeler_id){
            
            // selecteer de naam van een speler aan wie renners zijn toegewezen in een totoploeg
            
            $opdracht = "SELECT naam FROM Totospeler WHERE id = ".$totospeler_id;
            
            $this->result = $this->result["id"];
            $connection = $this->connection;         
            $this->executeQuery($connection, $opdracht);   

    }

    
     public function convertTotospelerNaamtoId ($naam){
         
         //zet de naam van een speler om in zijn id
                    
                    $opdracht = "SELECT id FROM Totospeler WHERE naam = '".$naam."'";
                    //print_r($opdracht);
                    $connection = $this->connection;         
                    $this->result = $this->executeQuery($connection, $opdracht);
                    
                    //print_r($this->result);
                    //print_r($this->result["id"]);

         
                    if($this->result["id"] == null){
                        echo "Geen speler gevonden met deze naam!";
                        
                    } else {
                        //echo "Deze speler heeft als id ".$this->result["id"];
                        $this->id = $this->result["id"];
                    }
                    
                    return $this->id;
                    
    }
    
    
     
    
        public function convertRennerIdtoNaam ($rennerId){
                    // zet de id van een renner om in zijn naam

            $opdracht = "SELECT voornaam, achternaam FROM Renner WHERE id =".$rennerId;
            
            $connection = $this->connection;         

            $this->executeQuery($connection, $opdracht);   
    }
    
 }