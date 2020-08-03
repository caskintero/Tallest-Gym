<?php 

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    ini_set('date.timezone','America/Caracas');
    $fecha= date('d/m/Y',time());
    // Logo
    $this->Image('../images/icono.jpg',30,20,45);
    // Arial bold 15
    $this->SetFont('Arial','B',18);
    // Movernos a la derecha
    $this->Cell(100);
    // Título
    $this->SetFont('Arial','B',30);
    $this->Cell(55,10,utf8_decode('Talle´s GYM'),0,0,'C');
    // Salto de línea
    $this->Cell(20);
    // Título
    $this->Cell(85,10,$fecha,0,0,'C');
    // Salto de línea
    $this->Ln(30);

    
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}

?>