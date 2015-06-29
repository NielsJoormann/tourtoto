<?php
abstract class entity
{
	protected $conn;
	protected $id;
	public $tablename;

//=================================================================================================
//PUBLIC METHOD
//=================================================================================================
	public function __construct($id, $conn)
	{
		$this->conn = $conn;
		$this->id = $id;
		if($id == 0)
		{
			$this->_iniProperties();
		}
		else
		{
			$this->load();
		}
		
	}
        
        
//=================================================================================================	
	public function getId()
	{
		return $this->id;
	}
	final public function load()
	{
		$data = $this->_loadRecord();
		$this->_setProperties($data);
	}
	final public function save()
	{
		if($this->id == 0)
		{
			$this->id = $this->_insert();
		}
		else
		{
			$this->_update();
		}
	}
	final public function selectAll($extraselect)
	{
		$qry = "SELECT * FROM ".$this->tablename;
		if($extraselect) $qry .=" ".$extraselect;
		return $this->conn->getObjects($qry);
	}
//=================================================================================================
//PROTECTED METHOD
//=================================================================================================
	protected function _loadRecord()
	{
		$qry = "SELECT * FROM ".$this->tablename." WHERE id = ".$this->id;
		return $this->conn->getObject($qry);
	}
//=================================================================================================
//ABSTRACT METHOD
//=================================================================================================	
	abstract protected function _iniProperties();
	abstract protected function _insert();
	abstract protected function _update();

	
	
}
?>