<?php
class Vendedor extends Validator
{
    private $id = null;
    private $nombre = null;
    private $telefono = null;

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

    public function setNombre($value)
	{
		if ($this->validateAlphabetic($value, 1, 50)) {
			$this->nombre = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getNombre()
	{
		return $this->nombre;
    }
    
    public function setTelefono($value)
	{
		if ($this->validateAlphanumeric($value, 1, 50)) {
			$this->telefono = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getTelefono()
	{
		return $this->telefono;
    }

    public function readVendedor()
	{
		$sql = 'SELECT IdVendedor, NombreVendedor, Telefono  FROM vendedor ORDER BY NombreVendedor';
		$params = array(null);
		return Database::getRows($sql, $params);
	}

	public function searchVendedor($value)
	{
		$sql = 'SELECT * FROM vendedor WHERE NombreVendedor LIKE ? ORDER BY NombreVendedor';
		$params = array("%$value%");
		return Database::getRows($sql, $params);
	}

	public function createVendedor()
	{
		$sql = 'INSERT INTO vendedor(IdVendedor, NombreVendedor, Telefono) VALUES(?, ?, ?)';
		$params = array($this->id, $this->nombre, $this->telefono);
		return Database::executeRow($sql, $params);
	}

	public function getVendedor1()
	{
		$sql = 'SELECT IdVendedor, NombreVendedor, Telefono FROM vendedor WHERE IdVendedor = ?';
		$params = array($this->id);
		return Database::getRow($sql, $params);
	}

	public function updateVendedor()
	{
		$sql = 'UPDATE vendedor SET  NombreVendedor=?, Telefono=? WHERE IdVendedor = ?';
		$params = array($this->nombre, $this->telefono, $this->id);
		return Database::executeRow($sql, $params);
	}

	public function deleteVendedor()
	{
		$sql = 'DELETE FROM vendedor WHERE IdVendedor = ?';
		$params = array($this->id);
		return Database::executeRow($sql, $params);
	}

	public function VendedorLista()
	{
		$sql = 'SELECT * FROM vendedor';
		$params = array(null);
		return Database::getRows($sql, $params);
	}

	public function vendedor()
	{
		$sql = "SELECT C.Descripcion,cast(REPLACE(c.Precio,'$','') as decimal(3,2))*a.Cantidad venta FROM detalleventa a
		inner join productoxsucursal b on  a.IdProductoxSucursal=b.IdProductoxSucursal
		inner join producto c on b.IdProducto=c.IdProducto
		WHERE a.IdVendedor=?";
		$params = array($this->id);
		return Database::getRows($sql, $params);
	}

	//reporte
	public function reporteVendedorVentas()
	{
		$sql = 'SELECT vendedor.NombreVendedor,vendedor.Telefono, COUNT(factura.IdFactura) Cantidad
		FROM vendedor, factura, detalleventa 
		WHERE vendedor.IdVendedor = factura.IdVendedor and factura.IdFactura = detalleventa.IdFactura
		GROUP BY vendedor.NombreVendedor
		ORDER BY Cantidad DESC';
		$params = array(null);
		return Database::getRows($sql, $params);
	}

}
?>
