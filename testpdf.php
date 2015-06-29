<?php
require('fpdf17/fpdf.php');

$content = 'Le content';

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,$content);
$pdf->Output();
?>