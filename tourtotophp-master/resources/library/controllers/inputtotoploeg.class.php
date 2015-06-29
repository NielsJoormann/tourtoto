<?php //

require_once('inputpage.class.php');

class inputTotoploeg extends inputPage
{
    protected $posted;
    public function showContent()
    {
        
            $this->setName();
            $this->handlePost();
       
    }
  //===================================================================================================================  
    protected function handlePost()//mechanism should be moved to inputcontroller, but it works this way
    {
        if(isset($_POST['totospelernaam']) && $_POST['totospelernaam'] != "")
        {
            $_SESSION['totospelernaam'] = $_POST['totospelernaam'];
            $this->setTeam();
            $this->setReserves();
        }
        if(isset($_POST['totoploegrenner']))
        {
            $this->spelernaam = $_SESSION['totospelernaam'];
            $this->renner = $_POST['totoploegrenner'];
            //submit to dataProvider class
            require_once('dataProvider.Class.php');
            $this->dataProvider = new dataProvider($this->spelernaam, $this->renner);
            //$this->dataProvider->addNewTotoPloeg($this->spelernaam, $this->renner);// commented because dataProvider is still incomplete
            var_dump($this->renner);
            // Unset session variables when post is submitted
            unset($_SESSION['totospelernaam']);
        }
    }

 //===================================================================================================================   
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
       echo "<form action='' method='POST'><label>Totospelernaam"."&nbsp"."</label><input type='hidden' name='setnameform'><input type='text' name='totospelernaam' placeholder='".$this->ploegnaam ." '><input type='submit' name='confirm' value='Bevestig'>";
       echo "<script>
                            $(document).ready(function(){
		
                            $('#confirm').click(function() {
                            $('#setname').prop('disabled', true);
                            });
			});
                        </script></form>";
    }
 //===================================================================================================================   
    public function setTeam()
    {
        $this->maxrenner_id = 427;
        $table = array('#','Rugnummer','Naam','');
        echo "<div class='row'>";
        echo "<div class='col-md-6'>";
        echo "<p align='center'><b>Totoploegrenners</b></p>";
        echo "<table><form action='' method='POST'>";
        foreach($table as $col => $value)
        {
            echo "<th>".$value."</th>";
        }
        echo "</tr>";
        for($i=1; $i <21; $i++)
        {
            echo "<tr><td>".$i."</td><td><input type='hidden' name='totoploegrennerform' value='totoploegrennerform'><input type='number' name='totoploegrenner[]' min='1' max='".$this->maxrenner_id."' id='input".$i."'></td><td><input type='text' name='' disabled='disabled'></td><td></td></tr>";
        }
        echo "</table>";
        echo "</div>";
    }
 //=========================================================================================================================   
    protected function setReserves()
    {
        $table = array('#','Rugnummer','Naam','');
        echo "<div class='col-md-6'>";
        echo "<p align='center'><b>Totoploeg reservisten</b></p>";
        echo "<table><tr>";
        foreach($table as $col => $value)
        {
            echo "<th>".$value."</th>";
        }
        echo "</tr>";
        for($res=1; $res <6; $res++)
        {
            echo "<tr><td>".$res."</td><td><input type='number' min='1' max='".$this->maxrenner_id."' name='totoploegrenner[]' ></td><td><input type='text' name='' disabled='disabled'></td></tr>";
        }
        echo "</table><div class='container'><input type='submit' name='submit' value='Verzenden'></div></form>";
    }
 //=========================================================================================================================        
}

