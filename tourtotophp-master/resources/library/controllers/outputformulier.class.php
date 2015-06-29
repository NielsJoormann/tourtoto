<?php

require_once('outputpage.class.php');

class outputFormulier extends outputPage
{
    public function showContent()
    {
        $this->showButton();
        $this->setName();
        $this->setTeam();
        $this->setReserves();
    }
    
    protected function showButton()
    {
        echo "<p><b>Print"."&nbsp".$this->tablename."&nbsp"."overzicht.</b><a href='index.php?page=edit&tablename=".$this->tablename."&id=add' target='_blank's></a><button type='button' class='btn btn-info btn-sm'><span class='glyphicon glyphicon-download-alt'></button></span></br></p>";
    }
//-------------------------------------------------------------------------------------------------------------------------------------
    protected function setName()
    {
        
        if(isset($_POST['totospelernaam']))
        {
            $this->ploegnaam = $_POST['totospelernaam'];
        }
        else
        {
            $this->ploegnaam = "Naam";
        }
       echo "<label>Totospelernaam"."&nbsp"."</label><table border='1'><input type='hidden' name='setnameform'><input type='text' name='totospelernaam' placeholder='".$this->ploegnaam ." '></table>";
    }
 //===================================================================================================================   
    public function setTeam()
    {
        $this->maxrenner_id = 427;
        $table = array('#','Rugnummer','Naam','');
        echo "<div class='row'><div class='col-md-6'><p align='center'><b>Totoploegrenners</b></p><table border='1'>";
        foreach($table as $col => $value)
        {
            echo "<th>".$value."</th>";
        }
        echo "</tr>";
        for($i=1; $i <21; $i++)
        {
            echo "<tr><td>".$i."</td><td><input type='hidden' name='totoploegrennerform' value='totoploegrennerform'><input type='text' name='totoploegrenner[]' id='input".$i."'></td><td><input type='text' name='' ></td><td></td></tr>";
        }
        echo "</table></div>";
    }
 //=========================================================================================================================   
    protected function setReserves()
    {
        $table = array('#','Rugnummer','Naam','');
        echo "<div class='col-md-6'>";
        echo "<p align='center'><b>Totoploeg reservisten</b></p>";
        echo "<table border='1'><tr>";
        foreach($table as $col => $value)
        {
            echo "<th>".$value."</th>";
        }
        echo "</tr>";
        for($res=1; $res <6; $res++)
        {
            echo "<tr><td>".$res."</td><td><input type='text' name='totoploegrenner[]' ></td><td><input type='text' name=''></td></tr>";
        }
        echo "</table>";
    }
}

