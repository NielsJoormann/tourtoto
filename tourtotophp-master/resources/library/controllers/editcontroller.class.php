<?php

require_once('basecontroller.class.php');
class editController extends baseController
{    
           
    public function handleRequest()
    {        
        $this->parameter=$this->getParameter('tablename');
        $this->createPage();
        $this->handlePost();
        $this->showPage();
    }
    
    public function createPage()
    {
        $tablename = $this->getParameter('tablename');
        $id = $this->getParameter('id');
        $del = $this->getParameter('del');
        $name = $this->getParameter('name');
        //var_dump($this->parameter);
        //echo $this->parameter;
        //echo $name;
        switch($this->parameter)
        {
            case 'land':
                require_once ('editland.class.php');
                $this->page = new editLand($tablename, $id, $del, false, false, false, false, $this->posted);
                break;
            case 'renner':
                require_once ('editrenner.class.php');
                $this->page = new editRenner($tablename, $id, $del, false, false, false, false, $this->posted);
                break;
            case 'ploeg':
                require_once ('editploeg.class.php');
                $this->page = new editPloeg($tablename, $id, $del, false, false, false, false, $this->posted);
                break;
            case 'etappe':
                require_once ('editetappe.class.php');
                $this->page = new editEtappe($tablename, $id, $del, false, false, false, false, $this->posted);
                break;
            default:
                require_once('editpage.class.php');
                $this->page = new editPage($id, $tablename, $del, false, false, false, false, $this->posted);
                
                break;
        }
    }
    
    public function handlePost()
    {   
        $this->editform = $this->getParameter('editform');
        $tablename = $this->getParameter('tablename');
        $id = $this->getParameter('id');
        echo $this->editform;
        echo "<br>"."id = ".$id."</br>";
        switch($this->editform)
        {
            case 'Ja, verwijder land':// verwijderen
                //$id = $this->getParameter('id');
                echo $id."&nbsp"."van"."&nbsp".$tablename."&nbsp"."wordt verwijderd."; 
                break;
            case 'Update land':// updaten
                $code = $_POST['code'];
                $naam = $_POST['naam'];
                echo "<br>"."De"."&nbsp"."code:"."&nbsp".$code."&nbsp"."en"."&nbsp"."naam:".$naam."&nbsp"."van"."&nbsp"."id:".$id."&nbsp"."van"."&nbsp".$tablename."&nbsp"."zijn aangepast!"."</br>";
                break;
            case 'Voeg land toe':// toevoegen
                $code = $_POST['code'];
                $naam = $_POST['naam'];
                echo "<br>".$naam."&nbsp"."met code:".$code."&nbsp"."is toegevoegd aan tabel:"."&nbsp".$tablename."</br>";
                break;
            case 'Ja, verwijder renner':// verwijderen
                $voornaam = $_POST['voornaam'];
                $achternaam = $_POST['achternaam'];
                $ploeg_id = $_POST['ploeg_id'];
                //$land_id = $_POST['land_id'];
                $active = $_POST['active'];
                echo $id."&nbsp"."van"."&nbsp".$tablename."&nbsp"."wordt verwijderd."; 
                break;
            case 'Update renner':// updaten
                $voornaam = $_POST['voornaam'];
                $achternaam = $_POST['achternaam'];
                $ploeg_id = $_POST['ploeg_id'];
                //$land_id = $_POST['land_id'];
                $active = $_POST['active'];
                //echo "<br>"."De"."&nbsp"."code:"."&nbsp".$code."&nbsp"."en"."&nbsp"."naam:".$naam."&nbsp"."van"."&nbsp"."id:".$id."&nbsp"."van"."&nbsp".$tablename."&nbsp"."zijn aangepast!"."</br>";
                break;
            case 'Voeg renner toe':// toevoegen
                $voornaam = $_POST['voornaam'];
                $achternaam = $_POST['achternaam'];
                $ploeg_id = $_POST['ploeg_id'];
                //$land_id = $_POST['land_id'];
                $active = $_POST['active'];
                //echo "<br>".$naam."&nbsp"."met id:".$id."&nbsp"."is toegevoegd aan tabel:"."&nbsp".$tablename."</br>";
                break;
            case 'Ja, verwijder ploeg':// verwijderen
                //echo $id."&nbsp"."van"."&nbsp".$tablename."&nbsp"."wordt verwijderd."; 
                break;
            case 'Update ploeg':// updaten
                $code = $_POST['code'];
                $naam = $_POST['naam'];
                //echo "<br>"."De"."&nbsp"."code:"."&nbsp".$code."&nbsp"."en"."&nbsp"."naam:".$naam."&nbsp"."van"."&nbsp"."id:".$id."&nbsp"."van"."&nbsp".$tablename."&nbsp"."zijn aangepast!"."</br>";
                break;
            case 'Voeg land ploeg':// toevoegen
                $code = $_POST['code'];
                $naam = $_POST['naam'];
                //echo "<br>".$naam."&nbsp"."met id:".$id."&nbsp"."is toegevoegd aan tabel:"."&nbsp".$tablename."</br>";
                break;
            case 'Ja, verwijder etappe':// verwijderen
                echo $id."&nbsp"."van"."&nbsp".$tablename."&nbsp"."wordt verwijderd."; 
                break;
            case 'Update etappe':// updaten
                $code = $_POST['code'];
                $naam = $_POST['naam'];
                echo "update etappe"; 
                echo "<br>"."De"."&nbsp"."code:"."&nbsp".$code."&nbsp"."en"."&nbsp"."naam:".$naam."&nbsp"."van"."&nbsp"."id:".$id."&nbsp"."van"."&nbsp".$tablename."&nbsp"."zijn aangepast!"."</br>";
                break;
            case 'Voeg etappe toe':// toevoegen
                $code = $_POST['code'];
                $naam = $_POST['naam'];
                echo "<br>".$naam."&nbsp"."met id:".$id."&nbsp"."is toegevoegd aan tabel:"."&nbsp".$tablename."</br>";
                break;
            default:
                $id = 0;
                echo "<br>".'nada'."</br>";
                break;
                
        }
    }
    
}### End of class
