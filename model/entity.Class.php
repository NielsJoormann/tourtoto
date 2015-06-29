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
		$this->_findBy('id',$this->id);
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
		if(isset($extraselect))
		{ 
			$qry .=" ".$extraselect;
			$this->conn->getObjects($qry);
		}
		else
		{
			$this->conn->getObjects($qry);
		}
	}
//=================================================================================================
//PROTECTED METHOD
//=================================================================================================
	protected function _findBy($field,$value)
	{
		$qry = "SELECT * FROM ".$this->tablename." WHERE '".$field."' = '".$value."'";
		$this->_setProperties($this->conn->getObject($qry));
	}
//=================================================================================================
//ABSTRACT METHOD
//=================================================================================================	
	abstract protected function _iniProperties();
	abstract protected function _setProperties($data);
	abstract protected function _insert();
	abstract protected function _update();

	
	
}
?>