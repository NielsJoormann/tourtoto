<?php
class customException
	{
		protected $pdoconfig;
	function __construct($e,$pdoconfig)
	{
		
		$this->e=$e;
		$this->pdoconfig=$pdoconfig;

	}
	public function showException()
	{
		$this->e->getLine()."<br>";
		$errorCode=$this->e->getCode()."<br>";
			switch($errorCode)
			{
				case(1049):
				echo 'Database connection failed on line'.$this->e->getLine().', the database: '."'".$this->pdoconfig["database"]."'".' does not exist';
				break;
			
				case(1005):
				echo 'On line'.$this->e->getLine().', the table: '."'".$pdoconfig["tablename"]."'".' could not be created';
				break;
				
				case(1006):
				echo 'On line'.$this->e->getLine().', the database: '."'".$pdoconfig["database"]."'".' could not be created';
				break;
				
				case(1007):
				echo 'On line'.$this->e->getLine().', the database: '."'".$pdoconfig["database"]."'".' already exists';
				break;
				
				case(1008):
				echo 'On line'.$this->e->getLine().', the database: '."'".$pdoconfig["database"]."'".' cannot be dropped, does not exist';
				break;
				
				case(1146):
				echo 'On line'.$this->e->getLine().', the specified table does not exist';
				break;
				
				default:
				echo "<font color = 'red'><h1>SOMETHING HORRIBLE</font><font color='green'> HAS HAPPENED, PROBABLY</font><font color='blue'> HAMSTER RELATED!!<h1></font>";
				break;
			}
			
	}

}
?>