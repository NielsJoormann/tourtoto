<?php
require_once('entity.Class.php');


 
 class totospelerploeg extends entity {
     
     protected $punten; 
     protected $totospeler_id; 
     protected $renner_id; 
     protected $reserve;
//====================================================================================================================
//PUBLIC METHODS
//====================================================================================================================	
	public function __construct($id, $conn)
	{
		$this->tablename = "totospelerploeg";
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
        
        protected function createTotospelerploeg ($naam){
    
                // maak een nieuwe totospelersploeg aan

                //echo "<p>Uw naam: ".$naam."</p>";

                $totospelerId = $this->convertTotospelerNaamtoId($naam); //zoek de id op van de totospeler

                //var_dump($totospelerId);
                //print_r($totospelerId);

                //echo "<p>Uw nummer: ".$totospelerId."</p>";

                $totoploegId = $this->selectOneTotoploegId($totospelerId);
                //echo "<p>Uw totoploeg heeft als nummer ".$totoploegId;

                $opdracht = "INSERT INTO $this->tablename (totospeler_id) VALUES ('$totospelerId')";
                //print_r($opdracht);

                $this->executeQuery($opdracht);  

                echo "<p>Uw totoploeg is toegevoegd aan de database";

                return $totoploegId;

        }
    
        protected function addTotoploegrenner($renner_id, $totospeler_id){
        
                    //voeg een renner toe aan een gegeven totoploeg

                    $aantalRenners = $this->selectAllTotoploegrenners($totospeler_id); //tel hoeveel renners er al in deze ploeg zitten

                    echo "<p>Aantal renners in deze ploeg: ".$aantalRenners."</p>";
                    $resterendaantalRenners = 20 - $aantalRenners;
                    echo "<p>U kunt nog ".$resterendaantalRenners." renners toevoegen.</p>";

                    if($aantalRenners < 20){ // als er nog geen twintig renners zijn, mag er nog een aan worden toegevoegd

                            $this->duplicaatRenner = $this->selectOneTotoploegrenner($renner_id, $totospeler_id); //zoek eerst of de opgegeven renner al voorkomt bij deze totospeler

                            if($this->duplicaatRenner == null){ //geen resultaten, dus geen duplicaten. de renner kan dus worden toegevoegd

                                echo "<p>Deze renner komt nog niet voor bij deze ploeg en wordt toegevoegd</p>";

                                $opdracht = "INSERT INTO $this->tablename (totospeler_id, renner_id, reserve) VALUES ('$totospeler_id', '$renner_id', '0')";

                                $result = $this->executeQuery($opdracht); 

                                if($result !==  false){
                                   echo "<p>Renner met rugnummer #".$renner_id." is succesvol toegevoegd aan ploeg #".$totospeler_id;
                                } else {
                                    echo "<p>Fout bij het toevoegen van renner #".$renner_id." aan ploeg #".$totospeler_id."</p>";
                                };

                                // nu dat er minimaal één renner in de totoploeg zit, kunnen de lege rijen (die ontstaan bij het aanmaken van een totoploeg) verwijderd worden

                                $this->deleteEmptyTotoploegrenner($totospeler_id);

                                $succes = true;

                                return $succes;

                            } else { // er is een duplicaat aangetroffen
                                echo "<p>Deze renner komt al voor in uw ploeg! Kies alstublieft een andere renner.</p>";
                            };
                    } else { // er zitten al 20 renners in deze ploeg
                        echo "<p>Er zitten al ".$aantalRenners." renners in deze ploeg. Er kan geen renner meer worden toegevoegd.</p>";
                    }
        }
    
        protected function addTotoploegreserverenner($renner_id, $totospeler_id){
        
                    //voeg een renner toe aan een gegeven totoploeg en geef hem de status 'reserve'

                    $aantalReserverenners = $this->selectAllTotoploegreserverenners($totospeler_id); //tel hoeveel renners er al in deze ploeg zitten

                   echo "<p>Aantal renners in deze ploeg: ".$aantalReserverenners."</p>";
                    $resterendaantalReserverenners = 5 - $aantalReserverenners;
                    echo "<p>U kunt nog ".$resterendaantalReserverenners." reserverenners toevoegen.</p>";

                    if($aantalReserverenners < 5){ // als er nog geen twintig renners zijn, mag er nog een aan worden toegevoegd


                            $this->duplicaatReserverenner = $this->selectOneTotoploegrenner($renner_id, $totospeler_id); //zoek eerst of de opgegeven renner al voorkomt bij deze totospeler

                            if($this->duplicaatReserverenner == null){ //geen resultaten, dus geen duplicaten. de renner kan dus worden toegevoegd

                                echo "<p>Deze renner komt nog niet voor bij deze ploeg en wordt toegevoegd</p>";

                                $opdracht = "INSERT INTO $this->tablename (totospeler_id, renner_id, reserve) VALUES ('$totospeler_id', '$renner_id', '1')";

                                $result = $this->executeQuery($opdracht); 

                                if($result !==  false){
                                   echo "<p>Renner met rugnummer #".$renner_id." is succesvol toegevoegd aan ploeg #".$totospeler_id;
                                } else {
                                    echo "<p>Fout bij het toevoegen van renner #".$renner_id." aan ploeg #".$totospeler_id."</p>";
                                };


                                // nu dat er minimaal één renner in de totoploeg zit, kunnen de lege rijen (die ontstaan bij het aanmaken van de totoploeg) verwijderd worden

                                $this->deleteEmptyTotoploegrenner($totospeler_id);

                                $succes = true;

                                return $succes;

                            } else { //duplicaat aangetroffen
                                echo "<p>Deze renner komt al voor in uw ploeg! Kies alstublieft een andere renner.</p>";
                            };
                    } else { // er zitten al 5 reserverenners in deze ploeg
                        echo "<p>Er zitten al ".$aantalReserverenners." reserverenners in deze ploeg. Er kan geen renner meer worden toegevoegd.</p>";
                    }
        }
       
        //////////////
        //READ METHODS
        protected function selectAllTotoploegrenners($totospeler_id){
        
               // selecteer alle renners die bij een bepaalde totospeler horen zonder de status reserve

               $opdracht = "SELECT * FROM $this->tablename WHERE totospeler_id =  '$totospeler_id' AND reserve = '0' ";

               $resultaat = $this->executeQuery($opdracht);

               $aantalRenners = mysqli_num_rows($this->query);
               echo "<p>Aantal renners in deze ploeg: ".$aantalRenners."</p>";
               return $aantalRenners;
          
        }

        protected function selectAllTotoploegreserverenners($totospeler_id){
        
                // selecteer alle renners die bij een bepaalde totospeler horen met de status reserve

               $opdracht = "SELECT * FROM $this->tablename WHERE totospeler_id =  '$totospeler_id' AND reserve = '1' ";

               $resultaat = $this->executeQuery($opdracht);

               $aantalReserverenners = mysqli_num_rows($this->query);
               echo "<p>Aantal reserverenners in deze ploeg: ".$aantalReserverenners."</p>";
               return $aantalReserverenners;
         
        }
    
        protected function selectAllTotoploegen (){
         
               // selecteer de verschillende totoploegen

               $opdracht = "SELECT DISTINCT totospeler_id, punten FROM $this->tablename ORDER BY punten DESC";

               $this->executeQuery($opdracht);   
   
        }

        protected function selectOneTotoploegrenner($renner_id, $totospeler_id){
        
                // selecteer 1 totoploegrenner, één renner uit een bepaalde totoploeg

                $opdracht = "SELECT renner_id FROM $this->tablename WHERE totospeler_id =  '$totospeler_id' AND renner_id  = '$renner_id'";

                $this->totoploegrenner = $this->executeQuery($opdracht);  

                return $this->totoploegrenner;
         
        }
        
        protected function selectOneTotoploeg($totospeler_id){
        
           // selecteer 1 totoploeg, d.w.z. alle renners die bij een bepaalde totospeler horen

           $opdracht = "SELECT * FROM $this->tablename WHERE totospeler_id = ".$totospeler_id;

           $renners = $this->executeQuery($opdracht); 

           return $renners;
         
        }

        protected function selectOneTotoploegId($totospeler_id){
        
                // selecteer de id van 1 totoploeg, d.w.z. alle renners die bij een bepaalde totospeler horen

                   $opdracht = "SELECT id FROM $this->tablename WHERE totospeler_id = '$totospeler_id'";

                   $this->result = $this->executeQuery($opdracht); 

                   if($this->result["id"] !== null){

                      //echo "Deze ploeg heeft als id ".$this->result["id"];
                      $this->id = $this->result["id"];
                   } else {
                      echo "<p>Foutmelding: nog geen ploeg gevonden met dit nummer</p>";
                   };

                  return $this->id;
         
        }
    

        ////////////
        //UPDATE METHODS
        protected function updateTotoploegrenner($renner_id_oud, $renner_id_nieuw, $totospeler_id){
            // vervang een van de renenrs van een totoploeg van een gegeven totospeler
            
            $controle = $this->selectOneTotoploegrenner($renner_id_nieuw, $totospeler_id); //check of de nieuw toe te voegen renner niet al voorkomt in deze ploeg
            
            if($controle == null) {
                 $opdracht = "UPDATE $this->tablename SET renner_id = '$renner_id_nieuw' WHERE renner_id = '$renner_id_oud' AND totospeler_id = ".$totospeler_id;

                $this->executeQuery($opdracht);  
            } else {
              echo "<p>U kunt  renner #".$renner_id_oud." niet vervangen door renner #".$renner_id_nieuw.". ".$renner_id_nieuw." komt al voor in uw ploeg. Kies een andere renner om renner #".$renner_id_oud." te vervangen.</p>";  
            }

         }
        
        protected function setReserveTotoploegrenner($renner_id, $totospeler_id){
            // verander de status van een totoploegrenner in reserve.
            $opdracht = "UPDATE $this->tablename SET reserve = '1' WHERE renner_id = '$renner_id' AND totospeler_id = '$totospeler_id'";

            $this->executeQuery($opdracht);  

         }
     
        protected function unsetReserveTotoploegrenner($renner_id, $totospeler_id){
             // verander de status van een totoploegrenner in actief.
             $opdracht = "UPDATE $this->tablename SET reserve = '0' WHERE renner_id = '$renner_id' AND totospeler_id = '$totospeler_id'";
             
            $this->executeQuery($opdracht);  
             
        }
        
        ////////////
        //DELETE METHODS
        public function deleteEmptyTotoploegrenner($totospeler_id){
            
            //verwijder een lege rij uit een totoploeg
            
            $opdracht = "DELETE FROM $this->tablename WHERE totospeler_id = '$totospeler_id' AND renner_id = 'NULL'";

            $this->executeQuery($opdracht);  
        }
    
        public function deleteOneTotoploegrenner($totospeler_id, $renner_id){
            //verwijder een renner uit een bepaalde totoploeg
        
            $opdracht = "DELETE FROM $this->tablename WHERE totospeler_id = '$totospeler_id' AND renner_id = '$renner_id'";

            $this->executeQuery($opdracht);  
        }
        
        public function deleteOneTotoploeg($totospeler_id){
            // verwijder de totoploeg van een gegeven speler
        
            $opdracht = "DELETE * FROM $this->tablename WHERE totospeler_id = ".$totospeler_id;

            $this->executeQuery($opdracht);  
        }
        

//===================================================================================================
//PUBLIC METHODS
//===================================================================================================
        public function getPunten()
	{
		return $this->punten;
	}
	public function getTotospeler_id()
	{
		return $this->totospeler_id;
	}
	public function getRenner_id()
	{
		return $this->renner_id;
	}
	public function getReserve()
	{
		return $this->reserve;
	}
        
        public function setPunten($punten)
	{
		$this->punten = $punten;
		return $this->punten;
	}
	public function setTotospeler_id($totospeler_id)
	{
		$this->totospeler_id = $totospeler_id;
		return $this->totospeler_id;
	}
	public function setRenner_id($renner_id)
	{
		$this->renner_id = $renner_id; 
		return $this->renner_id;
	}
	public function setReserve($reserve)
	{
		$this->reserve = $reserve; 
		return $this->reserve;
	}
	
        public function displayNewTotoploegrenner(){
            //invoeren van renner aan bepaalde ploeg
            //de totospelernaam moet ingevoerd worden op basis van een form

            echo "<h2>Toevoegen van renner aan bepaalde ploeg</h2>";
            
            $this->naam = "Speler".rand(1, 10);
            
            echo "<p>Uw naam is ".$this->naam."</p>";   
            
            require_once 'totospeler.Class.php';
            
            $totospeler = new totospeler;
           
            $totospeler_id = $totospeler->convertTotospelerNaamtoId($this->naam);
            
            echo "<p>Uw id is ".$totospeler_id."</p>";
            $renner_id = rand(1, 427); //dit rugnummer moet ingevoerd worden op basis van een form
            //$renner_id = "91";
            echo "<p>U wilt renner #".$renner_id." toevoegen aan uw ploeg";


            $result = $this->addTotoploegrenner($renner_id, $totospeler_id);

        }
        
    public function displayNewTotoploegreserverenner(){
            //invoeren van renner aan bepaalde ploeg
            //de totospelernaam moet ingevoerd worden op basis van een form
            //het rugnummer van de renner moet ingevoerd worden op basis van een form
            echo "<h2>Toevoegen van renner aan bepaalde ploeg</h2>";
            
            $this->naam = "Speler".rand(1, 10);
            
            echo "<p>Uw naam is ".$this->naam."</p>";   
            
            require_once 'totospeler.Class.php';
            
            $totospeler = new totospeler;
           
            $totospeler_id = $totospeler->convertTotospelerNaamtoId($this->naam);
            
            echo "<p>Uw id is ".$totospeler_id."</p>";
            
            $renner_id = rand(1, 427); 

            echo "<p>U wilt renner #".$renner_id." toevoegen aan uw ploeg";

            $result = $this->addTotoploegreserverenner($renner_id, $totospeler_id);
         
        }
     
     public function displayOneTotoploeg($totospeler_id) {

        echo "<h2>Toon één totoploeg</h2>";
        
        $totospeler_id = 293; //deze id moet ingevoerd kunnen worden middels een form
        
        echo "<p>U ziet de totoploeg van speler ".$totospeler_id."</p>";
        
        $renners = $this->selectOneTotoploeg($totospeler_id);
        
        echo "<table>"
               . "<tr>"
               . "<th>Rugnummer</th>"
               . "<th>Naam</th>"
               . "<th>Punten</th>"
               . "<th>Reserve</th>"
               . "</tr>";


        foreach ($renners as $row){

            $renner_id = $row["renner_id"]; 
            require_once 'renner.Class.php';
            $renner = new renner();
            $naam = $renner->convertRennerIdtoNaam($renner_id);

            echo "<tr>"
                    . "<td>".$row['renner_id']."</td>"
                    . "<td>".$naam."</td>"
                    . "<td>".$row["punten"]."</td>";

                    if($row["reserve"] == 0){    
                        echo "<td>Nee</td>";
                    } else {
                        echo "<td>Ja</td>";
                    };

            echo "</tr>";

        };

        echo "</table>";
     }
    
    public function displayAllTotoploegen(){
        echo "<h2>Toon alle totoploegen en hun score</h2>";

        $this->result = $this->selectAllTotoploegen();
        
        echo "<table><tr>"
                        . "<th>Speler</th>"
                        . "<th>Punten</th>"
                    . "</tr>";


        while ($this->result) {
            if($this->result["punten"] !== null){
                
                    $spelerId = $result["totospeler_id"];
                    
                    require_once 'totospeler.Class.php';
            
                    $totospeler = new totospeler;
                    
                    $speler = $totospeler->convertTotospelerIdtoNaam ($spelerId);
                                
                     echo "<tr>"
                            . "<td>".$speler["naam"]."</td>"
                            . "<td>".$result["punten"]."</td>"

                         ."</tr>";
            };
        };

        echo "</table>";
        }
        
};
   
   
 