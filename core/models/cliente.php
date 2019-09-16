<?php
class Cliente extends Validator
{
	// Declaración de propiedades
	private $id = null;
    private $nombre = null;
    private $dui = null;
    private $direccion = null;

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
    
    public function setDui($value)
	{
		if ($this->validateAlphanumeric($value, 1, 50)) {
			$this->dui = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getDui()
	{
		return $this->dui;
    }

    public function setDireccion($value)
	{
		if ($this->validateAlphanumeric($value, 1, 50)) {
			$this->direccion = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getDireccion()
	{
		return $this->direccion;
    }

	
	// Metodos para el manejo del SCRUD
	public function readCliente()
	{
		$sql = 'SELECT IdCliente, NombreCliente, DUI, Direccion  FROM cliente ORDER BY NombreCliente';
		$params = array(null);
		return Database::getRows($sql, $params);
	}

	public function searchCliente($value)
	{
		$sql = 'SELECT * FROM cliente WHERE NombreCliente LIKE ? ORDER BY NombreCliente';
		$params = array("%$value%");
		return Database::getRows($sql, $params);
	}

	public function createCliente()
	{
		$sql = 'INSERT INTO cliente(IdCliente, NombreCliente, DUI, Direccion) VALUES(?, ?, ?, ?)';
		$params = array($this->id, $this->nombre, $this->dui, $this->direccion);
		return Database::executeRow($sql, $params);
	}

	public function getCliente1()
	{
		$sql = 'SELECT IdCliente, NombreCliente, DUI, Direccion FROM cliente WHERE IdCliente = ?';
		$params = array($this->id);
		return Database::getRow($sql, $params);
	}

	public function updateCliente()
	{
		$sql = 'UPDATE cliente SET  NombreCliente=?, DUI=?, Direccion=?  WHERE IdCliente = ?';
		$params = array($this->nombre, $this->dui, $this->direccion, $this->id);
		return Database::executeRow($sql, $params);
	}

	public function deleteCliente()
	{
		$sql = 'DELETE FROM cliente WHERE IdCliente = ?';
		$params = array($this->id);
		return Database::executeRow($sql, $params);
	}
//Para grafico
	public function ClienteLista()
	{
		$sql = 'SELECT * FROM cliente';
		$params = array(null);
		return Database::getRows($sql, $params);
	}

	public function cliente()
	{
		$sql = "SELECT C.Descripcion,cast(REPLACE(c.Precio,'$','') as decimal(3,2))*a.Cantidad  vendido FROM detalleventa a
		inner join productoxsucursal b on  a.IdProductoxSucursal=b.IdProductoxSucursal
		inner join producto c on b.IdProducto=c.IdProducto
		WHERE a.IdCliente=?";
		$params = array($this->id);
		return Database::getRows($sql, $params);
	}

		//reporte
		public function comprasxCliente()
		{
			$sql = 'SELECT cliente.NombreCliente, factura.Fecha, COUNT(detalleventa.IdDetalle) Compras
			from cliente, factura, detalleventa
			where cliente.IdCliente = detalleventa.IdCliente AND factura.IdFactura = detalleventa.IdFactura
			GROUP by factura.Fecha
			ORDER by factura.Fecha';
			$params = array(null);
			return Database::getRows($sql,$params);
		}
	
		//reporte aparece las mayores ventas con el usuario, la fecha, la venta y la cantidad de productos comprados
		public function ventatotalxCliente()
		{
			$sql = 'SELECT factura.IdFactura, cliente.NombreCliente, factura.Fecha, detalleventa.Venta
			from factura, detalleventa, cliente
			where factura.IdFactura = detalleventa.IdFactura and cliente.IdCliente = detalleventa.IdCliente and
			Fecha BETWEEN date_add(curdate(), INTERVAL -30 DAY) 
			AND CURDATE() group by factura.IdFactura
			order by detalleventa.Venta';
			$params = array(null);
			return Database::getRows($sql, $params);
		}
}
?>
