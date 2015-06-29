<?php

require('basepage.class.php');

    class editPage extends basePage
    {
       protected $id;
       protected $tablename;
       protected $posted;
       protected $del;
       function __construct($id, $tablename, $del, $posted)
       {
           $this->del=$del; 
           $this->id = $id;
           $this->tablename= $tablename;
           $this->posted=$posted;       
       }
       
       protected function showContent()
       {
           if($this->posted)
           {
               $this->handlePost();
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
      
    }