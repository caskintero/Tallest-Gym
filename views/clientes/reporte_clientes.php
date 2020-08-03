<?php
require("../../models/producto.class.php");
require('../fpdf/fpdf.php');
require('../fpdf/plantilla.php');
$objUtilidades=new utilidades;
$objProducto=new producto;
$con=$objUtilidades->conexion();
$ok=$objProducto->mostrar_producto($con);
$pdf = new PDF('L','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Cell(60);
    // Título
$pdf->Cell(55,10,'Reporte de Producto',0,0,'C');
    // Salto de línea
$pdf->Ln(20);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(50,10,'Codigo',1,0,'C',0); 
$pdf->Cell(50,10,'Nombre',1,0,'C',0);  
$pdf->Cell(50,10,'Unidad de medida',1,1,'C',0);
$pdf->SetFont('Arial','',14);
while(($datos=mysqli_fetch_assoc($ok))>0)
  {
  	$pdf->Cell(50,10,$datos['codigo_producto'],1,0,'C',0); 
    $pdf->Cell(50,10,$datos['nombre_producto'],1,0,'C',0);  
    $pdf->Cell(50,10,$datos['unidad_medida'],1,1,'C',0);    
  }

$pdf->Output();
?>