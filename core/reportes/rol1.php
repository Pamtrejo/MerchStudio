<?php 
 require_once('../../core/reportes/rol.php');
require_once('../../core/models/usuarios.php');
ini_set('date.timezone','America/El_Salvador');
session_start();

$reporte= new Usuarios;

$pdf=new PDF2('P','mm','letter');
 
//Agregamos la primera pagina al documento pdf
$pdf->AddPage();
//Seteamos el inicio del margen superior en 25 pixeles
$pdf->SetMargins(15,15,15,15);

//Se pone el tipo de letra del reporte
$pdf->SetFont('Arial','B',10);
//Se crea una celda imaginaria 
$pdf->Cell(22,6,'',0,0,'C');
//especifica el color
$pdf->SetFillColor(222,196,196);
//se pone la fecha
$pdf->Cell(92,10,'Fecha: '.date("d/m/Y H:i:s"),0,0,'C',1);
//se pone el usuario
$pdf->Cell(68,10,'Usuario: Fernanda',0,0,'C',1);
//se pone el color
$pdf->SetFillColor(64,176,170);
//Se pone el tipo de letra del reporte
$pdf->SetFont('Arial','B',10);
//salto de 15 lineas
$pdf->Ln(15); 
//celda imaginaria para centrar 
$pdf->Cell(17);
//se crean los titulos de la tabla
$pdf->Cell(40,6,'Rol',1,0,'C',1);
$pdf->Cell(40,6,'Nombre',1,0,'C',1);
$pdf->Cell(40,6,'Apellido',1,0,'C',1);
$pdf->Cell(40,6,'NomUsuario',1,0,'C',1);
 
$pdf->Ln(10);
 
//Comienzo a crear las fiulas de productos según la consulta mysql
$datos = $reporte->reporteUsuariosRol();
foreach($datos as $fila)
{   
    $TipoRol = $fila['TipoRol'];
    $Nombre = $fila['Nombre'];
    $Apellido = $fila['Apellido'];
    $NomUsuario = $fila['NomUsuario'];
 
    $pdf->Cell(17);
    $pdf->Cell(40,15,$TipoRol,1,0,'C',0);
    $pdf->Cell(40,15,$Nombre,1,0,'C',0);
    $pdf->Cell(40,15,$Apellido,1,0,'C',0);
    $pdf->Cell(40,15,$NomUsuario,1,0,'C',0);
    //Se crea el salto de linea que va despues de cada produccto
    $pdf->Ln(15);
}
 
//Mostramos el documento pdf
$pdf->Output();
 
?>