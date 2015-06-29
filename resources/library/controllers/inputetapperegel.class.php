<?php

require_once('inputpage.class.php');

class inputEtapperegel extends inputPage
{
    protected $uploadOK;
    public function showContent()
    {
        //$this->showCSV();
        //$this->upload();
        //$this->fileUpload();
        $this->showDropdown();
        $this->handlePost();
    }
//----------------------------------------------------------------------------------  
   
    public function showDropdown() 
    {
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
       
        // etappekeuze
        echo "<h3>Kies etappe:</h3>"."</br>"."<select>";
      
        foreach($etappe as $id => $nummer)
            {
             echo "<option value='".$nummer."'>".$nummer."</option>";
            }
        echo "</select>";
       
        // rennerstabel
        echo "<br>"."<h3>Vul hier de eerste tien renners in:</h3>"."</br>"."<table border='1'>";
        echo "<tr><th>#</th><th>Renner</th></tr>";
        for($i = 1; $i<11; $i++)
        {
            echo "<tr><td>".$i."</td><td><select name='toptenlist' form='toptenform' id='_go".$i."'>";
            foreach($topten as $pos => $renner)
                {
                    echo "<option value='".$renner."'>".$renner."</option>";
                }
            echo "</select></td></tr>";
        }
  
        echo "</table>";
              echo "<form action='' id='toptenform' method='POST'>
                    <input type='hidden' name='toptenlist' value='topten'>
                    <input type='submit'>
                </form>
                <br>
                ";
             
    }
    
    
   //-------------------------------------------------------------------------------------------------
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
    
    public function handlePost()
    {
        if($_SERVER['REQUEST_METHOD'] = 'POST')
        {
            if(isset($_POST['toptenlist']))
            {
                $toptenlist = $_POST['toptenlist'];
                echo "toptenlist";
                var_dump($toptenlist);
            }
        }
    }
}

