<?php // 
require_once 'databaseConnector.php';
require_once 'query.php';
require_once 'selectQuery.php';
require_once 'deleteQuery.php';
require_once 'updateQuery.php';


require_once 'displayInsert.php';
 


 
 class insertQuery extends query  {
     
     var $connector;
     var $connection;
     var $query;
     var $selectQuery;
     var $deleteQuery;
     var $updateQuery;


     
     
    public function __construct(){
         $this->connector = new databaseConnector();
         $this->connection = $this->connector->__construct();
         
         $this->query = new query;
         $this->selectQuery = new selectQuery;
         $this->deleteQuery = new deleteQuery;
         $this->updateQuery = new updateQuery();


    }

    public function createPloeg($ploegnaam, $landnaam){
        //toevoegen van een nieuwe ploeg
        
        //controle op al bestaande naam en code
        $this->ploegnaam = $ploegnaam;
        
        $this->ploegnaamControle = $this->selectQuery->selectOnePloegnaam($this->ploegnaam);
//        echo "<p>ploegnaam controle: ";
//            var_dump($this->ploegnaamControle);
//        echo "</p>";

        if($this->ploegnaamControle !== null){
            echo "<p>De ploeg".$this->ploegnaam." bestaat al!</p>";
            $validPloegnaam = false;

//            echo "<p>Valide ploegnaam? ";
//                var_dump($validPloegnaam);
//            echo "</p>";
            
         } else {
            echo "<p>De ploeg ".$this->ploegnaam." bestaat nog niet maar wordt nu toegevoegd!</p>";
            
            //controle op al bestaande ploegcode
            $this->i = 0;
            $this->ploegcode = $this->ploegnaam[$this->i];
            $this->ploegcode .= $this->ploegnaam[$this->i+1];
            $this->ploegcode .= $this->ploegnaam[$this->i+2];
            $this->ploegcode = strtoupper($this->ploegcode);

            
            $ploegcodeControle = $this->selectQuery->selectOnePloegcode($this->ploegcode);
            
//            echo "<p>ploegcode controle: ";
//                var_dump($ploegcodeControle);
//            echo "</p>";

            if($ploegcodeControle !== null){
                //echo "<p>Uw ploegcode ".$this->ploegcode." is al in gebruik door een andere ploeg!</p>";
               
                //$validPloegnaam = false;
                

                $this->ploegcode = $this->ploegnaam[$this->i];
                $this->ploegcode .= $this->ploegnaam[$this->i+2];
                $this->ploegcode .= $this->ploegnaam[$this->i+3];

            }    
            echo "<p>Uw ploegcode wordt ".$this->ploegcode." </p>";

            $validPloegnaam = true; 

//            echo "<p>Valide ploegnaam? ";
//                var_dump($validPloegnaam);
//            echo "</p>";

        
            
        };
        
        
        
        
        //controle op al bestaand land en code
        $this->land_id = $this->selectQuery->convertLandNaamtoId($landnaam);
        
        if($this->land_id == null){
            echo "<p>".$landnaam. " staat niet onze database! Het land wordt nu wel toegevoegd.</p>";
            
            //controle op al bestaande code
            $this->i = 0;
            $this->landcode = "(";
            $this->landcode .= $landnaam[$this->i];
            $this->landcode .= $landnaam[$this->i+1];
            $this->landcode .= $landnaam[$this->i+2];
            $this->landcode .= ")";
            $this->landcode = strtoupper($this->landcode);
            
            $landcodeControle = $this->selectQuery->selectOneLandcode($this->landcode);
            
            if($landcodeControle ==  false){
            
                //echo "<p>".$landnaam." land krijgt de code ".$this->landcode."</p>";

                $this->createLand($landnaam, $this->landcode);

                $validLand = true;
            } else {
                $this->landcode = "(";
                $this->landcode .= $landnaam[$this->i];
                $this->landcode .= $landnaam[$this->i+2];
                $this->landcode .= $landnaam[$this->i+3];
                $this->landcode .= ")";
                $this->landcode = strtoupper($this->landcode);
                
                echo "<p>Dit land krijgt de code".$this->landcode."</p>";

                $this->createLand($landnaam, $this->landcode);
                
                $validLand = true;
                
            }
        } else {
           echo "<p>".$landnaam." staat al in onze database. Uw ploeg valt vanaf nu onder dit land. </p>";

           $validLand = true; 
        };
        
        if($validPloegnaam == true && $validLand == true){
            $opdracht = "INSERT INTO ploeg (code, naam, land_id) VALUES ('$this->ploegcode', '$this->ploegnaam', '$this->land_id')";
            
            $connection = $this->connection;
            
            $this->executeQuery($connection, $opdracht);  
            
            echo "<p>Uw ploeg ".$this->ploegnaam." is toegevoegd aan de database met als code ".$this->ploegcode ;
            
         } else {
            echo "<p>Uw ploeg ".$this->ploegnaam."  kon niet worden toegevoegd</p>";
        };
        
    }
    
    public function createLand($landnaam, $landcode){
        //toevoegen van een nieuw land
        
        //echo "<p>Er wordt een nieuw land genaamd ".$landnaam." toegevoegd</p>";
        
        //controle op al bestaand land
        $landControle = $this->selectQuery->selectOneLandnaam($landnaam);
        //var_dump($landControle);
        //print_r($landControle);
        
        
        if($landControle == null){
            $opdracht = "INSERT INTO land (code, naam) VALUES ('$landcode', '$landnaam')";
            $connection = $this->connection;
            $this->executeQuery($connection, $opdracht);
            echo "<p>Het land ".$landnaam." is toegevoegd met als code ".$landcode."</p>";

        } else {
            echo "<p>Het land ".$landnaam."  kon niet worden toegevoegd.</p>";
        };
    }
  
    public function createTotospeler ($naam){
        // maak een nieuwe totospeler aan
              
         
        $duplicaat = $this->selectQuery->selectOneTotospeler($naam); //controle op duplicaat, zoek de ingevoerde naam op in de database

            
        if($duplicaat == false){ //geen duplicaat aangetroffen!

                $toevoegbaar = true; 
                
                echo "<p>".$naam." is toegevoegd aan de database </p>";
            
                $opdracht = "INSERT INTO totospeler VALUES (naam, '$naam')";
                 
                $connection = $this->connection;
                
                $this->executeQuery($connection, $opdracht);


          
        } else { 
            $toevoegbaar = false;    
            echo "<p>Er is al een totospeler actief met de naam [ ".  $naam." ]. Kies alstublieft een andere naam.</p>";
                 
        };
       
        return $toevoegbaar;

        
       

    }
    
    public function createTotospelerploeg ($naam){
    
        // maak een nieuwe totospelersploeg aan
        
       

        //echo "<p>Uw naam: ".$naam."</p>";
   

        
        $totospelerId = $this->selectQuery->convertTotospelerNaamtoId($naam); //zoek de id op van de totospeler
        
        //var_dump($totospelerId);
        //print_r($totospelerId);
        
        //echo "<p>Uw nummer: ".$totospelerId."</p>";
        
        //echo "<p>De id van deze speler is ".$totospelerId."</p>";



        $totoploegId = $this->selectQuery->selectOneTotoploegId($totospelerId);
        //echo "<p>Uw totoploeg heeft als nummer ".$totoploegId;
        
        $opdracht = "INSERT INTO totospelerploeg (totospeler_id) VALUES ('$totospelerId')";
        //print_r($opdracht);
        
        $connection = $this->connection;
        $this->executeQuery($connection, $opdracht);  
        echo "<p>Uw totoploeg  is toegevoegd aan de database";
        
        return $totoploegId;


        
    }
//    
    public function addTotoploegrenner($renner_id, $totospeler_id){
        
        //voeg een renner toe aan een gegeven totoploeg
        
        
        $aantalRenners = $this->selectQuery->selectAllTotoploegrenners($totospeler_id); //tel hoeveel renners er al in deze ploeg zitten
        
        //echo "<p>Aantal renners in deze ploeg: ".$aantalRenners."</p>";
        
        if($aantalRenners < 20){ // als er nog geen twintig renners zijn, mag er nog een aan worden toegevoegd
        
        
                $this->duplicaatRenner = $this->selectQuery->selectOneTotoploegrenner($renner_id, $totospeler_id); //zoek eerst of de opgegeven renner al voorkomt bij deze totospeler
                
//                echo "<p>Duplicaat? ";
//                var_dump($this->duplicaat);
//                print_r($this->duplicaat);
//                echo "</p>";

                if($this->duplicaatRenner === null){ //geen resultaten, dus geen duplicaten. de renner kan dus worden toegevoegd
                    
                    echo "<p>Deze renner komt nog niet voor bij deze ploeg en wordt toegevoegd</p>";
                    
                    $opdracht = "INSERT INTO totospelerploeg (totospeler_id, renner_id, reserve) VALUES ('".$totospeler_id."', '".$renner_id."', '0')";
                    
                    //var_dump($opdracht);
 
                    
                    $result = $this->executeQuery($this->connection, $opdracht); 
                    
                    print_r($result);
                    var_dump($result);

                    if($result !==  false){
                       echo "<p>Renner met rugnummer #".$renner_id." is succesvol toegevoegd aan ploeg #".$totospeler_id;
                    } else {
                        echo "<p>Fout bij het toevoegen van renner #".$renner_id." aan ploeg #".$totospeler_id."</p>";
                    };


                    // nu dat er minimaal één renner in de totoploeg zit, kunnen de lege rijen (die ontstaan bij het aanmaken van de ploeg) verwijderd worden

                    $this->deleteQuery->deleteEmptyTotoploegrenner($totospeler_id);


                    $succes = true;

                    return $succes;


                } else {
                    echo "<p>Deze renner komt al voor in uw ploeg! Kies alstublieft een andere renner.</p>";
                };
        } else { // er zitten al 20 renners in deze ploeg
            echo "<p>Er zitten al ".$aantalRenners." renners in deze ploeg. Er kan geen renner meer worden toegevoegd.</p>";
        }
    }
    
    public function addTotoploegreserverenner($renner_id, $totospeler_id){
        
        //voeg een renner toe aan een gegeven totoploeg en geef hem de status 'reserve'
        
        $aantalReserverenners = $this->selectQuery->selectAllTotoploegreserverenners($totospeler_id); //tel hoeveel renners er al in deze ploeg zitten
        
        //echo "<p>Aantal renners in deze ploeg: ".$aantalReserverenners."</p>";
        
        if($aantalReserverenners < 5){ // als er nog geen twintig renners zijn, mag er nog een aan worden toegevoegd
        
        
                $this->duplicaatReserverenner = $this->selectQuery->selectOneTotoploegrenner($renner_id, $totospeler_id); //zoek eerst of de opgegeven renner al voorkomt bij deze totospeler
                
//                echo "<p>Duplicaat? ";
//                var_dump($this->duplicaat);
//                print_r($this->duplicaat);
//                echo "</p>";

                if($this->duplicaatReserverenner === null){ //geen resultaten, dus geen duplicaten. de renner kan dus worden toegevoegd
                    
                    echo "<p>Deze renner komt nog niet voor bij deze ploeg en wordt toegevoegd</p>";
                    
                    $opdracht = "INSERT INTO totospelerploeg (totospeler_id, renner_id, reserve) VALUES ('".$totospeler_id."', '".$renner_id."', '1')";
                    
                    //var_dump($opdracht);
 
                    
                    $result = $this->executeQuery($this->connection, $opdracht); 
                    
                    print_r($result);
                    var_dump($result);

                    if($result !==  false){
                       echo "<p>Renner met rugnummer #".$renner_id." is succesvol toegevoegd aan ploeg #".$totospeler_id;
                    } else {
                        echo "<p>Fout bij het toevoegen van renner #".$renner_id." aan ploeg #".$totospeler_id."</p>";
                    };


                    // nu dat er minimaal één renner in de totoploeg zit, kunnen de lege rijen (die ontstaan bij het aanmaken van de ploeg) verwijderd worden

                    $this->deleteQuery->deleteEmptyTotoploegrenner($totospeler_id);


                    $succes = true;

                    return $succes;


                } else {
                    echo "<p>Deze renner komt al voor in uw ploeg! Kies alstublieft een andere renner.</p>";
                };
        } else { // er zitten al 5 renners in deze ploeg
            echo "<p>Er zitten al ".$aantalReserverenners." reserverenners in deze ploeg. Er kan geen renner meer worden toegevoegd.</p>";
        }
    }
    
 };