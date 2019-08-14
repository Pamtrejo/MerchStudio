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
		group by ps.IdCategoria;';
		$params = array(1);
		return Database::getRows($sql, $params);
	}
}
?>
