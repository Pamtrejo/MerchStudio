<?php
class Sucursal extends Validator
{
	// Declaración de propiedades
	private $id = null;
    private $sucursal = null;
    private $direccion = null;
    private $telefono = null;

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

    public function setSucursal($value)
	{
		if ($this->validateAlphabetic($value, 1, 50)) {
			$this->sucursal = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getSucursal()
	{
		return $this->sucursal;
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

	
	// Metodos para el manejo del SCRUD
	public function readSucursal()
	{
		$sql = 'SELECT IdSucursal, NomSucursal, Direccion, Telefono  FROM sucursal ORDER BY NomSucursal';
		$params = array(null);
		return Database::getRows($sql, $params);
	}

	public function searchSucursal($value)
	{
		$sql = 'SELECT * FROM sucursal WHERE NomSucursal LIKE ? ORDER BY NomSucursal';
		$params = array("%$value%");
		return Database::getRows($sql, $params);
	}

	public function createSucursal()
	{
		$sql = 'INSERT INTO sucursal(IdSucursal, NomSucursal, Direccion, Telefono) VALUES(?, ?, ?, ?)';
		$params = array($this->id, $this->sucursal, $this->direccion, $this->telefono);
		return Database::executeRow($sql, $params);
	}

	public function getSucursal1()
	{
		$sql = 'SELECT IdSucursal, NomSucursal, Direccion, Telefono FROM sucursal WHERE IdSucursal = ?';
		$params = array($this->id);
		return Database::getRow($sql, $params);
	}

	public function updateSucursal()
	{
		$sql = 'UPDATE sucursal SET  NomSucursal=?, Direccion=?, Telefono=?  WHERE IdSucursal = ?';
		$params = array($this->sucursal, $this->direccion, $this->telefono, $this->id);
		return Database::executeRow($sql, $params);
	}

	public function deleteSucursal()
	{
		$sql = 'DELETE FROM sucursal WHERE IdSucursal = ?';
		$params = array($this->id);
		return Database::executeRow($sql, $params);
	}


	public function ListaSucursal()
	{
		$sql = 'SELECT * FROM sucursal';
		$params = array(null);
		return Database::getRows($sql, $params);
	}

	public function CantidadProductoSucursal()
	{
		$sql = 'select c.IdCategoria, c.Categoria, sum(ps.Cantidad) cantidad from  productoxsucursal ps
		inner join categoria c on c.IdCategoria = ps.IdCategoria 
		WHERE ps.IdSucursal = ?
		group by ps.IdCategoria';
		$params = array($this->id);
		return Database::getRows($sql, $params);
	}

	public function CategoriaLista()
	{
		$sql = 'SELECT * FROM categoria';
		$params = array(null);
		return Database::getRows($sql, $params);
	}

	public function Cantidad()
	{
		$sql = 'select s.NomSucursal Sucursal, sum(v.Cantidad) Cantidad, sum(v.Cantidad * pro.Precio) Total from detalleventa v
		inner join productoxsucursal p
		on v.IdProductoxSucursal = p.IdProductoxSucursal
		inner join categoria c on c.IdCategoria = p.IdCategoria
		inner join sucursal s on s.IdSucursal = p.IdSucursal
		inner join producto pro on pro.IdProducto = p.IdProducto
		where c.IdCategoria = ?
		group by p.IdSucursal';
		$params = array($this->id);
		return Database::getRows($sql, $params);
	}
	
	//reporte
	public function ventasxSucursal($value)
	{
		$sql = 'SELECT factura.Fecha,producto.Diseno, detalleventa.Cantidad, detalleventa.Venta, sucursal.NomSucursal
		from factura, producto, detalleventa, sucursal, productoxsucursal
		where factura.IdFactura = detalleventa.IdFactura and producto.IdProducto = productoxsucursal.IdProducto 
		and sucursal.IdSucursal = productoxsucursal.IdSucursal and sucursal.IdSucursal= ?
		GROUP by factura.IdFactura
		order by factura.Fecha';
		$params = array($value);
		return Database::getRows($sql,$params);
	}
	//muestra los porductos existentes en cada sucursal con su precio, talla, cantidad, descripcion y el nombre de la sucursal
	public function productosxSucursal($value)
	{
		$sql = 'SELECT producto.Diseno, categoria.Categoria, producto.Precio, tallas.Talla, productoxsucursal.Cantidad, sucursal.NomSucursal
		from producto, productoxsucursal, tallas, sucursal, categoria
		WHERE productoxsucursal.IdProducto = producto.IdProducto AND tallas.IdTalla = productoxsucursal.IdTalla
		and sucursal.IdSucursal = productoxsucursal.IdSucursal  AND sucursal.IdSucursal = ?  
		and categoria.IdCategoria =   producto.IdCategoria
		ORDER BY sucursal.NomSucursal';
		$params = array($value);
		return Database::getRows($sql,$params);
	}
}
?>

