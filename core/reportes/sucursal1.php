<?php 
 
require('../../core/reportes/sucursal.php');
require('../../core/models/sucursal.php');
//se obtiene la fecha y hora del pais 
ini_set('date.timezone','America/El_Salvador');

//se manda a llamar el modelo a utilizar
$reporte= new Sucursal;
//se manda a llamar la clase, en la cual se encuentra el encabezado y pie de pagina del reporte(productosxTalla.php)
$pdf=new PDF2('P','mm','letter');
 
//Agregamos la primera pagina al documento pdf
$pdf->AddPage();
//Seteamos los margenes en 15 pixeles
$pdf->SetMargins(15,15,15,15);
//Seteamos el tipo de letra y creamos el titulo de la pagina. No es un encabezado no se repetira
$pdf->SetFont('Arial','B',12);
//Se crea un celda en blanco para centrar el titulo
$pdf->Cell(22);
//se pone el color a utilizar para la fecha y el usuario
$pdf->SetFillColor(222,196,196);
//se pone la fecha
$pdf->Cell(78,10,'Fecha: '.date("d/m/Y H:i:s"),0,0,'C',1);
//se pone el usuario
$pdf->Cell(67,10,'Usuario: Fernanda ',0,0,'C',1);
//es el salto de linea
$pdf->Ln(18);
//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
$pdf->SetFillColor(64,176,170);
//Se especifica el tipo de letra 
$pdf->SetFont('Arial','B',10);
//Se crea una celda sin nada para centrar los titulos de la tabla
$pdf->Cell(17);
//se crean los titulos de la tabla, el primer numero es el ancho de la celda, el segundo es la altura
$pdf->Cell(35,6,'Diseno',1,0,'C',1);
$pdf->Cell(20,6,'Categoria',1,0,'C',1);
$pdf->Cell(20,6,'Precio',1,0,'C',1);
$pdf->Cell(20,6,'Talla',1,0,'C',1);
$pdf->Cell(25,6,'Cantidad',1,0,'C',1);
$pdf->Cell(25,6,'NomSucursal',1,0,'C',1);
//salto de 10 lineas
$pdf->Ln(10);
 
//Comienzo a crear las filas de productos según la consulta mysql
//la variable 'talla' se obtiene del controlador 'sucursal1' para el uso del combobox
//ventasxpago es la funcion por la cual se crea la consulta a la base de datos, ubicada en los modelos
$datos = $reporte->productosxSucursal($_GET['sucursales']);
//el foreach se repetira hasta que no se encuentren mas datos
foreach($datos as $fila)
{
    //se obtienen los datos
    $Diseno = $fila['Diseno'];
    $Categoria = $fila['Categoria'];
    $Precio = $fila['Precio'];
    $Talla = $fila['Talla'];
    $Cantidad = $fila['Cantidad'];
    $NomSucursal = $fila['NomSucursal'];
    //celda imaginaria para centrar los datos de la tabla
    $pdf->Cell(17);
    //ultimo numero pone color a la celda
    //se imprimimen los datos
    $pdf->Cell(35,15,$Diseno,1,0,'C',0);
    $pdf->Cell(20,15,$Categoria,1,0,'C',0);
    $pdf->Cell(20,15,$Precio,1,0,'C',0);
    $pdf->Cell(20,15,$Talla,1,0,'C',0);
    $pdf->Cell(25,15,$Cantidad,1,0,'C',0);
    $pdf->Cell(25,15,$NomSucursal,1,0,'C',0);                                
    //Se crea el salto de linea que va despues de cada produccto
    $pdf->Ln(15);
 
}
;
//Mostramos el documento pdf
$pdf->Output();
?>