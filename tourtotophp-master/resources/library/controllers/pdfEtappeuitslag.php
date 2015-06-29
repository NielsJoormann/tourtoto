<?php

 require_once ('outputpage.class.php');
 require_once ('outputetappeuitslag.class.php');
 require_once ('pdfGenerator.class.php');

class pdfEtappeuitslag extends outputPage
{
   
   
     var $connection;
     var $query;
     var $etappe_id;
     
     public function __construct()
     {

     }


   
   public function createNewPdf()
   {
       $this->etappe_id = 1; //moet afkomstig zijn uit een form

       
       setlocale(LC_ALL, 'nl_NL');
       
       $datum = strftime("%A %e %B %Y");
       
       $this->pdf = new FPDF();
       $this->pdf->setFont('Times', 'B', 24);
       $this->pdf->AddPage();
       $this->pdf->Cell(0, 18, 'Uitslag van etappe '.$this->etappe_id, '', 2, 'C');
       $this->pdf->Ln();
       $this->pdf->setFont('Times', '', 10);
       $this->pdf->Cell(0, 18, 'Gereden op '.$datum, 'B', 2, 'C');
       $this->Header();
       $this->tableFill();

       $name = "Etappe-uitslag ".$datum.".pdf";
       $dest = "I";
       $this->pdf->Output($name, $dest);

   }
   
   public function Header(){
             $this->pdf->setFont('Times', "B", 16);
             $this->pdf->Cell(30, 9, 'Positie', "BR", "C");
             $this->pdf->Cell(30, 9, 'Punten', "BR", "C");            
             $this->pdf->Cell(80, 9, 'Renner', "BR", "C");            
             $this->pdf->Cell(50, 9, 'Tijd', "BR", "C");
             $this->pdf->Ln();     
   }
   
    protected function tableFill()
    {

            $positie = 1;
            
            $punten = array(15, 12, 10, 8, 6, 5, 4, 3, 2, 1);
            $behaaldepunten = 15;
            
            $this->result = $this->executeQuery();
            //var_dump($this->result);

            while ($uitslag = mysqli_fetch_assoc($this->result)) {
 
                    $this->pdf->setFont('Times', '', 12);
                    
                    $this->pdf->Cell(30, 9, $positie, "TB", "L");
                    
                    $this->pdf->Cell(30, 9, $behaaldepunten, "TB", "L");

                     
                    $rennerid = $uitslag['renner_id'];
                    
                    $this->resultRenner = $this->findRenner($rennerid);
                    
                    $rennernaam = mysqli_fetch_assoc($this->resultRenner);
                    
                    $this->pdf->Cell(80, 9, strtoupper($rennernaam['achternaam']) .", ".$rennernaam['voornaam'] , "TB", "L");

                    $this->pdf->Cell(50, 9, $uitslag['tijd'], "TB", "L");
                   
                    $this->pdf->Ln();
                    
                    $positie++;
                    
                    $behaaldepunten = next($punten);
                    
            };
      }
      
      public function findRenner($rennerid){
         $host = "localhost";
         $user = "root";
         $password = "";
         $dbname = "tourtoto";
         $connection = mysqli_connect($host, $user, $password, $dbname) or die ("Geen verbinding mogelijk");
         
         $query = "SELECT voornaam, achternaam FROM renner WHERE id =".$rennerid;
         
         $this->resultRenner = mysqli_query($connection, $query);
         
         return $this->resultRenner;
         
      }
    
      public function executeQuery (){
          
         $host = "localhost";
         $user = "root";
         $password = "";
         $dbname = "tourtoto";
         $connection = mysqli_connect($host, $user, $password, $dbname) or die ("Geen verbinding mogelijk");
        
         
        $query = "SELECT * FROM etapperegel WHERE etappe_id = '$this->etappe_id' ORDER BY tijd ASC";

        $this->result = mysqli_query($connection, $query);
        //var_dump($this->result);


        return $this->result;
         
     }
  
}
?>