<?php
require("../../models/usuarios.class.php");
require('../fpdf/fpdf.php');
require('../fpdf/plantilla.php');
$objUtilidades=new utilidades;
$objUsuario=new usuario;
$con=$objUtilidades->conexion();
$ok=$objUsuario->mostrar_usuarios($con);
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Cell(60);
    // Título
$pdf->Cell(55,10,'Reporte de Usuarios',0,0,'C');
    // Salto de línea
$pdf->Ln(20);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(25,10,'Cedula',1,0,'C',0); 
$pdf->Cell(25,10,'Nombre',1,0,'C',0);  
$pdf->Cell(25,10,'Apellido',1,0,'C',0);
$pdf->Cell(25,10,'Telefono',1,0,'C',0);
$pdf->Cell(50,10,'Email',1,0,'C',0);
$pdf->Cell(45,10,'Direccion',1,1,'C',0);
$pdf->SetFont('Arial','',10);
while(($datos=mysqli_fetch_assoc($ok))>0)
  {
  	$pdf->Cell(25,10,$datos['cedula'],1,0,'C',0); 
    $pdf->Cell(25,10,$datos['nombre'],1,0,'C',0);  
    $pdf->Cell(25,10,$datos['apellido'],1,0,'C',0);
    $pdf->Cell(25,10,$datos['telefono'],1,0,'C',0);
    $pdf->Cell(50,10,$datos['correo_elec'],1,0,'C',0);
    $pdf->Cell(45,10,$datos['direccion'],1,1,'C',0);    
  }

$pdf->Output();
?>