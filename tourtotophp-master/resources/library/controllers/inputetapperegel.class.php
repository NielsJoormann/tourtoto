<?php

require_once('inputpage.class.php');

class inputEtapperegel extends inputPage
{
    protected $uploadOK;
    public function showContent()
    {
        $this->showEtappe();
        $this->handlePost();
    }
//----------------------------------------------------------------------------------  
    public function showEtappe() 
    {   
        if(isset($_POST['etappe_id']))
        {
            $this->etappeplaceholder = "value='".$_POST['etappe_id']."'";
        }
        else
        {
            $this->etappeplaceholder = "placeholder='#'";
        }
        $this->maxetappe_id = 20;
        //temporary data for testing
        $topten = array();
        $topten[1] = "Renner1";
        $topten[2] = "Renner2";
        $topten[3] = "Renner3";
        $topten[4] = "Renner4";
        $topten[5] = "Renner5";
        $topten[6] = "Renner6";
        $topten[7] = "Renner7";
        $topten[8] = "Renner8";
        $topten[9] = "Renner9";
        $topten[10] = "Renner10";
        
        $etappe = array();
        $etappe[1] = "Proloog";
        $etappe[2] = "Etappe2";
        $etappe[3] = "Finale";
        //remove  above when done
        $this->maxrenner_id = 427;
        // etappekeuze
        echo "<p><b>Kies etappe:</b></p>"."</br>";
        echo " <input list='browsers' name='browser' required>
        <datalist id='browsers'>";
        //echo "<option value='".$var."' selected>".$var."</option>";
        $this->selectEtappeQuery();
        while($row = mysqli_fetch_assoc($this->result))
        {
            echo "<option value='".$row['id']."'>".$row['id'].".&nbsp.".$row['naam']."</option>";
        }
        echo "</datalist></br>";

       
        // rennerstabel
        
        echo "<br>"."<p><b>Vul hier de eerste tien renners in:</b></p>"."</br>"."<table border='1'>";
        echo "<tr><th>#</th><th>Rugnummer</th><th>Renner Naam</th></tr>";
        
            $i = 1;
            foreach($topten as $pos => $renner)
                {
                    echo "<tr><td>".$i."</td><td><input type='number' min='1' max='".$this->maxrenner_id."'name='renner_id[]'></td><td><input type='text' placeholder='disabled' disabled></td>";
                    $i++;
                }
            echo "</td></tr>";

  
        echo "</table>";
              echo "
                    
                    <input type='submit'>
                </form>
                <br>
                ";
             
    }
  //-------------------------------------------------------------------------------------------------  
        protected function handlePost()//mechanism should perhaps be moved to inputcontroller, but it works this way
    {
        if(isset($_POST['etappe_id']) && $_POST['etappe_id'] != "")
        {
            $_SESSION['etappe_id'] = $_POST['etappe_id'];
        }
        if(isset($_POST['renner_id']) && isset($_SESSION['etappe_id']))
        {
            $this->etappe_id = $_SESSION['etappe_id'];
            $this->renner_id = $_POST['renner_id'];
            //submit to dataProvider class
            require_once('dataProvider.Class.php');
            $this->dataProvider = new dataProvider($this->etappe_id, $this->renner_id);
            //$this->dataProvider->addNewTotoPloeg($this->etappe_id, $this->renner_id);// commented because dataProvider is still incomplete
            var_dump($this->renner_id);
            // Unset session variables when post is submitted
            unset($_SESSION['etappe_id']);
        }
    }
        
//-------------------------------------------------------------------------------------------------
// Methods for uploading csv file | unused at the moment
    /*
    public function showCSV()
    {
        $csv = array();
        $file = fopen('../etapperegel.csv', 'r', 1);
        
        while (($result = fgetcsv($file)) !== false)
        {
            $csv[] = $result;
        }
        fclose($file);

        $resultaat = "<table border='2px'>";
        for ($row =0 ; $row < 2;  $row++)
        {   
                $resultaat .= "<tr>";              
                $resultaat .= "<td>".$csv[$row][0]."</td><td>".$csv[$row][1]."</td><td>".$csv[$row][2]."</td><td>".$csv[$row][3]."</td><td>".$csv[$row][4]."</td>";
                $resultaat .= "</tr>";
        }
        $resultaat .= "</table>";
        echo $resultaat;
    }
//----------------------------------------------------------------------------------    
    public function upload()
    {
        echo "Etapperegel invoeren"."</br>";
        echo "
                <br><form action= '' method='post' enctype='multipart/form-data'>
                    Select image to upload:
                    <input type='file' name='fileToUpload' id='fileToUpload'>
                    <input type='submit' value='Bestand invoeren' name='submit'>
                </form></br>
            ";
    }
    //------------------------------------------------------------------------------
    public function fileUpload()
    {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
 
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["fileToUpload"]["tmp_name"]). " has been uploaded.";
                //$this->showCSV();
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
    
    */
}

