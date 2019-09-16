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

	public function ListaProducto()
	{
		$sql = 'SELECT IdCategoria, Diseno FROM  producto';
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

	//Metodos para graficos
	public function cantidadProductosCategoria()
	{
		$sql = 'SELECT Categoria, COUNT(IdProducto) cantidad 
		FROM producto INNER JOIN categoria USING(IdCategoria) GROUP BY IdCategoria';
		$params = array(null);
		return Database::getRows($sql, $params);
	}


	public function MontoporCategoria()
	{
		$sql = 'SELECT SUM(venta_total) cantidad , nombre_categoria  FROM `detalle_venta` INNER JOIN (productos) USING (id_producto) INNER JOIN (categorias) USING (id_categoria) GROUP BY id_categoria';
		$params = array(null);
		return Database::getRows($sql, $params);
	}


	public function VentaporFecha()
	{
		$sql = 'SELECT COUNT(`IdVenta`) cantidad, `fecha` FROM venta GROUP BY day(fecha) LIMIT 3';
		$params = array(null);
		return Database::getRows($sql, $params);
	}

	public function TallasVendidas()
	{
		$sql = 'SELECT tallas.Talla, COUNT(detalleventa.IdProductoxSucursal)Cantidad
		FROM tallas INNER JOIN productoxsucursal ON tallas.IdTalla = productoxsucursal.IdTalla
		INNER JOIN detalleventa ON productoxsucursal.IdProductoxSucursal = detalleventa.IdProductoxSucursal
		GROUP BY detalleventa.IdProductoxSucursal 
		ORDER BY `Cantidad`  ASC LIMIT 3';
		$params = array(null);
		return Database::getRows($sql, $params);
	}

	public function CategoriasVendidas()
	{
		$sql = 'SELECT categoria.Categoria, COUNT(detalleventa.IdProductoxSucursal)Cantidad
		FROM categoria INNER JOIN productoxsucursal ON categoria.IdCategoria = productoxsucursal.IdCategoria
		INNER JOIN detalleventa ON productoxsucursal.IdProductoxSucursal = detalleventa.IdProductoxSucursal
		GROUP BY detalleventa.IdProductoxSucursal
		ORDER BY Cantidad DESC LIMIT 3';
		$params = array(null);
		return Database::getRows($sql, $params);
	}

	public function CategoriasVentas()
	{
		$sql = 'SELECT SUM(Venta) cantidad , Categoria  FROM `detalleventa` INNER JOIN (productoxsucursal)
		USING (IdProductoxSucursal) INNER JOIN (categoria) 
		USING (IdCategoria) GROUP BY IdCategoria
		ORDER BY cantidad DESC';
		$params = array(null);
		return Database::getRows($sql, $params);
	}

	//reporte
	public function productosxTalla($value)
	{
		$sql = 'SELECT  tallas.Talla, producto.Diseno, productoxsucursal.Cantidad, sucursal.NomSucursal
		from producto, productoxsucursal, tallas, sucursal
		where producto.IdProducto = productoxsucursal.IdProducto AND tallas.IdTalla = productoxsucursal.IdTalla 
		and sucursal.IdSucursal = productoxsucursal.IdSucursal and productoxsucursal.IdTalla = ?';
		$params = array($value);
		return Database::getRows($sql,$params);
	}
	//reporte
	public function ventasxPago($value)
	{
		$sql = 'SELECT pago.TipoPago, factura.Fecha, detalleventa.Venta
		from pago, factura, detalleventa
		where pago.IdPago = factura.IdPago and factura.IdFactura = detalleventa.IdFactura
		and pago.IdPago= ?';
		$params = array($value);
		return Database::getRows($sql,$params);
	}


}
