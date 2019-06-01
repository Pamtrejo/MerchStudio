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
		$sql = 'SELECT IdProductoxSucursal, producto.Diseno, producto.Descripcion, producto.Precio, tallas.Talla, sucursal.NomSucursal, cantidad
        FROM productoxsucursal INNER JOIN producto ON productoxsucursal.IdProducto = producto.IdProducto
        INNER JOIN tallas ON productoxsucursal.IdTalla = tallas.IdTalla
        INNER JOIN sucursal ON productoxsucursal.IdSucursal = sucursal.IdSucursal
        WHERE productoxsucursal.IdSucursal = ?';
		$params = array($this->idSucursal);
		return Database::getRows($sql, $params);
	}
}
?>