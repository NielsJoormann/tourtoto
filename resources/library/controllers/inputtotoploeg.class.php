<?php

require_once('inputpage.class.php');

class inputTotoploeg extends inputPage
{
    public function showContent()
    {
        $this->setName();
        if (isset($_POST['setname']))
        {   
            $this->setTeam();
            $this->setReserves();
        }
    }
 //===================================================================================================================   
    protected function setName()
    {
       echo "<form action='' method='POST'><label>Totoploegnaam"."&nbsp"."</label><input type='hidden' name='setname' value='setname'><input type='text'><input type='submit' name='confirm' value='Confirm'></form>";
       echo "<script>
                            $(document).ready(function(){
		
                            $('#confirm').click(function() {
                            $('#setname').prop('disabled', true);
                            });
			});
                        </script> ";
    }
 //===================================================================================================================   
    protected function setTeam()
    {
        $table = array('#','Rugnummer','Naam','');
        echo "<div class='row'>";
        echo "<div class='col-md-6'>";
        echo "<p align='center'><b>Totoploegrenners</b></p>";
        echo "<table><form action='' id='form1' method='POST'><tr>";
        foreach($table as $col => $value)
        {
            echo "<th>".$value."</th>";
        }
        echo "</tr>";
        for($i=1; $i <21; $i++)
        {
            echo "<tr><td>".$i."</td><td><input type='hidden' name='renner' value='renner".$i."'><input type='text' id='input".$i."' value=''></td><td><input type='text'></td><td><input type='submit' id='confirm' value='confirm'></td></tr>";
        }
        echo "</form></table>";
        echo "</div>";
        echo "<script>
                            $(document).ready(function(){
		
                            $('#confirm').click(function() {
                            $('#input1').prop('disabled', true);
                            });
			});
                        </script> ";
    }
 //=========================================================================================================================   
    protected function setReserves()
    {
        $table = array('#','Rugnummer','Naam','');
        echo "<div class='col-md-6'>";
        echo "<p align='center'><b>Totoploeg reservisten</b></p>";
        echo "<table><form action='' id='form1' method='POST'><tr>";
        foreach($table as $col => $value)
        {
            echo "<th>".$value."</th>";
        }
        echo "</tr>";
        for($res=1; $res <6; $res++)
        {
            echo "<tr><td>".$res."</td><td><input type='hidden' name='reserve' value='reserve".$res."'><input type='text' id='input".$res."' value=''></td><td><input type='text'></td><td><input type='submit' id='confirm' value='confirm'></td></tr>";
        }
        echo "</form></table>";
        echo "</div></div>";
    }
 //=========================================================================================================================        
    public function myFunction()
    {
        alert('hallo');
    }
}

