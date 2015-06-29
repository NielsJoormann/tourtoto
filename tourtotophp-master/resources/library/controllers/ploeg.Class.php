<?php
require_once('entity.Class.php');
class ploeg extends entity
{
	protected $land;
	protected $code;
	protected $naam;


//====================================================================================================================
//PUBLIC METHODS
//====================================================================================================================	
	public function __construct($id, $conn)
	{
		$this->tablename = "ploeg";
		parent::__construct($id, $conn);
	}
//===================================================================================================
//PROTECTED METHODS
//===================================================================================================
	protected function _insert()
	{
		$qry = "INSERT INTO ".$this->tablename." (land_id,code,naam) VALUES (".$this->land.", '".$this->code."',
			'".$this->naam."')";
		return $this->conn->doInsert($qry);
	}
	protected function _update()
	{
		$qry = "UPDATE ".$this->tablename." SET land_id= ".$this->land.",code='".$this->code."', naam = '".$this->naam."' WHERE id=".$this->id;
		return $this->conn->doUpdate($qry);	
	}
	protected function _setProperties($data)
	{
		$this->land = $data->land_id;
		$this->code = $data->code;	
		$this->naam = $data->naam;
	}
	protected function _iniProperties()
	{
		$this->land = 1;
		$this->code = "";	
		$this->naam = "";

	}
//===================================================================================================
//PUBLIC METHODS
//===================================================================================================
public function getLand()
{
	return $this->land;
}
public function getCode()
{
	return $this->code;
}
public function getNaam()
{
	return $this->naam;
}
public function setLand($land)
{
	$this->land = $land;
	return $this->land;
}
public function setCode($code)
{
	$this->code = $code;
	return $this->code;
}
public function setNaam($naam)
{
	$this->naam = $naam;
	return $this->naam;
}
}
?>