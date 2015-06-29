<?php
require_once('C:\xampp\htdocs\Tourtoto\model\customException.Class.php');

class DBconnection
{
	
public $qry="";
protected $conn;
protected $m_db;

	function __construct($pdoconfig)
	{
	try
	{
		$this->conn=new PDO($pdoconfig["driver"].":host=".$pdoconfig["host"].";dbname=".$pdoconfig["database"],$pdoconfig["user"],$pdoconfig["pass"]);
		$this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$this->m_conn=$pdoconfig["database"];
	}
	catch(PDOException $e)
	{
			//echo $e->getCode(); //testing purposes
		$except=new customException($e,$pdoconfig);
		$except->showException($e,$pdoconfig);
		$except=null;
	}
	}
	
	public function __destruct()
	{
		if(isset($this->conn))
		{
			$this->conn = null;
		}
	}
	
	public function getObjects($qry)
	{
		$stmt = $this->conn->prepare($qry);
		$stmt->execute();
		$selection = $stmt->fetchAll(PDO::FETCH_OBJ);
		return $selection;
		print_r($selection);
	}
	public function getObject($qry)
	{
		$stmt = $this->conn->prepare($qry);
		$stmt->execute();
		$selection = $stmt->fetch(PDO::FETCH_OBJ);
		return $selection;
	}
	public function doInsert($qry)
	{
		$stmt = $this->conn->prepare($qry);
		$stmt->execute();
		return $this->conn->lastInsertId();
	}
	public function doUpdate($qry)
	{
		$stmt = $this->conn->prepare($qry);
		$stmt->execute();
	}
        
        
}	
	
	