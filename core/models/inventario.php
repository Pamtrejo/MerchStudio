<?php
class Inventario extends Validator
{
	private $idSucursal = null;
	private $idProducto = null;
	private $precio = null;
	private $idCategoria = null;
	private $diseno = null;
	private $idtalla = null;
	private $idproductoxsucursal = null;
	private $cantidad = null;
	

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
	
	public function fijarIdProductoxSucursal($value)
	{
		if ($this->validateId($value)) {
			$this->idproductoxsucursal = $value;
			return true;
		} else {
			return false;
		}
	}

	public function recibirIdProductoxSucursal()
	{
		return $this->idproductoxsucursal;
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

	public function fijarTalla($value)
	{
		if ($this->validateId($value)) {
			
			$this->idtalla = $value;
			return true;
		} else {
			return false;
		}
	}

	public function recibirIdTalla()
	{
		return $this->talla;
	}

	public function fijarCantidad($value)
	{
		if ($this->validateMoney($value)) {
			$this->cantidad = $value;
			return true;
		} else {
			return false;
		}
	}

	public function recibirCantidad()
	{
		return $this->cantidad;
	}

	//Metodos para manejar el CRUD
	public function cargarCamisetasSucursal()
	{
		$sql = "SELECT IdProductoxSucursal, productoxsucursal.IdProducto, productoxsucursal.IdTalla , 
		producto.Diseno, producto.Precio , producto.Descripcion, productoxsucursal.IdSucursal,
		sucursal.NomSucursal, productoxsucursal.Cantidad as 'cantidad', 
		tallas.Talla
		FROM `productoxsucursal` INNER JOIN producto USING(IdProducto) 
		INNER JOIN tallas USING(IdTalla) INNER JOIN sucursal USING(IdSucursal)
		WHERE productoxsucursal.IdSucursal = ?
		ORDER BY productoxsucursal.IdProducto, productoxsucursal.IdTalla ASC";
		$params = array($this->idSucursal);
		return Database::getRows($sql, $params);
	}
	public function cargarCamisetasSucursalTodas()
	{
		$sql = "SELECT IdProductoxSucursal, productoxsucursal.IdProducto, productoxsucursal.IdTalla , 
		producto.Diseno, producto.Precio , producto.Descripcion, productoxsucursal.IdSucursal,
		sucursal.NomSucursal, productoxsucursal.Cantidad as 'cantidad', 
		tallas.Talla
		FROM `productoxsucursal` INNER JOIN producto USING(IdProducto) 
		INNER JOIN tallas USING(IdTalla) INNER JOIN sucursal USING(IdSucursal)
		ORDER BY productoxsucursal.IdProducto, productoxsucursal.IdTalla ASC";
		$params = array();
		return Database::getRows($sql, $params);
	}
	public function cargarSucursalTodas()
	{
		$sql = "SELECT IdSucursal, NomSucursal FROM sucursal ORDER BY IdSucursal ASC";
		$params = array();
		return Database::getRows($sql, $params);
	}

	public function cargarCamisetasTallas()
	{
		$sql = "SELECT IdProductoxSucursal, productoxsucursal.IdProducto, productoxsucursal.IdTalla , 
		producto.Diseno, producto.Precio , producto.Descripcion, productoxsucursal.IdSucursal,
		sucursal.NomSucursal, SUM(productoxsucursal.Cantidad) as 'cantidad', 
		tallas.Talla
		FROM `productoxsucursal` INNER JOIN producto USING(IdProducto) 
		INNER JOIN tallas USING(IdTalla) INNER JOIN sucursal USING(IdSucursal)
		WHERE productoxsucursal.IdSucursal = ? and productoxsucursal.IdProducto = ?
		GROUP BY tallas.IdTalla 
		ORDER BY productoxsucursal.IdProducto, tallas.Talla  ASC";
		$params = array($this->idSucursal,$this->idProducto);
		return Database::getRows($sql, $params);
	}
	public function cargarCamisetasTallasT()
	{
		$sql = "SELECT IdProductoxSucursal, productoxsucursal.IdProducto, productoxsucursal.IdTalla , 
		producto.Diseno, producto.Precio , producto.Descripcion, productoxsucursal.IdSucursal,
		sucursal.NomSucursal, SUM(productoxsucursal.Cantidad) as 'cantidad', 
		tallas.Talla
		FROM `productoxsucursal` INNER JOIN producto USING(IdProducto) 
		INNER JOIN tallas USING(IdTalla) INNER JOIN sucursal USING(IdSucursal)
		WHERE productoxsucursal.IdProducto = ?
		GROUP BY tallas.IdTalla 
		ORDER BY productoxsucursal.IdProducto, tallas.Talla  ASC";
		$params = array($this->idProducto);
		return Database::getRows($sql, $params);
	}
	public function buscarCamisetaPorNombre($buscar)
	{
		$sql = "SELECT IdProductoxSucursal, productoxsucursal.IdProducto, productoxsucursal.IdTalla , 
		producto.Diseno, producto.Precio , producto.Descripcion, productoxsucursal.IdSucursal,
		sucursal.NomSucursal, productoxsucursal.Cantidad as 'cantidad', 
		tallas.Talla
		FROM `productoxsucursal` INNER JOIN producto USING(IdProducto) 
		INNER JOIN tallas USING(IdTalla) INNER JOIN sucursal USING(IdSucursal)
		WHERE producto.Diseno like ?
		ORDER BY productoxsucursal.IdProducto, productoxsucursal.IdTalla ASC";
		$params = array('%' . $buscar . '%');
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
	public function deleteProducto2()
	{
		$sql = 'DELETE FROM productoxsucursal WHERE idproducto = ?';
		$params = array($this->idProducto);
		return Database::executeRow($sql, $params);
	}
	public function restar()
	{
		$sql = 'UPDATE productoxsucursal SET cantidad = cantidad - ? WHERE IdProductoxSucursal = ?';
		$params = array($this->cantidad, $this->idSucursal);
		return Database::executeRow($sql, $params);
	}

	public function updateProducto()
	{
		$sql = 'UPDATE producto SET precio = ?, idcategoria= ?, diseno = ?, descripcion = ? WHERE idproducto = ?';
		$params = array($this->precio, $this->idCategoria, $this->diseno, $this->descripcion, $this->idProducto);
		return Database::executeRow($sql, $params);
	}

	public function ListaProducto()
	{
		$sql = 'SELECT IdProducto, Diseno FROM  producto';
		$params = array(null);
		return Database::getRows($sql, $params);
	}

	public function ListaTalla()
	{
		$sql = 'SELECT * FROM tallas';
		$params = array(null);
		return Database::getRows($sql, $params);
	}

	public function ListaSucursal()
	{
		$sql = 'SELECT * FROM sucursal';
		$params = array(null);
		return Database::getRows($sql, $params);
	}

	public function createProductoxSucursal()
	{
		$sql = 'INSERT INTO productoxsucursal(idproducto, IdTalla, idsucursal, cantidad) VALUES(?, ?, ?, ?)';
		$params = array($this->idProducto, $this->idtalla, $this->idSucursal, $this->cantidad);
		return Database::executeRow($sql, $params);
	}
}