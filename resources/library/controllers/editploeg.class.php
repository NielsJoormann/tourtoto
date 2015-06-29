<?php

require_once ('editpage.class.php');

class editPloeg extends editPage
{
    public $result;
    
    
    public function __construct($tablename, $id, $del, $posted)
    {
            parent::__construct($tablename, $id , $del, false);
            $this->tablename = $tablename;
            $this->id=$id;
            $this->del=$del;
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
            echo "<td><a href='index.php?page=edit&tablename=".$this->tablename."&id=".$row['id']."'><button type='button' class='btn btn-info btn-sm'><span class='glyphicon glyphicon-pencil'></span></td>";
            echo "<td><a href='index.php?page=edit&tablename=".$this->tablename."&id=".$row['id']."&del=del'><button type='button' class='btn btn-info btn-sm'><span class='glyphicon glyphicon-trash'></span></td>";
            echo "</tr>";
        }
    }
    
        protected function tableEnd()
        {
            echo "</table></div>";
            echo "<p><b>Add new...</b><a href='index.php?page=edit&tablename=".$this->tablename."&id=add'><button type='button' class='btn btn-info btn-sm'><span class='glyphicon glyphicon-plus'></span></p>";
        }
                
       
    protected function formContent()
        {
          
        
            if($this->id == 'add') //Insert
            {
                $this->selectQuery($this->tablename);
                $row = mysqli_fetch_assoc($this->result);
                echo "<input type='hidden' name='insert' value='insert'/>";
            
                 foreach($row as $colname =>$value)
                {
                    if($colname !== 'id')
                    {
                  
                    echo "<label>".$colname."</label></br>";
                    echo "<input type='text' name='".$colname."' placeholder='".$colname."'></br>";
                    }
                }
                echo "<input type='submit' value='Toevoegen'/>";
            }
            elseif($this->del == 'del') //Delete
            {
                echo "<b>Weet u zeker dat u dit record wil verwijderen?</b>";
                echo "
                    <input type='hidden' name='delete".$this->id."' value='delete'/>
                    <input type='submit' value='Ja'/>";
                echo "<a href='index.php?page=edit&tablename=".$this->tablename."'><button>Nee</button></a>";
            }
            else //update
            {   
                $this->selectQuery($this->tablename);
                $row = mysqli_fetch_assoc($this->result);
                echo "<input type='hidden' name='update".$this->id."' value='update'/>";
            
                 foreach($row as $colname =>$value)
                {
                    if($colname !== 'id')
                    {
                  
                    echo "<label>".$colname."</label></br>";
                    echo "<input type='text' name='".$colname."'placeholder='".$colname."'></br>";
                    }
                }
                echo "<input type='submit' value='Bevestigen'/>";
            }
            
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
