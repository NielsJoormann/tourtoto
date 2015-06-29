<?php

require_once('basecontroller.class.php');
class logoutController extends baseController
{
    
    
    
    public function handleRequest()
    {
        require_once('logoutpage.class.php');
        $page= new logoutPage();
        $page->show();
    }
    
//=================================================================================================    
    

}###End of class
