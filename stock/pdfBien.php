<?php 
require('../fpdf181/fpdf.php');

@$nombre = $_GET['nombre'];
@$tipo   = $_GET['tipo'];
@$marca  = $_GET['marca'];
@$modelo = $_GET['modelo'];
@$serie  = $_GET['serie'];

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('../img/logo.png',10,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(30,10,'ASIGNACION DE ACTIVOS',0,0,'C');
    // Line break
    $this->Ln(20);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
for($i=1;$i<=3;$i++)
    $pdf->Cell(0,10,' ',0,1);
$pdf->Cell(0,10,'Por medio del presente formulario, el/la abajo firmante, recibe el activo descrito en condiciones de uso.',0,1);
$pdf->Cell(0,10,' ',0,1);
$pdf->Cell(0,10,'Asi mismo se compromete a hacer un correcto uso del mismo y a notificar de forma fehaciente el robo, hurto,',0,1);
$pdf->Cell(0,5,'rotura, deterioro o cualquier evento que altere el correcto funcionamiento del activo asignado.',0,1);
for($i=1;$i<=3;$i++)
    $pdf->Cell(0,10,' ',0,1);
$pdf->Cell(0,10,'Activo: ' . $tipo,0,1);
$pdf->Cell(0,10,'Marca: ' . $marca,0,1);
$pdf->Cell(0,10,'Modelo: ' . $modelo,0,1);
$pdf->Cell(0,10,'Identificador: ' . $serie,0,1);
$pdf->Cell(0,10,' ',0,1);
$pdf->Cell(0,10,'_________________________________________________________________________________________',0,1);
for($i=1;$i<=3;$i++)
    $pdf->Cell(0,10,' ',0,1);
$pdf->SetFont('Arial','',10);
$pdf->Cell(0,10,'Aclaracion y Firma: ' . $nombre . '                ___________________',0,1); 
$pdf->Cell(0,10,'Lugar: Ciudad Autonoma de Buenos Aires',0,1);
$pdf->Cell(0,10,'Fecha: ' . date("d/m/Y"),0,1);
$pdf->Output();
?>
