<?php
  
require_once('basecontroller.class.php');
class inputController extends baseController
{    
    protected $parameter;
    public function handleRequest()
    {      
        $this->parameter=$this->getParameter('id');
       // $this->handlePost();
        $this->createPage();
        $this->showPage();
    }
//--------------------------------------------------------------------------
    public function createPage()
    {
        switch($this->parameter)
        {
            case 'totoploeg':
                require_once ('inputtotoploeg.class.php');
                $this->page = new inputTotoploeg();
                break;
            case 'etapperegel':
                require_once ('inputetapperegel.class.php');
                $this->page = new inputEtapperegel();
                break;
            default:
                require_once('inputpage.class.php');
                $this->page= new inputPage();
                break;
        }
    }
    // handlepost method ignored, does not work properly yet. mechanism uses in inputtotoploeg
    protected function handlePost()
    {
        switch($this->posted)
        {
            case 'totospelernaam':
                $this->speler = $_SESSION['totospelernaam'];
                echo "ploegnaam:".$this->speler."</br>";
                //require_once ('inputtotoploeg.class.php');
               // $this->inputTotoploeg = new inputTotoploeg();
                //$this->inputTotoploeg->showContent()->setName();
                break;
                //$this->inputTotoploeg = new inputTotoploeg();
                //$this->inputTotoploeg->showContent($this->speler);
                break;
            case 'totoploegrenner':
                $this->spelernaam = $_SESSION['totospelernaam'];
                $this->renner = $_SESSION['totoploegrenner'];
                echo "renners:".$this->renner."</br>";
                require_once('dataProvider.Class.php');
                $this->dataProvider = new dataProvider($this->spelernaam, $this->renner);
                $this->dataProvider->addNewTotoPloeg($this->spelernaam, $this->renner);
                unset($_SESSION['totospelernaam']);
                unset($_SESSION['totoploegnemer']);
                echo "lijst verzonden";
                break;
            default:
                echo "default";
                break;
        }
    }

    
}### End of class
