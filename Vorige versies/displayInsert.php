<?php
//weergeven van resultaten van insert-query's
 
  require_once 'query.php';
  require_once 'display.php';

  require_once 'deleteQuery.php';
  require_once 'insertQuery.php';
  require_once 'selectQuery.php';
  require_once 'updateQuery.php';
  
  class displayInsert extends display {
  public function __construct(){

        $this->deleteQuery = new deleteQuery();
        $this->insertQuery = new insertQuery();
        $this->selectQuery = new selectQuery();
        $this->updateQuery = new updateQuery();
    


        
    }
     
    public function displayNewTotospeler(){
         //Invoeren van nieuwe speler + aanmaken bijbehorende totoploeg
         
         echo "<h2>Invoeren van nieuwe speler + aanmaken bijbehorende totoploeg</h2>";
         
         //$naam = "Speler1"; //deze naam is sowieso al in gebruik en kan gebruikt worden voor controle op duplicaten
         $this->naam = "Speler".rand(5, 10); //deze naam moet gegenereerd worden op basis van de input van een form
         
         echo "<p>De speler die u wilt toevoegen heet ".$this->naam.".  </p>";
         
         $naam = $this->naam;
         $toevoegbaar = $this->insertQuery->createTotospeler($naam);
         
         // print_r($toevoegbaar);
         
         if($toevoegbaar == true){
             
              $this->totoploegId = $this->insertQuery->createTotospelerploeg($naam);
              
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
     
     public function displayNewTotoploegrenner(){
         //invoeren van renner aan bepaalde ploeg
         
         echo "<h2>Toevoegen van renner aan bepaalde ploeg</h2>";
         $this->naam = "Speler".rand(5, 10);
         //$this->naam = "Speler1";
         echo "<p>Uw naam is ".$this->naam."</p>";    //de totospelernaam moet ingevoerd worden op basis van een form
        
         $naam = $this->naam;
         
         $totospeler_id = $this->selectQuery->convertTotospelerNaamtoId($naam);
         echo "<p>Uw id is ".$totospeler_id."</p>";
         $renner_id = rand(1, 427); //dit rugnummer moet ingevoerd worden op basis van een form
         //$renner_id = "91";
         echo "<p>U wilt renner #".$renner_id." toevoegen aan uw ploeg";
         
         
         $result = $this->insertQuery->addTotoploegrenner($renner_id, $totospeler_id);
        
         
     }
     
         public function displayNewTotoploegreserverenner(){
         //invoeren van reserverenner aan bepaalde ploeg
         
         //invoeren van renner aan bepaalde ploeg
         
         echo "<h2>Toevoegen van reserverenner aan bepaalde ploeg</h2>";
         $this->naam = "Speler".rand(1, 5);
         $this->naam = "Speler1";

         echo "<p>Uw naam is ".$this->naam."</p>";    //de totospelernaam moet ingevoerd worden op basis van een form
        
         $naam = $this->naam;
         
         $totospeler_id = $this->selectQuery->convertTotospelerNaamtoId($naam);
         echo "<p>Uw id is ".$totospeler_id."</p>";
         $renner_id = rand(1, 427); //dit rugnummer moet ingevoerd worden op basis van een form
         //$renner_id = "91";
         echo "<p>U wilt renner #".$renner_id." toevoegen aan uw ploeg";
         
         
         $result = $this->insertQuery->addTotoploegreserverenner($renner_id, $totospeler_id);
         
     }
     
     public function displayNewPloeg(){
            //nieuwe ploeg aanmaken
            //ploegnaam en land zijn afkomstig uit form
             
             $ploegnaam = "Team Zijwieltjes";
             $landnaam = "Verweggistan";
 
         
             echo "<h2>Nieuwe ploeg invoeren</h2>";
             echo "<p>U voert in: </p>";
             echo "<p>Team: ".$ploegnaam."</p>";
              echo "<p>Land: ".$landnaam."</p>";             
              
             $this->insertQuery->createPloeg($ploegnaam, $landnaam);
     }
 }