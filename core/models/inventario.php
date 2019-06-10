<?php
class Inventario extends Validator
{
    private $idSucursal = null;
    
    public function establecerIdSucursal($id)
    {
        if ($this->validateId($id)) {
			$this->idSucursal = $id;
			return true;
		} else {
			return false;
		}
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
}
?>