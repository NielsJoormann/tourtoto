<?php

require('basepage.class.php');

    class editPage extends basePage
    {
       protected $id;
       protected $tablename;
       protected $posted;
       protected $del;
       protected $code;
       protected $record;
       protected $land_id;
       function __construct($id, $tablename, $del, $code, $name, $record, $land_id, $posted)
       {
           $this->del=$del; 
           $this->id = $id;
           $this->tablename= $tablename;
           $this->code=$code;
           $this->name=$name;
           $this->record=$record;
           $this->land_id=$land_id;
           $this->posted=$posted;  
       }
       
       protected function showContent()
       {
           if($this->posted)
           {
               //$this->handlePost();
               $this->showTable();
           }
           else
           {
               if($this->id == 'Onbekend')
               {
                   $this->showTable();
               }
               else
               {
                   $this->showForm();
               }
           }
       }
       
        protected function showSubmenuItems()
       {
            $submenuitems= array();
            $submenuitems['land'] = 'Land';
            $submenuitems['renner'] = 'Renner';
            $submenuitems['ploeg'] = 'Ploeg';
            $submenuitems['etappe'] = 'Etappe';

            foreach ($submenuitems as $page => $title)
            {
                echo "<li><a href='index.php?page=edit&tablename=".$page."'>".$title."</a></li>";
            }
       }
       
       protected function showTable()
       {
           $this->tableStart();
           $this->tableContent();
           $this->tableEnd();
       }
  //============================================================================================
    protected function tableStart()
    {
        echo "<div class='container-fluid'><table border='1'>";
    }
 //=============================================================================================
       protected function tableContent()
       {
           
       }
 //==========================================================================================
       protected function tableEnd()
       {
           echo "</table></div>";
           
       }
 //---------------------------------------------------------------------------------
        protected function showForm()
        {
            $this->formStart();
            $this->formContent();
            $this->formEnd();

        }
 //=====================================================================================      
        protected function formStart()
        {
            echo "<form action='index.php?page=edit&tablename=".$this->tablename."' method='POST'>";
        }
        protected function formContent()
        {

        }
  //===================================================================================
        protected function formEnd()
        {
            echo "</form>";
        }
//=========================================================================================      
    public function selectQuery($tablename)// for testing purposes only
    {
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'tourtoto';
        
        $conn = mysqli_connect($host, $user, $password, $database);
        $query = "SELECT*FROM $this->tablename";
        $this->result = mysqli_query($conn, $query)
        or die('failed');
        
    }
  //--------------------------------------------------------------------------------------------------------------------------------- 
        public function selectSpecificLand($tablename, $id)
    {
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'tourtoto';
        
        $conn = mysqli_connect($host, $user, $password, $database);
        $query = "SELECT code, naam FROM $this->tablename WHERE ID = $this->id";
        $this->result = mysqli_query($conn, $query)
        or die('failed');
    }
    
    public function selectSpecificRenner($tablename, $id)
    {
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'tourtoto';
        
        $conn = mysqli_connect($host, $user, $password, $database);
        $query = "SELECT voornaam, achternaam, ploeg_id, land_id, active FROM $this->tablename WHERE ID = $this->id";
        $this->result = mysqli_query($conn, $query)
        or die('failed');
    }
    
    public function selectSpecificPloeg($tablename, $id)
    {
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'tourtoto';
        
        $conn = mysqli_connect($host, $user, $password, $database);
        $query = "SELECT code, naam, land_id FROM $this->tablename WHERE ID = $this->id";
        $this->result = mysqli_query($conn, $query)
        or die('failed');
    }
    
    public function selectSpecificLand_id($tablename, $id)
    {
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'tourtoto';
        
        $conn = mysqli_connect($host, $user, $password, $database);
        $query = "SELECT naam, id FROM land ORDER BY land.naam ASC";
        $this->result = mysqli_query($conn, $query)
        or die('failed');
    }

    
}