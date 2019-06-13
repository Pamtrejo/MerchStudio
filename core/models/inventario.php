<?php
class Inventario extends Validator
{
	private $idSucursal = null;
	private $idProducto = null;
	private $precio = null;
	private $idCategoria = null;
	private $diseno = null;
	private $descripcion = null;

	//Metodos get y set
	public function establecerIdSucursal($id)
	{
		if ($this->validateId($id)) {
			$this->idSucursal = $id;
			return true;
		} else {
			return false;
		}
	}

	public function fijarIdProducto($value)
	{
		if ($this->validateId($value)) {
			$this->idProducto = $value;
			return true;
		} else {
			return false;
		}
	}

	public function recibirIdProducto()
	{
		return $this->idProducto;
	}

	public function fijarPrecio($value)
	{
		if ($this->validateMoney($value)) {
			$this->precio = $value;
			return true;
		} else {
			return false;
		}
	}

	public function recibirPrecio()
	{
		return $this->precio;
	}

	public function fijarCategoria($value)
	{
		if ($this->validateId($value)) {
			$this->idCategoria = $value;
			return true;
		} else {
			return false;
		}
	}

	public function recibirIdCategoria()
	{
		return $this->categoria;
	}

	public function fijarDiseno($value)
	{
		if ($this->validateAlphanumeric($value, 1, 50)) {
			$this->diseno = $value;
			return true;
		} else {
			return false;
		}
	}

	public function recibirDiseno()
	{
		return $this->diseno;
	}
	public function fijarDescripcion($value)
	{
		if ($this->validateAlphanumeric($value, 1, 200)) {
			$this->descripcion = $value;
			return true;
		} else {
			return false;
		}
	}

	public function recibirDescripcion()
	{
		return $this->descripcion;
	}

	//Metodos para manejar el CRUD
	public function cargarCamisetasSucursal()
	{
		$sql = "SELECT productoxsucursal.IdProductoxSucursal, producto.idproducto, producto.Diseno, producto.Descripcion, producto.Precio, tallas.Talla, sucursal.NomSucursal, cantidad
		from producto LEFT JOIN productoxsucursal ON productoxsucursal.IdProducto = producto.IdProducto
		AND productoxsucursal.IdSucursal = ?
		LEFT JOIN tallas ON productoxsucursal.IdTalla = tallas.IdTalla
		LEFT JOIN sucursal ON productoxsucursal.IdSucursal = sucursal.IdSucursal
		order BY producto.idproducto asc";
		$params = array($this->idSucursal);
		return Database::getRows($sql, $params);
	}

	public function buscarCamisetaPorNombre($buscar)
	{
		$sql = "SELECT productoxsucursal.IdProductoxSucursal, producto.idproducto, producto.Diseno, producto.Descripcion, producto.Precio, tallas.Talla, sucursal.NomSucursal, cantidad
		from producto LEFT JOIN productoxsucursal ON productoxsucursal.IdProducto = producto.IdProducto
		AND productoxsucursal.IdSucursal = ?
		LEFT JOIN tallas ON productoxsucursal.IdTalla = tallas.IdTalla
		LEFT JOIN sucursal ON productoxsucursal.IdSucursal = sucursal.IdSucursal
		WHERE REPLACE(producto.Diseno, ' ', '') like ?
		OR REPLACE(producto.Descripcion, ' ', '') like ?
		order BY producto.idproducto asc";
		$params = array($this->idSucursal, '%' . $buscar . '%', '%' . $buscar . '%');
		return Database::getRows($sql, $params);
	}

	public function createProducto()
	{
		$sql = 'INSERT INTO producto(precio, idCategoria, diseno, descripcion) VALUES(?, ?, ?, ?)';
		$params = array($this->precio, $this->idCategoria, $this->diseno, $this->descripcion);
		return Database::executeRow($sql, $params);
	}
	public function getProducto()
	{
		$sql = 'SELECT idproducto, precio, idcategoria, diseno, descripcion FROM producto WHERE idproducto = ?';
		$params = array($this->idProducto);
		return Database::getRow($sql, $params);
	}
	public function ListaCategorias()
	{
		$sql = 'SELECT * FROM categoria';
		$params = array(null);
		return Database::getRows($sql, $params);
	}
	public function deleteProducto()
	{
		$sql = 'DELETE FROM producto WHERE idproducto = ?';
		$params = array($this->idProducto);
		return Database::executeRow($sql, $params);
	}

	public function updateProducto()
	{
		$sql = 'UPDATE producto SET precio = ?, idcategoria= ?, diseno = ?, descripcion = ? WHERE idproducto = ?';
		$params = array($this->precio, $this->idCategoria, $this->diseno, $this->descripcion, $this->idProducto);
		return Database::executeRow($sql, $params);
	}
}
