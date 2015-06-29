
<?php
//added

require_once('basecontroller.class.php');
class homeController extends baseController
{    
           
    public function handleRequest()
    {        
        require_once('homepage.class.php');
        $page= new homePage();
        $page->show();
        
    }
    
}### End of class

