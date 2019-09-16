<?php
class Categorias extends Validator
{
	// Declaración de propiedades
	private $id = null;
    private $categoria = null;
    private $descripcion = null;

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

    public function setCategoria($value)
	{
		if ($this->validateAlphabetic($value, 1, 50)) {
			$this->categoria = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getCategoria()
	{
		return $this->Categroia;
    }
    
    public function setDescripcion($value)
	{
		if ($this->validateAlphabetic($value, 1, 50)) {
			$this->descripcion = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getDescripcion()
	{
		return $this->Descripcion;
    }


//reporte de las ventas hechas por dia
public function ListaCategorias(){
    $sql='SELECT IdCategoria, Categoria FROM categoria 
    order by IdCategoria';
    $params= array(null);
    return Database::getRows($sql,$params);
}
//reporte
public function reporteCategorias($value){
	$sql= 'SELECT Diseno, Precio, producto.Descripcion
	 from producto INNER JOIN categoria USING(IdCategoria) WHERE IdCategoria= ?';
	$params= array($value);
	return Database::getRows($sql,$params);
}


}
?>