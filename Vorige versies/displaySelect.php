<?php //  weergeven van resultaten van select-query's


require_once 'query.php';
    require_once 'display.php';
    
  require_once 'deleteQuery.php';
  require_once 'insertQuery.php';
  require_once 'selectQuery.php';
  require_once 'updateQuery.php';
  
  class displaySelect extends display {
  public function __construct(){

        $this->deleteQuery = new deleteQuery();
        $this->insertQuery = new insertQuery();
        $this->selectQuery = new selectQuery();
        $this->updateQuery = new updateQuery();
    


        
    } 
    
    
    

    public function displayOneRenner() {
        
        $renner_id = rand(1, 427); //deze id moet ingevoerd kunnen worden middels een form
        
        
        echo "<h2>Toon één renner</h2>";
        
        echo "<p>Rugnummer: ".$renner_id."</p>";

        $renner = $this->selectQuery->selectOneRenner($renner_id);
        
        //var_dump($renner);
        //print_r($renner);

        echo "<p> Renner #".$renner_id." heet ".$renner["voornaam"]." ".$renner["achternaam"]."</p>";
    }


    public function displayOneTotoploeg() {

        echo "<h2>Toon één totoploeg</h2>";
        
        $totospeler_id = 293; //deze id moet ingevoerd kunnen worden middels een form
        
        echo "<p>U ziet de totoploeg van speler ".$totospeler_id."</p>";
        
        $renners = $this->selectQuery->selectOneTotoploeg($totospeler_id);
        
        print_r($renners);
        var_dump($renners);
        

        foreach($renners as $row){
            echo "<p>".$renners["renner_id"]."</p>";
        }
            
            
        
        
        
        
        
    } 
                
                
        
        
    

    public function displayAllRenners(){
        echo "<h2>Toon alle renners</h2>";

        $result = $this->selectQuery->selectAllRenners();
        
        //echo $allerenners;
               
        echo "<table>"
                 . "    <tr>"
                        . "<th>Rugnummer</th>"
                        . "<th>Naam</th>"
                        . "<th>Ploeg</th>"
                        . "<th>Land</th>"
                        . "<th>Actief</th>"
                    . "</tr>";


                foreach ($result as $row){
       
                    
                    //print_r($row);
                    print_r($result);


                    //var_dump($row);


                    
                    $landId = $row["land_id"]; 
                    $land = $this->selectQuery->convertLandIdtoNaam($landId);
                    
                    $ploegId = $row["ploeg_id"]; 
                    $ploeg = $this->selectQuery->convertPloegIdtoNaam($ploegId);
                    
                    echo "<tr>"
                            . "<td>".$row['id']."</td>"
                            . "<td>".$row["achternaam"].", ".$row["voornaam"]."</td>"
                            . "<td>".$ploeg["naam"]."</td>"

                            . "<td>".$land["naam"]."</td>";


                            if($row["active"] == 0){    
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

        $this->result = $this->selectQuery->selectAllTotoploegen();
        
        echo "<table><tr>"
                        . "<th>Speler</th>"
                        . "<th>Punten</th>"
                    . "</tr>";


        while ($this->result) {
            if($this->result["punten"] !== null){
                
                    $spelerId = $result["totospeler_id"];
                    
                    
                    $speler = $this->selectQuery->convertspelerIdtoNaam ($spelerId);
                
                
                
                     echo "<tr>"
                            . "<td>".$speler["naam"]."</td>"
                            . "<td>".$result["punten"]."</td>"

                         ."</tr>";
            };
        };

        echo "</table>";
        }
        
    }
