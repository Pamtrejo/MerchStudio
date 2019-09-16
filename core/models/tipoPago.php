<?php
class TipoPago extends Validator
{
	// Declaración de propiedades
	private $id = null;
    private $tipoPago = null;

	// Métodos para sobrecarga de propiedades
	public function setId($value)
	{
		if ($this->validateId($value)) {
			$this->id = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getId()
	{
		return $this->id;
	}

    public function seTipoPago($value)
	{
		if ($this->validateAlphabetic($value, 1, 50)) {
			$this->tipoPago = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getTipoPago()
	{
		return $this->tipoPago;
    }
    
// Metodos para el manejo del SCRUD
public function readTipoPago()
{
    $sql = 'SELECT IdPago, TipoPago FROM pago ORDER BY TipoPago';
    $params = array(null);
    return Database::getRows($sql, $params);
}

//reporte de las ventas hechas por dia
public function ventasDia()
{
	$sql = 'SELECT sucursal.NomSucursal, producto.Diseno , vendedor.NombreVendedor, 
	detalleventa.Cantidad, detalleventa.Venta
	from detalleventa, producto, vendedor, pago, factura, productoxsucursal, sucursal
	where factura.IdFactura = detalleventa.IdFactura and producto.IdProducto = productoxsucursal.IdProducto 
	and pago.IdPago = factura.IdPago and sucursal.IdSucursal = productoxsucursal.IdSucursal and factura.Fecha = CURDATE()
	GROUP by detalleventa.IdFactura';
	$params = array(null);
	return Database::getRows($sql,$params);
}

}
?>