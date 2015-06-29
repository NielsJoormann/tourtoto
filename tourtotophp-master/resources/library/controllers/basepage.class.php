<?php
class basePage
{	
    public function show()
    {

            echo "<html><head>";
            $this->head();
            echo "</head><body>";
            $this->body();
            echo "</body></html>";
    }
//=================================================================================================================================================	
    protected function head()
    {
        echo "
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            <link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css'>
           
            <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js'></script>
            <script src='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js'></script>
            
            ";	
        // <link rel='stylesheet' type='text/css' href='..\public_html\css\maincss.css'>

    }
//=================================================================================================================================================	
    protected function body()
    {
      $this->showHeader();
      $this->showMenu();
      $this->showContent();
      $this->showFooter();
    }
//=================================================================================================================================================	 
    protected function showHeader()
    {
        echo "<div class='container-fluid'>
                <div class= 'header'>
                    <img class='imagebanner' src='../public_html/img/tourdefrance_logo.png'>
                </div>
              </div>";
    }
//=================================================================================================================================================	
    protected function showMenu()
    {
        echo "<nav class='navbar navbar-inverse'>
                <div class='container-fluid'> 
                    <div>
                        <ul class='nav navbar-nav'>"; 
        $this->showMenuItems();
        echo "</ul>
                </div>
                   </div>
                    </nav>";
        echo "
        <div class='container-fluid'>   
       <ul class='nav nav-tabs'>";
        $this->showSubmenuItems();
         echo "</ul>
              </div>                   
                  ";
        
    }
//=================================================================================================================================================	
    protected function showContent()
    {
        
    }
//=================================================================================================================================================	
    protected function showFooter()
    {
        
    }
//=================================================================================================================================================	
protected function showMenuItems()
    {
       $menuitems= array();
       $menuitems['home'] = 'Home';
       $menuitems['input'] = 'Invoeren';
       $menuitems['edit'] = 'Wijzigen';
       $menuitems['output'] = 'Printen';
       $menuitems['logout'] = 'Log out';

       foreach ($menuitems as $page => $title)
       {
           echo "<li><a href='index.php?page=".$page."'>".$title."</a></li>";
       }
    }
    
    
 protected function showSubmenuItems()
 {
     
 }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
        
} ## End of class
