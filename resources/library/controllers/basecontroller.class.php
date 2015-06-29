<?php

class baseController
{
    protected $posted;
    protected $page;
    public $username;
    public $password;
//=============================================================================================   
    public function __construct()
    {
        $this->posted = ($_SERVER['REQUEST_METHOD'] == 'POST');
    }
//===========================================================================================  
    public function handleRequest()
    {
        
    }
//============================================================================================   
    protected function getParameter($parameternaam)
    {
	if($this->posted && isset($_POST[$parameternaam]) )
	{
            return $_POST[$parameternaam]; 
        }		
        else 
        {
            if(isset($_GET[$parameternaam]))
            {
                return $_GET[$parameternaam];
            }
        }
        return "Onbekend";
    }
//==================================================================================================        
    public function showPage()
    {
        $this->page->show();
    }
//==================================================================================================    
    public function checkLogin()
    {
        if($this->posted && $this->parameter == 'login')
        {
            // check user
            if(($this->checkUser()) && ($this->checkEmpty()))
            {
                $this->parameter = 'home';
            }
            else 
            {
                $this->parameter = 'login';
                echo "<div><p align='center'><b>Please fill in your username and password.</b></p></div>";
            }
        }
        else
        {
            if($this->isLoggedIn()== false)
            {
                $this->parameter = 'login';
            }
        }
    }
//==================================================================================================     
    protected function isLoggedIn()
    {
        return(isset($_SESSION['username']) && $_SESSION['username'] != "");
    }
//==================================================================================================    
    protected function checkEmpty()
    {
        return(($_POST['username'] != "") && ($_POST['password'] != ""));
    }
//================================================================================================== 
    protected function checkUser()
    {
        // shorthand see belowe for explanation
        $username=(isset($_POST['username']) ? $_POST['username']:"Noppes");
        $password=(isset($_POST['password']) ? $_POST['password']:"Noppes");
     
        // shorthand above explained
        /*
        if(isset($_POST['username']) == true)
        {
            $username = $_POST['username'];
        }
        else 
        {
            $username = "Noppes";
        } 
        */
        
        // When dataprovider is complete uncomment this below
        /*
        if(dataprovider->checkUser($username, $password))
        {
            return true;
        }
        else
        {
            return false;
        }
         
         */
        $_SESSION['username'] = $username;
        return true;
    }
//==================================================================================================        
}### End of class
