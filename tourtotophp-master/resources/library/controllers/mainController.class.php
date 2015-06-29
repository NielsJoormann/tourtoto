<?php
require_once('basecontroller.class.php');
class mainController extends baseController
{	
	protected $parameter; 
	protected $controller;
	
//==============================================================================================================================	
	public function handleRequest()
	{       
                $this->parameter=$this->getParameter('page');
		$this->posted=($_SERVER['REQUEST_METHOD'] == 'POST');
                $this->checkLogIn();
		$this->createController();
                $this->showResponse();
    	}
//===============================================================================================================================
	
//=================================================================================================================================
	protected function createController() 
        {		
            switch($this->parameter)
            {
                    case 'home':
                        require_once('homecontroller.class.php');
                        $this->controller = new homeController();
                        break;
                    case 'edit':
                        require_once('editcontroller.class.php');
                        $this->controller = new editController();
                        break;       
                    case 'input':
                        require_once('inputcontroller.class.php');
                        $this->controller = new inputController();
                        break;
                    case 'output':
                        require_once('outputcontroller.class.php');
                        $this->controller = new outputController();
                        break;
                    case 'logout':
                        require_once('logoutcontroller.class.php');
                        $this->controller = new logoutController();
                        break;
                    default:
                        require_once('logincontroller.class.php');
                        $this->controller = new loginController();
                        break;
            }
        }	
	
//=============================================================================================================================
	
	protected function showResponse()
	{
		$this->controller->handleRequest();
				
	}	
	
//=========================================================================================================================	

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
} ###End of class

