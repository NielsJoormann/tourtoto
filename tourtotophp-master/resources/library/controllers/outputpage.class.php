<?php

require('basepage.class.php');

    class outputPage extends basePage
    {
        protected $id;
        protected $tablename;
        protected $posted;
        function __construct($tablename, $id, $posted)
        {
            $this->id = $id;
            $this->tablename= $tablename;
            $this->posted=$posted;       
        }
        
       protected function showContent()
       {  
           
            //$this->handlePost();
            $this->showTable();
       }
       
       protected function showSubmenuItems()
       {
            $submenuitems= array();
            $submenuitems['algemeen'] = 'Algemeen Klassement';
            $submenuitems['dag'] = 'Dagklassement';
            $submenuitems['formulier'] = 'Totospeler Formulier';
            $submenuitems['renner'] = 'Rennerslijst';
            $submenuitems['etappeuitslag'] = 'Etappe uitslag';
            $submenuitems['totospeleruitslag'] = 'Totospeler uitslag';
            
            
            foreach ($submenuitems as $tablename => $title)
            {
                echo "<li><a href='index.php?page=output&tablename=".$tablename."'>".$title."</a></li>";
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
       
        public function selectQuery($tablename)
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
       
    }