<?php
require_once('entity.Class.php');
class etapperegel extends entity
{
	protected $renner_id;	
	protected $etappe_id;
	protected $positie;
	protected $tijd;

//====================================================================================================================
//PUBLIC METHODS
//====================================================================================================================	
	public function __construct($id, $conn)
	{
		$this->tablename = "etapperegel";
		parent::__construct($id, $conn);
	}
//===================================================================================================
//PROTECTED METHODS
//===================================================================================================
	protected function _insert()
	{
		$qry = "INSERT INTO ".$this->tablename." (renner_id,etappe_id,positie,tijd) VALUES ('".$this->renner_id."', '".$this->etappe_id."',
			".$this->positie.", ".$this->tijd.")";
		return $this->conn->doInsert($qry);
	}
	protected function _update()
	{
		$qry = "UPDATE ".$this->tablename." SET renner_id='".$this->renner_id."',etappe_id='".$this->etappe_id."',positie=".$this->positie.",
				tijd=".$this->tijd." WHERE id=".$this->id;
		return $this->conn->doUpdate($qry);	
	}
	protected function _setProperties($data)
	{
		$this->renner = $data->renner_id;
		$this->etappe = $data->etappe_id;
		$this->positie = $data->positie;	
		$this->tijd = $data->tijd;
	}
	protected function _iniProperties()
	{
		$this->renner_id = "";
		$this->etappe_id = "";
		$this->positie = "";	
		$this->tijd = '';
	}
//===================================================================================================
//PUBLIC METHODS
//===================================================================================================
	public function getEtappe()
	{
		return $this->etappe_id;
	}
	public function getPositie()
	{
		return $this->positie;
	}
	public function getTijd()
	{
		return $this->tijd;
	}
	public function getRenner()
	{
		return $this->renner_id;
	}
	public function setEtappe($etappe_id)
	{
		$this->etappe_id = $etappe_id;
		return $this->etappe_id;
	}
	public function setPositie($positie)
	{
		$this->positie = $positie;
		return $this->positie;
	}
	public function setTijd($tijd)
	{
		$this->tijd = $tijd; 
		return $this->tijd;
	}
	public function setRenner($renner_id)
	{
		$this->renner_id = $renner_id; 
		return $this->renner_id;
	}
	public function setId($id)
	{
		$this->id=$id;
		return $this->id;
	}
}
?>