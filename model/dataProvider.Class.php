<?php
require_once('renner.Class.php');
require_once('totospelerploeg.Class.php');
require_once('ploeg.Class.php');
require_once('land.Class.php');
require_once('totospeler.Class.php');


require_once('databaseConnection.Class.php');
require_once('config.php');
class Dataprovider
{	
	protected $conn;
        
        public function __construct($conn)
	{
            $this->conn = $conn;
	}
	public function addNewRenner($voornaam,$achternaam,$ploeg_id,$land_id,$active,$pdoconfig)//works
	{
		$renner = new renner(0,$this->conn);
		$renner->setVoornaam($voornaam);
		$renner->setAchternaam($achternaam);
		$renner->setPloeg($ploeg_id);
		$renner->setLand($land_id);
		$renner->setActive($active);
		$renner->save();
	}
	public function updateRenner($id,$voornaam,$achternaam,$ploeg_id,$land_id,$active,$pdoconfig)//works
	{
		$renner = new renner($id,$this->conn);
		$renner->setVoornaam($voornaam);
		$renner->setAchternaam($achternaam);
		$renner->setPloeg($ploeg_id);
		$renner->setLand($land_id);
		$renner->setActive($active);
		$renner->save();
	}
	public function getRennerByLastName($achternaam)//does not work yet
	{
		$renner = new renner("",$this->conn);
		$renner->selectAll('WHERE achternaam = '."'".$achternaam."'");
		echo "<br>";
		print_r($renner);
	}
	public function getRennerById($id)//works
	{
		$renner = new renner($id,$this->conn);
		$renner->load();
		//print_r($renner);
	}
	
        public function addNewTotospelerploeg($totospeler_id){
            $totospelerploeg = new Totospelerploeg;
            
            $totospelerploeg->setTotospeler_id($totospeler_id);
        }
        
        public function addNewTotoploegrenner($renner_id, $totospeler_id) 
        {
            $totospelerploeg = new Totospelerploeg;
            $qry = "SELECT COUNT renner_id FROM totospelerploeg WHERE totospeler_id = '$totospeler_id' AND reserve = '0'";
            $aantalRenners = $this->conn->getObjects($qry);


            if($aantalRenners < 20)
            {
                $totospelerploeg->setTotospeler_id($totospeler_id);
                $totospelerploeg->setRenner($renner_id); 
            } 
            else
            {
                throw new Exception("Er zijn teveel renners in deze ploeg");
            }
        }
        
        public function addNewTotoploegreserve($renner_id, $totospeler_id) 
        {
            $totospelerploeg = new Totospelerploeg;
            $qry = "SELECT COUNT renner_id FROM totospelerploeg WHERE totospeler_id = '$totospeler_id' AND reserve = '1'";
            
            $aantalReserve = $this->conn->getObjects($qry);
            
            if($aantalReserve < 5)
            {
                $totospelerploeg->setTotospeler_id($totospeler_id);
                $totospelerploeg->setReserverenner($renner_id); 
            } 
            else
            {
                throw new Exception("Er zijn teveel reserverenners in deze ploeg");
            }
        }

        
        public function getPloegById($id)
	{
		$ploeg = new ploeg($id,$this->conn);
		$ploeg->load();
		//print_r($ploeg);
	}
        public function getPloegByNaam($naam)
	{
		$ploeg = new ploeg($naam,$this->conn);
		$ploeg->load();
		//print_r($ploeg);
	}
        public function getPloegByCode($code)
	{
		$ploeg = new ploeg(0, $code);
		$ploeg->load();
		//print_r($ploeg);
	}
        
               
        

