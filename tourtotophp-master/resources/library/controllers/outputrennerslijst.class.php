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
           echo "<p><b>Print"."&nbsp".$this->tablename."&nbsp"."overzicht.</b><a href='../resources/library/controllers/printpdfRennerslijst.php' target='_blank's><button type='button' class='btn btn-info btn-sm'><span class='glyphicon glyphicon-download-alt'></span></a></p>";
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
}


