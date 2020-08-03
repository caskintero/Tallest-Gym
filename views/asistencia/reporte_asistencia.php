<?php
require("../../models/asistencia.class.php");
require('../fpdf/fpdf.php');
require('../fpdf/plantilla.php');
$objUtilidades=new utilidades;
$objAsistencia=new asistencia;
$con=$objUtilidades->conexion();
$ok=$objAsistencia->mostrar_asistencia($con);
$pdf = new PDF('L','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Cell(100);
    // Título

$pdf->SetFont('Arial','B',45);
$pdf->Cell(80,20,'Reporte de Asistencias',0,0,'C');
    // Salto de línea
$pdf->Ln(50);
$pdf->SetFont('Arial','B',20);
$pdf->Cell(20);
$pdf->Cell(75,10,'Fecha',1,0,'C',0); 
$pdf->Cell(75,10,'Cedula',1,0,'C',0);  
$pdf->Cell(75,10,'Nombre',1,1,'C',0);
$pdf->SetFont('Arial','',18);
while(($datos=mysqli_fetch_assoc($ok))>0)
  {
  	$pdf->Cell(20);
  	$pdf->Cell(75,10,$datos['fecha_asistencia'],1,0,'C',0); 
    $pdf->Cell(75,10,$datos['cedula'],1,0,'C',0);  
    $pdf->Cell(75,10,$datos['nombre'],1,1,'C',0);    
  }

$pdf->Output();
?>