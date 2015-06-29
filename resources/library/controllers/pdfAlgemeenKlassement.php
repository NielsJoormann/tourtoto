<?php

 require_once ('outputpage.class.php');
 require_once ('outputalgemeenklassement.class.php');
 require_once ('pdfGenerator.class.php');

class pdfAlgemeenKlassement extends outputPage
{
   
   
     var $connection;
     var $query;
     
     
     public function __construct()
     {

     }


   
   public function createNewPdf()
   {
       setlocale(LC_ALL, 'nl_NL');
       
       $datum = strftime("%A %e %B %Y");
       
       $this->pdf = new FPDF();
       $this->pdf->setFont('Times', 'B', 24);
       $this->pdf->AddPage();
       $this->pdf->Cell(0, 18, 'Algemeen Klassement', '', 2, 'C');
       $this->pdf->Ln(10);
       $this->pdf->setFont('Times', '', 10);
       $this->pdf->Cell(0, 18, 'Tussenstand op '.$datum, 'B', 2, 'C');
       $this->Header();
       $this->tableFill();

       $name = "Algemeen Klassement ".$datum.".pdf";
       $dest = "I";
       $this->pdf->Output($name, $dest);

   }
   
   public function Header(){
             $this->pdf->setFont('Times', "B", 16);
             $this->pdf->Cell(30, 9, 'Positie', "BR", "C");            
             $this->pdf->Cell(90, 9, 'Totospeler', "BR", "C");            
             $this->pdf->Cell(70, 9, 'Punten', "BR", "C");
             $this->pdf->Ln();     
   }
   
    protected function tableFill()
    {
            $i = 0;
            $positie = 1;

            $this->result = $this->executeQuery();
            //var_dump($this->result);

            while ($speler = mysqli_fetch_assoc($this->result)) {
 
                    $this->pdf->setFont('Times', '', 12);
                    $this->pdf->Cell(30, 9, $positie, "TB", "L");

                    
                    $totospelerid = $speler['totospeler_id'];
                    
                    $this->resultTotospeler = $this->findTotospeler($totospelerid);
                    
                    $totospelernaam = mysqli_fetch_assoc($this->resultTotospeler);
                    
                    $this->pdf->Cell(90, 9, $totospelernaam['naam'], "TB", "L");
                    
                    $this->pdf->Cell(70, 9, $speler['punten'], "TB", "L");
                   
                    $this->pdf->Ln();
                    
                    $positie++;
                    
                    $i++;
                    
                    if($i == 25){
                        $this->pdf->AddPage();
                        $this->Header();
                        $i = 0;    
                    }
            };
      }
    
      public function executeQuery (){
         $host = "localhost";
         $user = "root";
         $password = "";
         $dbname = "tourtoto";
         $connection = mysqli_connect($host, $user, $password, $dbname) or die ("Geen verbinding mogelijk");
        
        $query = "SELECT DISTINCT totospeler_id, punten FROM totospelerploeg ORDER BY punten DESC";

        $this->result = mysqli_query($connection, $query);
        //var_dump($this->result);


        return $this->result;
         
     }
     
     public function findTotospeler($totospelerid){
         $host = "localhost";
         $user = "root";
         $password = "";
         $dbname = "tourtoto";
         $connection = mysqli_connect($host, $user, $password, $dbname) or die ("Geen verbinding mogelijk");
         
         $query = "SELECT naam FROM totospeler WHERE id =".$totospelerid;
         
         $this->resultTotospeler = mysqli_query($connection, $query);
         
         return $this->resultTotospeler;
         
      }
}
?>