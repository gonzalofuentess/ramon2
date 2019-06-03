<?php

require './fpdf/fpdf.php';
$db = new PDO('mysql:host=localhost;dbname=ramon', 'root', '');

class myPDF extends FPDF {

    function header() {
        $this->Image('logo.png', 10, 6);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(200, 5, utf8_decode('Reporte Automático'), 0, 0, 'C');
        $this->Ln();
        $this->SetFont('Times', '', 12);
        $this->Cell(200, 10, 'Radio Monitoreo FM', 0, 0, 'C');
        $this->Ln(20);
    }

    function footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', '', 8);
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    function headerTable() {
        $this->SetFont('Times', 'B', 12);
        $this->Cell(15, 10, 'ID', 1, 0, 'C');
        $this->Cell(40, 10, 'TIPO', 1, 0, 'C');
        $this->Cell(50, 10, 'inicio', 1, 0, 'C');
        $this->Cell(50, 10, 'termino', 1, 0, 'C');
        $this->Cell(36, 10, 'duracion_hora', 1, 0, 'C');
        $this->Ln();
    }

    function viewTable($db) {
        $this->SetFont('Times', '', 12);
        $stnt = $db->query('select idalerta, idtipo, inicio,termino, duracion_horas from ramon.alerta');
        while ($data = $stnt->fetch(PDO::FETCH_OBJ)) {          
            $this->Cell(15, 10, $data->idalerta, 1, 0, 'C');
            if($data->idtipo==1){
                $this->Cell(40, 10, 'Silencio', 1, 0, 'L');                
            }            
            $this->Cell(50, 10, $data->inicio, 1, 0, 'L');
            $this->Cell(50, 10, $data->termino, 1, 0, 'L');
            $this->Cell(36, 10, $data->duracion_horas, 1, 0, 'L');
            $this->Ln();
        }
    }

}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->headerTable();
$pdf->viewTable($db);
$pdf->Output();
#$pdf->Output("newpdf.pdf","F");
?>