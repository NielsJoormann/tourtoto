<?php
require_once('entity.Class.php');
class Totospelerploeg extends entity
{
	protected $renner;	
	protected $totospeler;
	protected $punten;	
	protected $reserve;
	
public function __construct($id,$conn)
{
	$this->tablename = "totospelerploeg";
	parent::__construct($id,$conn);
}
protected function _insert()
	{
		$qry = "INSERT INTO ".$this->tablename." (renner_id,totospeler_id,punten,reserve) VALUES (".$this->renner.", ".$this->totospeler.",
			".$this->punten.", ".$this->reserve.")";
		return $this->conn->doInsert($qry);
	}
	protected function _update()
	{
		$qry = "UPDATE ".$this->tablename." SET renner_id = ".$this->renner.",totospeler_id = ".$this->totospeler.", punten = ".$this->punten.",
				reserve = ".$this->reserve." WHERE id=".$this->id;
		return $this->conn->doUpdate($qry);	
	}
	protected function _setProperties($data)
	{
		$this->renner = $data->renner_id;
		$this->totospeler = $data->totospeler_id;	
		$this->punten = $data->punten;
		$this->reserve = $data->reserve;
	}
	protected function _iniProperties()
	{
		$this->renner = "";
		$this->totospeler = "";	
		$this->punten = 1;
		$this->reserve = 1;
	}
public function getPunten()
{
	return $this->punten;
}
public function getTotospeler()
{
	return $this->totospeler;
}
public function getRenner()
{
	return $this->renner;
}
public function getReserve()
{
	return $this->reserve;
}
public function setPunten($punten)
{
	$this->punten = $punten;
	return $this->punten;
}
public function setTotospeler($totospeler_id)
{
	$this->totospeler = $totospeler_id;
	return $this->totospeler;
}
public function setRenner($renner_id)
{
	$this->renner = $renner_id;
	return $this->renner;
}
public function setReserve($reserve)
{
	$this->reserve = $reserve;
	return $this->reserve;
}
public function setId($id)
{
	$this->id = $id;
	return $this->id;
}
}
?>