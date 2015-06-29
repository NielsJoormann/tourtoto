<?php
require_once('entity.Class.php');
class renner extends entity
{
	protected $voornaam;
	protected $achternaam;
	protected $ploeg_id;
	protected $land_id;
	protected $active;

//====================================================================================================================
//PUBLIC METHODS
//====================================================================================================================	
	public function __construct($id, $conn)
	{
		$this->tablename = "renner";
		parent::__construct($id, $conn);
	}
//===================================================================================================
//PROTECTED METHODS
//===================================================================================================
	protected function _insert()
	{
		$qry = "INSERT INTO ".$this->tablename." (voornaam,achternaam,ploeg_id,land_id,active) VALUES ('".$this->voornaam."', '".$this->achternaam."',
			".$this->ploeg_id.", ".$this->land_id.",".$this->active.")";
		return $this->conn->doInsert($qry);
	}
	protected function _update()
	{
		$qry = "UPDATE ".$this->tablename." SET (voornaam='".$this->voornaam."',achternaam='".$this->achternaam."', ploeg_id=".$this->ploeg_id.",
				land_id=".$this->land_id.",active=".$this->active.") WHERE id=".$this->id;
		return $this->conn->doUpdate($qry);	
	}
	protected function _setProperties($data)
	{
		$this->voornaam = $data->voornaam;
		$this->achternaam = $data->achternaam;	
		$this->ploeg_id = $data->ploeg_id;
		$this->land_id = $data->land_id;
		$this->active = $data->active;
	}
	protected function _iniProperties()
	{
		$this->voornaam = "";
		$this->achternaam = "";	
		$this->ploeg_id = 1;
		$this->land_id = 1;
		$this->active = 1;
	}
        
        //////////
        //CREATE METHODS
        
        ////////////////
        //READ METHODS
        
        protected function selectOneRenner ($rennerId){
          
            $opdracht = "SELECT * FROM $this->tablename WHERE id = ".$rennerId;

            $renner = $this->executeQuery($this->connection, $opdracht);  

            return $renner;
         
        }
        
        public function selectAllRenners (){

            // selecteer alle renners

           $opdracht = "SELECT * FROM $this->tablename";

           $allerenners = $this->executeQuery($opdracht);   

           return $allerenners;
   
        }
        
        public function selectAllActiveRenners (){
         
            // selecteer alleen nog actieve renners

           $opdracht = "SELECT * FROM $this->tablename WHERE active = '1' ORDER BY achternaam ASC";

           $this->executeQuery($opdracht);   

        }
        
        //////////////
        //UPDATE METHODS
        
        public function convertRennerIdtoNaam ($rennerId){
            
            // zet de id van een renner om in zijn naam

            $opdracht = "SELECT voornaam, achternaam FROM $this->tablename WHERE id =".$rennerId;
            
            $this->executeQuery($opdracht);   
        }
                
        //////////////
        //DELETE METHODS
        
        
       


        
//===================================================================================================
//PUBLIC METHODS
//===================================================================================================
	public function getVoornaam()
	{
		return $this->voornaam;
	}
	public function getAchternaam()
	{
		return $this->achternaam;
	}
	public function getPloeg()
	{
		return $this->ploeg_id;
	}
	public function getLand()
	{
		return $this->land_id;
	}
	public function getActive()
	{
		return $this->active;
	}
	public function setVoornaam($voornaam)
	{
		$this->voornaam = $voornaam;
		return $this->voornaam;
	}
	public function setAchternaam($achternaam)
	{
		$this->achternaam = $achternaam;
		return $this->achternaam;
	}
	public function setPloeg($ploeg_id)
	{
		$this->ploeg_id = $ploeg_id; 
		return $this->ploeg_id;
	}
	public function setLand($land_id)
	{
		$this->land_id = $land_id; 
		return $this->land_id;
	}
	public function setActive($active)
	{
		$this->active = $active;
		return $this->active;
	}
	public function setId($id)
	{
		$this->id=$id;
		return $this->id;
	}
        
        public function displayOneRenner() {
        
                $renner_id = rand(1, 427); //deze id moet ingevoerd kunnen worden middels een form

                echo "<h2>Toon één renner</h2>";

                echo "<p>Rugnummer: ".$renner_id."</p>";

                $renner = $this->selectOneRenner($renner_id);

                echo "<p> Renner #".$renner_id." heet ".$renner["voornaam"]." ".$renner["achternaam"]."</p>";
        }
    
        public function displayAllRenners(){
                echo "<h2>Toon alle renners</h2>";

                $result = $this->selectAllRenners();

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
                            require_once 'land.Class.php';
                            $land = new land();
                            $land->convertLandIdtoNaam($landId);

                            $ploegId = $row["ploeg_id"]; 
                            require_once 'ploeg.Class.php';
                            $ploeg = new ploeg();
                            $ploeg->convertPloegIdtoNaam($ploegId);

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
}
?>