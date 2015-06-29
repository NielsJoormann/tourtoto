<?php
require_once('entity.Class.php');

class land extends entity
{
	protected $naam;
	protected $code;
	
	public function __construct($id,$conn)
	{
		$this->tablename = "land";
		parent::__construct($id,$conn);
	}
	protected function _insert()
	{
		$qry = "INSERT INTO ".$this->tablename." (code,naam) VALUES ('".$this->code."', '".$this->naam."')";
		return $this->conn->doInsert($qry);

	}
	protected function _update()
	{
		$qry = "UPDATE ".$this->tablename." SET naam='".$this->naam."',code='".$this->code."' WHERE id=".$this->id;
		return $this->conn->doUpdate($qry);	
	}

	protected function _setProperties($data)
	{
		$this->naam = $data->naam;
		$this->code = $data->code;	
	}
	protected function _iniProperties()
	{
		$this->code = "";
		$this->naam = "";
	}
	
	public function getCode()
	{
		return $this->code;
	}
	public function getNaam()
	{
		return $this->naam;
	}
	public function setId($id)
	{
		$this->id = $id;
		return $this->id;
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