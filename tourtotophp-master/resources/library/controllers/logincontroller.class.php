<?php

require_once('basecontroller.class.php');
class loginController extends baseController
{
    
    
    
    public function handleRequest()
    {
        require_once('loginpage.class.php');
        $page= new loginPage();
        $page->show();
    }
    
//=================================================================================================    
}###End of class
