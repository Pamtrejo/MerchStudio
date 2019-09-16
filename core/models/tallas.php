<?php
class Talla extends Validator
{
	// Declaración de propiedades
	private $id = null;
    private $talla = null;

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

    public function setTalla($value)
	{
		if ($this->validateAlphabetic($value, 1, 50)) {
			$this->talla = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getTalla()
	{
		return $this->talla;
    }
    
// Metodos para el manejo del SCRUD
public function readTalla()
{
    $sql = 'SELECT IdTalla, Talla FROM tallas ORDER BY IdTalla';
    $params = array(null);
    return Database::getRows($sql, $params);
}

}
?>