<?php
class Usuarios extends Validator
{
	//Declaración de propiedades
	private $id = null;
	private $nombres = null;
	private $apellidos = null;
	private $correo = null;
	private $nomusuario = null;
	private $contrasena = null;
	private $vencimiento = null;
	private $rol = null;

	//Métodos para sobrecarga de propiedades
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

	public function setNombres($value)
	{
		if ($this->validateAlphabetic($value, 1, 50)) {
			$this->nombres = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getNombres()
	{
		return $this->nombres;
	}

	public function setApellidos($value)
	{
		if ($this->validateAlphabetic($value, 1, 50)) {
			$this->apellidos = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getApellidos()
	{
		return $this->apellidos;
	}

	public function setCorreo($value)
	{
		if ($this->validateEmail($value)) {
			$this->correo = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getCorreo()
	{
		return $this->correo;
	}

	public function setNomUsuario($value)
	{
		if ($this->validateAlphanumeric($value, 1, 50)) {
			$this->nomusuario = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getNomUsuario()
	{
		return $this->nomusuario;
	}

	public function setContrasena($value)
	{
		if ($this->validatePassword($value)) {
			$this->contrasena = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getContrasena()
	{
		return $this->contrasena;
	}

	public function setRol($value)
	{
		if ($this->validateId($value)) {
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

	public function setVencimiento($value)
	{
		if ($value) {
			$this->vencimiento = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getVencimiento()
	{
		return $this->vencimiento;
	}

    

    //Metodos para manejar los SCRUD

    public function checkNomUsuario()
	{
		$sql = 'SELECT IdUsuario, FechaVencimiento FROM usuario WHERE NomUsuario = ?';
		$params = array($this->nomusuario);
		$data = Database::getRow($sql, $params);
		if ($data) {
			$this->id = $data['IdUsuario'];
			$diferencia = date('Y-m-d H:i:s') - $data['FechaVencimiento'];
			if ($diferencia < 90) {
				$this->vencimiento = true;
			} else {
				$this->vencimiento = false;
			}
			return true;
		} else {
			return false;
		}
	}

	public function checkPassword()
	{
		$sql = 'SELECT contrasena FROM usuario WHERE idusuario = ?';
		$params = array($this->id);
		$data = Database::getRow($sql, $params);
		if (password_verify($this->contrasena, $data['contrasena'])){
			return true;
		} else {
			return false;
		}
	}

	public function changePassword()
	{
		$hash = password_hash($this->contrasena, PASSWORD_DEFAULT);
		$sql = 'UPDATE usuario SET contrasena = ? WHERE idusuario = ?';
		$params = array($hash, $this->id);
		return Database::executeRow($sql, $params);
	}

	// Metodos para manejar el SCRUD
	public function readUsuarios()
	{
		$sql = 'SELECT IdRol,Nombre,Apellido,NomUsuario,Contrasena,Correo,FechaVencimiento FROM usuario ORDER BY Apellido';
		$params = array(null);
		return Database::getRows($sql, $params);
	}

	public function searchUsuarios($value)
	{
		$sql = 'SELECT IdUsuario,IdRol,Nombre, Apellido, NomUsuario,Contrasena, Correo,FechaVencimiento FROM usuario WHERE Apellido LIKE ? OR Nombre LIKE ? ORDER BY Apellido';
	 $params = array("%$value%", "%$value%");
		return Database::getRows($sql, $params);
	}

	public function createUsuario()
	{
		$hash = password_hash($this->contrasena, PASSWORD_DEFAULT);
		$sql = 'INSERT INTO usuario(IdRol,Nombre,Apellido,NomUsuario,Contrasena,Correo,FechaVencimiento) VALUES(?, ?, ?, ?, ?,?,?)';
		$params = array($this->rol, $this->nombres, $this->apellidos, $this->nomusuario,$hash,$this->correo,$this->vencimiento);
		return Database::executeRow($sql, $params);
	}

	public function getUsuario()
	{
		$sql = 'SELECT IdRol,Nombre,Apellido,NomUsuario,Contrasena,Correo,FechaVencimiento FROM usuario WHERE IdUsuario = ?';
		$params = array($this->id);
		return Database::getRow($sql, $params);
	}

	public function updateUsuario()
	{
		$sql = 'UPDATE usuarios SET nombres_usuario = ?, apellidos_usuario = ?, correo = ?, nomusuario = ? WHERE id_usuario = ?';
		$params = array($this->nombres, $this->apellidos, $this->correo, $this->nomusuario, $this->id);
		return Database::executeRow($sql, $params);
	}

	public function deleteUsuario()
	{
		$sql = 'DELETE FROM usuarios WHERE id_usuario = ?';
		$params = array($this->id);
		return Database::executeRow($sql, $params);
    }
    
    public function ListaRol()
	{
		$sql = 'SELECT * FROM roles';
		$params = array(null);
		return Database::getRows($sql, $params);
	}

	//reporte
	public function reporteUsuariosRol()
	{
		$sql = 'SELECT TipoRol,Nombre, Apellido, NomUsuario 
		from usuario
		INNER JOIN roles USING(IdRol)
		ORDER BY TipoRol';
		$params = array(null);
		return Database::getRows($sql,$params);
	}
}
?>
