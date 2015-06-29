<?php
require_once('entity.Class.php');
class etappe extends entity
{
	protected $naam;
	protected $afstand;


//====================================================================================================================
//PUBLIC METHODS
//====================================================================================================================	
	public function __construct($id, $conn)
	{
		$this->tablename = "etappe";
		parent::__construct($id, $conn);
	}
//===================================================================================================
//PROTECTED METHODS
//===================================================================================================
	protected function _insert()
	{
		$qry = "INSERT INTO ".$this->tablename." (naam, afstand) VALUES ('".$this->naam."', '".$this->afstand."')";
		return $this->conn->doInsert($qry);
	}
	protected function _update()
	{
		$qry = "UPDATE ".$this->tablename." SET naam='".$this->naam."', afstand = '".$this->afstand."' WHERE id=".$this->id;
		return $this->conn->doUpdate($qry);	
	}
	protected function _setProperties($data)
	{
		$this->naam = $data->naam;
		$this->afstand = $data->afstand;
	}
	protected function _iniProperties()
	{
		$this->naam = "";
		$this->afstand = 0;
	}
//===================================================================================================
//PUBLIC METHODS
//===================================================================================================
	public function getNaam()
	{
		return $this->naam;
	}
	public function getAfstand()
	{
		return $this->afstand;
	}
	public function setNaam($naam)
	{
		$this->naam = $naam;
		return $this->naam;
	}
	public function setAfstand($afstand)
	{
		$this->afstand = $afstand;
		return $this->afstand;
	}
	public function setId($id)
	{
		$this->id=$id;
		return $this->id;
	}
}
?>