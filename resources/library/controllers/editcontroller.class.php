<?php

require_once('basecontroller.class.php');
class editController extends baseController
{    
           
    public function handleRequest()
    {        
        $this->parameter=$this->getParameter('tablename');
        $this->createPage();
        $this->showPage();
        
    }
    
    public function createPage()
    {
        $tablename = $this->getParameter('tablename');
        $id = $this->getParameter('id');
        $del = $this->getParameter('del');
        switch($this->parameter)
        {
            case 'land':
                require_once ('editland.class.php');
                $this->page = new editLand($tablename, $id, $del, $this->posted);
                break;
            case 'renner':
                require_once ('editrenner.class.php');
                $this->page = new editRenner($tablename, $id, $del, $this->posted);
                break;
            case 'ploeg':
                require_once ('editploeg.class.php');
                $this->page = new editPloeg($tablename, $id, $del, $this->posted);
                break;
            case 'etappe':
                require_once ('editetappe.class.php');
                $this->page = new editEtappe($tablename, $id, $del, $this->posted);
                break;
            default:
                require_once('editpage.class.php');
                $this->page = new editPage($id, $tablename, $del, $this->posted);
                
                break;
        }
    }
    
}### End of class
