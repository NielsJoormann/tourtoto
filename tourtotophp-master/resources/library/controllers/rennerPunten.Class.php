<?php
require_once('entity.Class.php');
class rennerpunten extends entity
{
	protected $id;
	protected $renner;
	protected $etappe;
	protected $punten;

	public function __construct($id, $conn)
	{
		$this->tablename = "rennerpunten";
		parent::__construct($id, $conn);
	}
	
	protected function _insert()
	{
		$qry = "INSERT INTO ".$this->tablename." (renner_id,etappe_id,punten) VALUES ('".$this->renner."', '".$this->etappe."',
			".$this->punten.")";
		return $this->conn->doInsert($qry);
	}
	protected function _update()
	{
		$qry = "UPDATE ".$this->tablename." SET renner_id='".$this->renner."',etappe_id='".$this->etappe."', punten=".$this->punten." WHERE id=".$this->id;
		return $this->conn->doUpdate($qry);	
	}
	protected function _setProperties($data)
	{
		$this->renner = $data->renner_id;
		$this->etappe = $data->etappe_id;	
		$this->punten = $data->punten;
	}
	protected function _iniProperties()
	{
		$this->renner = "";
		$this->etappe = "";	
		$this->punten = "";
	}
	
	
public function getId()
{
	return $this->id;
}
public function setId($id)
{
	$this->id=$id;
	return $this->id;
}
public function getRenner()
{
	return $this->renner;
}
public function setRenner($renner)
{
	$this->renner = $renner;
	return $this->renner;
}
public function getEtappe()
{
	return $this->etappe;
}
public function setEtappe($etappe)
{
	$this->etappe=$etappe;
	return $this->etappe;
}
public function getPunten()
{
	return $this->punten;
}
public function setPunten($punten)
{
	$this->punten = $punten;
	return $this->punten;
}
}
?>