<?phprequire_once('databaseConnection.Class.php');require_once('renner.Class.php');require_once('rennerpunten.Class.php');require_once('config.php');require_once('totospeler.class.php');class Dataprovider{		protected $conn;//=============================================================================================//PUBLIC METHODS//=============================================================================================	public function __construct($conn)	{			$this->conn = $conn;	}	public function addNewRenner($voornaam,$achternaam,$ploeg_id,$land_id,$active,$pdoconfig)//works	{		$renner = new renner(0,$this->conn);		$renner->setVoornaam($voornaam);		$renner->setAchternaam($achternaam);		$renner->setPloeg($ploeg_id);		$renner->setLand($land_id);		$renner->setActive($active);		$renner->save();	}	public function updateRenner($id,$voornaam,$achternaam,$ploeg_id,$land_id,$active,$pdoconfig)//works	{		$renner = new renner($id,$this->conn);		$renner->setVoornaam($voornaam);		$renner->setAchternaam($achternaam);		$renner->setPloeg($ploeg_id);		$renner->setLand($land_id);		$renner->setActive($active);		$renner->save();	}	public function getRennerById($id)//works	{		return new renner($id,$this->conn);	}	public function getPloegById($id)	{		$ploeg = new ploeg($id,$this->conn);		$ploeg->load();		//print_r($ploeg);	}	public function getEtappeById($id)//works	{		$etappe = new etappe($id,$this->conn);		$etappe->load();		//print_r($etappe);	}	public function addEtappePunten()	{			}	public function addNewTotoPloeg($spelernaam,$renners)	{		$result = $this->saveNewTotoSpeler($spelernaam);		if($result === false)		{			throw new Exception('oeps, naam bestaat al!');		}		$totospelerploeg = new totospelerploeg(0,$this->conn);		$totospelerploeg->setTotospeler($result);		foreach($renners as $rennerid)		{			$totospelerploeg->setRenner($rennerid);			$totospelerploeg->save();			$totospelerploeg->setId(0);		}	}	//=============================================================================================//PROECTED METHODS//=============================================================================================		protected function saveNewTotoSpeler($spelernaam)	{		$totospeler = new totospeler(0,$this->conn);		$totospeler->findByNaam($spelernaam);			if($totospeler->getNaam()==$spelernaam)			{				return false;			}		$totospeler->setNaam($spelernaam);		$totospeler->save();		return $totospeler->getId();	}	}?>