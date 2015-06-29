 <?php
require_once 'databaseConnector.php';

class index{
    public function __construct(){
         $connector = new databaseConnector();
         $connection = $connector->__construct();
         $this->generatePage();
         $this->generateContent();
         $this->generateMenu();

         return $connection;
         
   }

public function generateMenu(){
    $this->menu = "<p><a href='printen.php'>Printen</a></p>
        <p><a href='wijzigen.php'>Wijzigen</a></p>
        <p><a href='invoeren.php'>Invoeren</a></p>";
}
   
public function generateContent() {
           
    
    $this->content = "<h1>Welkom</h1>";
        
     

}

    public function generatePage() {



        echo "<!DOCTYPE html>

        <html>
            <head>
                <meta http-equiv='content-type' content='text/html; charset=utf-8'></meta>
                <title></title>
            </head>
            <body>".$this->menu.$this->content."
            </body>
        </html>";
    }
 


};
         $this->generatePage();
         $this->generateContent();
         $this->generateMenu();
?>