        public function addNewPloeg($naam, $land_id, $conn)
        {
        
            //toevoegen van een nieuwe ploeg

            //controle op al bestaande naam
            $naamControle = $this->checkPloegnaam($naam, $this->conn);
            if($naamControle == true)
            {
                //controle op al bestaand land en code
                $this->checkLandId($land_id, $this->conn);

                //aanmaken en controleren van de nieuwe ploegcode
                $code = $this->addNewPloegcode($naam, $this->conn);
                if ($code == true)
                {
                    $code = $this->checkPloegcode($code, $this->conn);
                    
                    //aanmaken van de nieuwe ploeg
                    $ploeg = new ploeg;
                    $ploeg->setCode($code);
                    $ploeg->setNaam($naam);
                    $ploeg->setLand_id($land_id);
                }
            
            }

        } 
        
        public function checkPloegnaam($naam)
        {
            $ploeg = new ploeg;
            
            $naamControle = $ploeg->_findBy('naam', $naam);
            
            if($naamControle !== '')
            {
                     
                    throw new Exception("De ploegnaam ".$naam." is al in gebruik");
                    
            } 
            else 
            {
                    return true;
            };
        }
        
        public function checkPloegcode($code, $conn){
             $ploeg = new ploeg;
            
            $codeControle = $ploeg->_findBy('code', $code);

            if($codeControle !== $code){
                $code = $this->addNewPloegcode($naam);
            }
            
            return $code;
        }
       
        

        public function addNewPloegcode($naam, $conn){
            //genereer een code voor een ploeg op basis van de naam
            $ok = false;
            $i = 0;
            $j = i+1;
            $k = i+2;

            while($ok = false){

                $code = "(";
                $code .= $naam[$i];
                $code .= $naam[$j];
                $code .= $naam[$k];
                $code .= ")";
                $code = strtoupper($code);
                $k = $k+1;

                $ploeg = new ploeg;
                $codeControle = $ploeg->_findBy('code', $code);

                if($codeControle == $code){
                       $ok = true;  
                       return $ok;
                } 
            }
        }
        
        public function checkLandId($land_id, $conn){
            $land = new land;
            
            $land_idControle = $land->_findBy('id', $land_id);

            if($land_idControle !== $land_id){ //geen resultaten bij het zoeken naar dit land (bijv. Verweggistan), dus moet het land toegevoegd worden aan database 
                    
                    //aanmaken nieuw land
                    
                    $this->addNewLand($land_id, $this->conn);
            };
        }
        
	
        public function getEtappeById($id,$conn)//works
	{
		$etappe = new etappe($id,$conn);
		$etappe->load();
		//print_r($etappe);
	}
	
        
        public function getLandById($id, $conn){
            $land = new land ($id, $this->conn);
            $land->load();
        }
        
        public function getLandByNaam($naam, $conn){
            $land = new land ($naam, $this->conn);
            $land->load();
        }
        
        public function getLandByCode($code, $conn){
            $land = new land ($code, $this->conn);
            $land->load();
        }
        
        public function addNewLand($naam, $conn){
            //toevoegen van een nieuw land
            
            //controle op al bestaand land
            $land = new Land;
            
            $landControle = $land->_findBy('naam', $naam);
            
            if($landControle == $naam){               
                    $code = $this->addNewLandcode($naam, $this->conn);
                    $land = new Land($code, $naam, $this->conn);
                    $land->setCode($code);
                    $land->setNaam($naam);
                    return $land;

            } else {
                throw new Exception("Het land genaamd ".$naam." bestaat al en kan/hoeft niet worden toegevoegd.");
            };
        }
        
        public function addNewLandcode($naam, $conn){
            //genereer een code voor een ploeg op basis van de naam
            $ok = false;
            $i = 0;
            $j = i+1;
            $k = i+2;

            while($ok = false){

                $code = "(";
                $code .= $naam[$i];
                $code .= $naam[$j];
                $code .= $naam[$k];
                $code .= ")";
                $code = strtoupper($code);
                $k = $k+1;

                $land = new land;
                $codeControle = $land->_findBy('code', $code);

                if($codeControle == $code){
                       $ok = true;  
                       return $ok;
                } 
            }
        }
        
        
	
}
?>