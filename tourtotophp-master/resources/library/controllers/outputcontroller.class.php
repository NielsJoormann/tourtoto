<?php
  
require_once('basecontroller.class.php');
class outputController extends baseController
{    
    protected $parameter;
    public function handleRequest()
    {      
        $this->parameter=$this->getParameter('tablename');
        $this->createPage();
        $this->showPage();
    }
//--------------------------------------------------------------------------
    public function createPage()
    {
        $tablename = $this->getParameter('tablename');
        $id = $this->getParameter('id');
        switch($this->parameter)
        {
            case 'algemeen':
                require_once ('outputalgemeenklassement.class.php');
                $this->page = new outputAlgemeenKlassement($tablename, $id, $this->posted);
                break;
            case 'dag':
                require_once ('outputdagklassement.class.php');
                $this->page = new outputDagKlassement($tablename, $id, $this->posted);
                break;
            case 'formulier':
                require_once ('outputformulier.class.php');
                $this->page = new outputFormulier($tablename, $id, $this->posted);
                break;
            case 'renner':
                require_once ('outputrennerslijst.class.php');
                $this->page = new outputRennersLijst($tablename, $id, $this->posted);
                break;
            case 'etappeuitslag':
                require_once ('outputetappeuitslag.class.php');
                $this->page = new outputEtappeUitslag($tablename, $id, $this->posted);
                break;
            case 'totospeleruitslag':
                require_once ('outputtotospeleruitslag.class.php');
                $this->page = new outputTotoSpelerUitslag($tablename, $id, $this->posted);
                break;
            default:
                require_once('outputpage.class.php');
                $this->page= new outputPage($tablename, $id, $this->posted);
                break;
                
                
        }
    }
    

    
}### End of class
