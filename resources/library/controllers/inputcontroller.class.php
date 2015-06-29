<?php
  
require_once('basecontroller.class.php');
class inputController extends baseController
{    
    protected $parameter;
    public function handleRequest()
    {      
        $this->parameter=$this->getParameter('id');
        //require_once('inputpage.class.php');
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
    

    
}### End of class
