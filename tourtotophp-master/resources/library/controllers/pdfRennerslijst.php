<?php

 require_once ('outputpage.class.php');
 require_once ('outputrennerslijst.class.php');
 require_once ('pdfGenerator.class.php');

class pdfRennerslijst extends outputPage
{
   
   
     var $connection;
     var $query;
     
     
     public function __construct(){

         

        
    }


   
   public function createNewPdf()
   {
       $this->pdf = new FPDF();
       $this->pdf->setFont('Times', 'B', 24);
       $this->pdf->AddPage();
       $this->pdf->Cell(0, 18, 'Overzicht alle renners', 'B', 2, 'C');
       $this->Header();
       $this->tableFill();
       $name = "OverzichtAlleRenners.pdf";
       $dest = "I";
       $this->pdf->Output($name, $dest);

   }
   
   public function Header(){
             $this->pdf->setFont('Times', 'B', 10);
             $this->pdf->AliasNbPages();
             
             $this->pdf->Ln();     

             
             $this->pdf->Cell(0,9,'Pagina '.$this->pdf->PageNo().' van {nb}',0,0,'C');
             $this->pdf->Ln();     

       
             $this->pdf->setFont('Times', 'B', 16);
             $this->pdf->Cell(10, 9, '#', "BR", "C");
             $this->pdf->Cell(50, 9, 'Naam', "BR", "C");  
             $this->pdf->Cell(50, 9, 'Land', "BR", "C");
             $this->pdf->Cell(50, 9, 'Ploeg', "BR", "C");
             $this->pdf->Cell(30, 9, 'Active', "BR", "C");
            


             $this->pdf->Ln();     
   }
   
    protected function tableFill()
    {
            $i = 0;

            $this->result = $this->executeQuery();
            //var_dump($this->result);

            while ($renner = mysqli_fetch_assoc($this->result)) {
 
                    $this->pdf->setFont('Times', '', 12);
                    $this->pdf->Cell(10, 9, $renner['id'], "TB", "L");
                    $this->pdf->Cell(50, 9, \strtoupper($renner['achternaam']).", ".$renner['voornaam'], "TB", "L");

                    
                    $land_id = $renner['land_id'];
                    
                    $this->resultLand = $this->findLand($land_id);
                    
                    $landnaam = mysqli_fetch_assoc($this->resultLand);
                    
                    $this->pdf->Cell(50, 9, $landnaam['naam'], "TB", "L");
                    
                    $ploeg_id = $renner['ploeg_id'];
                    
                    $this->resultPloeg = $this->findPloeg($ploeg_id);
                    
                    $ploegnaam = mysqli_fetch_assoc($this->resultPloeg);
                    
                    $this->pdf->Cell(50, 9, $ploegnaam['naam'], "TB", "L");
                    
                    
                    if($renner['active'] == 0)
                        {
                            $this->pdf->Cell(30, 9, 'nee', "TB", "L");
                        } else {
                            $this->pdf->Cell(30, 9, 'ja', "TB", "L");
                        };
                    $this->pdf->Ln();
                    $i++;
                    
                    if($i == 20){
                        $this->pdf->AddPage();
                        $this->Header();
                        $i = 0;    
                    }
            };
      }
      
      public function findLand($land_id){
         $host = "localhost";
         $user = "root";
         $password = "";
         $dbname = "tourtoto";
         $connection = mysqli_connect($host, $user, $password, $dbname) or die ("Geen verbinding mogelijk");
         
         $query = "SELECT naam FROM land WHERE id =".$land_id;
         
         $this->resultLand = mysqli_query($connection, $query);
         
         return $this->resultLand;
         
      }
      
     public function findPloeg($ploeg_id){
         $host = "localhost";
         $user = "root";
         $password = "";
         $dbname = "tourtoto";
         $connection = mysqli_connect($host, $user, $password, $dbname) or die ("Geen verbinding mogelijk");
         
         $query = "SELECT naam FROM ploeg WHERE id =".$ploeg_id;
         
         $this->resultPloeg = mysqli_query($connection, $query);
         
         return $this->resultPloeg;
         
      }
      
      public function executeQuery (){
         $host = "localhost";
         $user = "root";
         $password = "";
         $dbname = "tourtoto";
         $connection = mysqli_connect($host, $user, $password, $dbname) or die ("Geen verbinding mogelijk");
        
        $query = "SELECT * FROM renner ORDER BY achternaam ASC";

        $this->result = mysqli_query($connection, $query);
        //var_dump($this->result);


        return $this->result;
         
     }
  
}
?>