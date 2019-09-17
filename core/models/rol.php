<?php
class Rol extends Validator
{
	// Declaración de propiedades
	private $id = null;
	private $rol = null;
	private $atributos = null;
	

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

	public function setRol($value)
	{
		if ($this->validateAlphanumeric($value, 1, 50)) {
			$this->rol = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getRol()
	{
		return $this->rol;
	}

	public function setAtributos($value)
	{
		if ($this->validateAlphanumeric($value, 1, 50)) {
			$this->atributos = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getAtributos()
	{
		return $this->atributos;
	}

	

	
	// Metodos para el manejo del SCRUD
	public function readRol()
	{
		$sql = 'SELECT IdRol, TipoRol,atributos  FROM roles ORDER BY TipoRol';
		$params = array(null);
		return Database::getRows($sql, $params);
	}

	public function searchRol($value)
	{
		$sql = 'SELECT * FROM roles WHERE TipoRol LIKE ? ORDER BY TipoRol';
		$params = array("%$value%");
		return Database::getRows($sql, $params);
	}

	public function createRol()
	{
		$sql = 'INSERT INTO roles(IdRol, TipoRol,atributos) VALUES(?, ?,?)';
		$params = array($this->id, $this->rol, $this->atributos);
		return Database::executeRow($sql, $params);
	}

	public function getRol1()
	{
		$sql = 'SELECT IdRol, TipoRol FROM roles WHERE IdRol = ?';
		$params = array($this->id);
		return Database::getRow($sql, $params);
	}

	public function updateRol()
	{
		$sql = 'UPDATE roles SET  TipoRol=?,  atributos=? WHERE IdRol = ?';
		$params = array($this->rol, $this->id, $this->atributos);
		return Database::executeRow($sql, $params);
	}

	public function deleteRol()
	{
		$sql = 'DELETE FROM roles WHERE IdRol = ?';
		$params = array($this->id);
		return Database::executeRow($sql, $params);
	}
}
?>
