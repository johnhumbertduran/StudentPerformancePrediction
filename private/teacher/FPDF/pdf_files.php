<?php
require "fpdf.php";

class myPDF extends FPDF{
    function header(){
        // $this->Image('logo.png',10,6);
        $this->SetFont('Arial','B',14);
        $this->Cell(276,5,'EMPLOYEE DOCUMENTS',0,0,'C');
        $this->Ln();
        $this->SetFont('Times','',12);
        $this->Cell(276,10,'Street Address of Employee Office','0','0','C');
        $this->Ln(20);
    }
    function footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','',8);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
    function headerTable(){
        $this->SetFont('Times','B',12);
        $this->Cell(276,10,'Preliminary Period',1,0,'C');
        $this->Ln();
        $this->SetFont('Times','B',12);
        $this->Cell(25,10,'Student ID',1,0,'C');
        $this->Cell(55,10,'Student Name',1,0,'C');
        $this->Cell(50,10,'Output',1,0,'C');
        $this->Cell(50,10,'Performance',1,0,'C');
        $this->Cell(30,10,'Major Exam',1,0,'C');
        $this->Cell(36,10,'Prelim Grade',1,0,'C');
        $this->Cell(30,10,'Equivalent',1,0,'C');
        $this->Ln();
        $this->SetFont('Times','B',12);
        $this->Cell(25,10,'',1,0,'C');
        $this->Cell(55,10,'Higest Possible Score',1,0,'C');
        $this->Cell(10,10,'20',1,0,'C');
        $this->Cell(10,10,'20',1,0,'C');
        $this->Cell(10,10,'40',1,0,'C');
        $this->Cell(10,10,'60',1,0,'C');
        $this->Cell(10,10,'0.40',1,0,'C');
        $this->Cell(10,10,'20',1,0,'C');
        $this->Cell(10,10,'20',1,0,'C');
        $this->Cell(10,10,'40',1,0,'C');
        $this->Cell(10,10,'60',1,0,'C');
        $this->Cell(10,10,'0.40',1,0,'C');
        $this->Cell(10,10,'70',1,0,'C');
        $this->Cell(10,10,'60',1,0,'C');
        $this->Cell(10,10,'0.20',1,0,'C');
        $this->Cell(36,10,'',1,0,'C');
        $this->Cell(30,10,'',1,0,'C');
        $this->Ln();
    }
}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->headerTable();
$pdf->Output();

?>