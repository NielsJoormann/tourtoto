<?php

require_once('basepage.class.php');

class logoutPage extends basePage
{   
    protected function showContent()
    {
        session_destroy();
        echo "Je bent nu uitgelogd.
            ";
        echo "<a href='index.php'>Terug naar login</a>
            ";
        
    } 
    
    protected function showMenuItems()
    {
        
    }
    
    protected function showSubmenuItems() 
    {
       
    }
//===============================================================================================================        
    
}### End of class