<?php

require_once ('outputpage.class.php');



class outputRennersLijst extends outputPage
{

    
     
            
    
    public function showContent()
    {

        $this->showTable();

        

    }
    
     protected function tableContent()
            
       {    
            $this->tableColumnName();
            $this->tableFill();
       }
       
    protected function tableColumnName()
    {
            $this->selectQuery($this->tablename);
            $row = mysqli_fetch_assoc($this->result);
            echo "<tr>";
             foreach($row as $colname =>$value)
            {
                echo "<th>".$colname."</th>";
 
            }
            echo "</tr>";
     }
    
    protected function tableFill()
    {
        $this->selectQuery($this->tablename);
        while($row = mysqli_fetch_assoc($this->result))
        {   
            echo "<tr>";
 
            foreach($row as $colname => $value)
            {
                echo "<td>".$value."</td>";
             }
            
            echo "</tr>";
 
        }
    }
    
        protected function tableEnd()
        {
            echo "</table></div>";
            echo "<p><b>Add new...</b><a href='index.php?page=edit&tablename=".$this->tablename."&id=add'><button type='button' class='btn btn-info btn-sm'><span class='glyphicon glyphicon-plus'></span></p>";
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
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

