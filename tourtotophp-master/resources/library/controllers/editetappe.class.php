<?php

require_once ('editpage.class.php');

class editEtappe extends editPage
{
    public $result;
    public function __construct($tablename, $id, $del, $code, $name, $record, $posted)
    {
            parent::__construct($tablename, $id , $del, $code, $name, $record, $posted);
            $this->tablename = $tablename;
            $this->id=$id;
            $this->del=$del;
            $this->code=$code;
            $this->posted=$posted;
    }
  //---------------------------------------------------------------------------------------------------------------------------------    
    protected function tableContent()
    {    
        echo "<p><b>Voeg nieuw"."&nbsp".$this->tablename."&nbsp"."toe ...</b><a href='index.php?page=edit&tablename=".$this->tablename."&id=add'><button type='button' class='btn btn-info btn-sm'><span class='glyphicon glyphicon-plus'></span></button></a></p>";
        $this->tableColumnName();
        $this->tableFill();

//        if(isset($_POST['editform']))
//        {
//            echo "insert"."</br>";
//            $this->code = $_POST['code'];
//            $this->naam = $_POST['naam'];
//            echo $this->code;
//            echo $this->naam;
//        }
//        if(isset($_POST['editform']))
//        {
//            echo "delete"."</br>";
//            $this->code = $_POST['code'];
//            $this->naam = $_POST['naam'];
//            echo $this->code;
//            echo $this->naam;
//        }
//        if(isset($_POST['editform']))
//        {
//            echo "update"."</br>";
//            $this->code = $_POST['code'];
//            $this->naam = $_POST['naam'];
//            echo $this->code;
//            echo $this->naam;
//        }
        
        
   }
  //---------------------------------------------------------------------------------------------------------------------------------    
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
  //--------------------------------------------------------------------------------------------------------------------------------- 
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
  //--------------------------------------------------------------------------------------------------------------------------------- 
    protected function formContent()
        {
            echo "<form action='' method='POST' name='editform'>";
            $this->formFill();
            echo "</form>";
        }
  //--------------------------------------------------------------------------------------------------------------------------------- 
    protected function formFill()
    {
         if($this->id == 'add') //Insert
            {
                $this->selectQuery($this->tablename);
                $row = mysqli_fetch_assoc($this->result);
                echo "<input type='hidden' name='editform' tablename='".$this->tablename." id='".$this->id."'/>";
                foreach($row as $colname =>$value)
                {
                    if($colname !== 'id')
                    {
                        echo "<label>".$colname."</label></br>";
                        echo "<input type='text' name='".$colname."' placeholder='".$colname."'></br>";
                    }
                }
                echo "<input type='submit' name='editform' value='Voeg ".$this->tablename." toe'/><a href='index.php?page=edit&tablename=".$this->tablename."&id='".$this->id."'>
                        <button>Nee</button></a>";
                //var_dump($_POST['insert']);
            }
            elseif($this->del == 'del') //Delete
            {
                
                echo "<br><b>Weet u zeker dat u dit record wil verwijderen?</b></br>
                    <input type='hidden' name='editform' tablename='".$this->tablename."' id='".$this->id."'>";
                        
                $this->createForm();
                
                echo "<input type='submit' name='editform' value='Ja, verwijder ".$this->tablename."'/>
                        <a href='index.php?page=edit&tablename=".$this->tablename."&id='".$this->id."'>
                        <button>Nee</button></a>";
                //echo $this->id;
                //echo "bla";
            }
            else //update
            {   
                echo "<input type='hidden' name='editform' id='".$this->id."'>";
                $this->createForm();
                echo "<input type='submit' name='editform' value='Update ".$this->tablename."'/><a href='index.php?page=edit&tablename=".$this->tablename."&id='".$this->id."'>
                        <button>Nee</button></a>";
                
            }
    }
//--------------------------------------------------------------------------------------------------------------------------------- 
    protected function createForm()
    {   
        
    
        
        $this->selectQuery($this->tablename);
        $row = mysqli_fetch_assoc($this->result);
        
        foreach($row as $colname =>$value)
        {
          if($colname == 'id')
           {
               echo "<label>".$colname."</label></br>";
               echo "<input type='text' name='".$colname."' placeholder='".$colname."' value='".$this->id."' readonly></br>";
           }
        }
        $this->selectSpecific($this->tablename,$this->id);
        $row2 = mysqli_fetch_assoc($this->result);
        while (list($var, $val) = each($row2)) 
        {
                echo "<label>".$var."</label></br>";
                echo "<input type='text' name='".$var."' value='".$val."'></br>";
        }
        
    }
}
