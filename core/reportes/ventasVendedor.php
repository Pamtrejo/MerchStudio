<?php
//se manda a llamar la libreria para que funcionen los reportes
require_once('../../libraries/fpdf/fpdf.php');
//se manda a llamar la conexion de la base de datos
require_once('../../core/helpers/database.php');
//se mandan a llamar las validaciones
require_once('../../core/helpers/validator.php');

class PDF2 extends FPDF
{
    function Header()
    {
    // seteamos el tipo de letra Arial Negrita 16
    $this->SetFont('Arial','B',16);
    //se pone el logo de la tienda, ultimo numero especifica el tamaño de la imagen, primer numero es para moverlo de manera horizontal
    $this->Image('../../resources/img/logo.png',10,10,58);
    //salto de 30 lineas
    $this->Ln(20);
    
    //se pone el color del tema del reporte
    $this->SetFillColor(222,196,196);
    //celda imaginaria para centrar el el titulo
    $this->Cell(22,10,'',0,0,'C');
    //se pone el nombre del reporte, el primer numero es el ancho del cada cuadro, la 'C' para centrar el texto
    $this->Cell(160,10,'Ventas realizadas por los vendedores',0,0,'C',1);
    
    // salta 12 lineas
    $this->Ln(15);
    }

    function Footer()
    {
        //Seteamos la posicion de la proxima celda en forma fija a 1.5cm del final de la pagina
        $this->SetY(-15);
        //Seteamos el tipo de letra Arial italica 10
        $this->SetFont('Arial','I',10);
        //Se pone el número de página
        $this->Cell(0,10,'Pagina '.$this->PageNo(),0,0,'C');
    }
    
}
?>