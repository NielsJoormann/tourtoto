<?php
require_once('entity.Class.php');
class totospeler extends entity
{
	protected $naam;


//====================================================================================================================
//PUBLIC METHODS
//====================================================================================================================	
	public function __construct($id, $conn)
	{
		$this->tablename = "totospeler";
		parent::__construct($id, $conn);
	}
//===================================================================================================
//PROTECTED METHODS
//===================================================================================================
	protected function _insert()
	{
		$qry = "INSERT INTO ".$this->tablename." (naam) VALUES ('".$this->naam."')";
		return $this->conn->doInsert($qry);
	}
	protected function _update()
	{
		$qry = "UPDATE ".$this->tablename." SET naam='".$this->naam."' WHERE id=".$this->id;
		return $this->conn->doUpdate($qry);	
	}
	protected function _setProperties($data)
	{
		$this->naam = $data['naam'];
	}
	protected function _iniProperties()
	{
		$this->naam = "";
	}
//===================================================================================================
//PUBLIC METHODS
//===================================================================================================
	public function getNaam()
	{
		return $this->naam;
	}
	public function setNaam($naam)
	{
		$this->naam = $naam;
		return $this->naam;
	}
	public function setId($id)
	{
		$this->id=$id;
		return $this->id;
	}
	public function findByNaam($spelernaam)
	{
		$this->_findBy('naam',$spelernaam);
	}
}
?>