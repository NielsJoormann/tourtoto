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
		$qry = "INSERT INTO ".$this->tablename." (voornaam,achternaam, ploeg_id,land_id,active) VALUES ('".$this->voornaam."', '".$this->achternaam."',
			".$this->ploeg_id.", ".$this->land_id.",".$this->active.")";
		return $this->conn->doInsert($qry);
	}
	protected function _update()
	{
		$qry = "UPDATE ".$this->tablename." SET voornaam='".$this->voornaam."',achternaam='".$this->achternaam."', ploeg_id=".$this->ploeg_id.",
				land_id=".$this->land_id.",active=".$this->active." WHERE id=".$this->id;
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
}
?>