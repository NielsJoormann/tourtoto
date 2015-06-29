
<?php
require_once 'fpdf17/fpdf.php';
class pdfGenerator {

    public function createPdf($content)
    {
    
        $content = "Hier komt een heleboel content";

        $this->pdf = new FPDF();
        $this->pdf->AddPage();
        $this->pdf->SetFont('Arial','B',16);
        $this->pdf->Cell(40,10,$content);
        $this->pdf->Output();

    }
    
   
    
}
?>