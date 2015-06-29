<?php

require('basepage.class.php');

class inputPage extends basePage
{
//    protected $id;
//    protected $tablename;
//    protected $posted;
//    protected $del;
//    
//    function __construct($id, $tablename, $del, $posted)
//    {
//       $this->del=$del; 
//       $this->id = $id;
//       $this->tablename= $tablename;
//       $this->posted=$posted;       
//    }
    
    protected function showContent()
    {  
    }

    protected function showSubmenuItems()
    {
        $submenuitems= array();
        $submenuitems['totoploeg'] = 'Totoploeg';
        $submenuitems['etapperegel'] = 'Etapperegel';

        foreach ($submenuitems as $id => $title)
        {
            echo "<li><a href='index.php?page=input&id=".$id."'>".$title."</a></li>";
        }
    }
    
    public function selectEtappeQuery()// for testing purposes only
    {
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'tourtoto';
        
        $conn = mysqli_connect($host, $user, $password, $database);
        $query = "SELECT id, naam FROM etappe";
        $this->result = mysqli_query($conn, $query)
        
        or die('failed');
        //var_dump($this->result);
        
    }
    
}
