<?php
class usuarios extends Validator
{

    private $IdUsuario=null;
    private $IdRol=null;
    private $Nombre=null;
    private $Apellido=null;
    private $NomUsuario=null;
    private $Contrasena=null;
    private $Correo=null;

    //Metodos get y set

    public function setIdUsuario($value)
	{
		if ($this->validateId($value)) {
			$this->IdUsuario = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getIdUsuario()
	{
		return $this->IdUsuario;
	}

    public function setRol($value)
	{
		if ($this->validateId($value)) {
			$this->IdRol = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getRol()
	{
		return $this->IdRol;
    }
    
    public function setNombre($value)
	{
		if ($this->validateId($value)) {
			$this->Nombre = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getNombre()
	{
		return $this->Nombre;
    }
    
    public function setApellido($value)
	{
		if ($this->validateId($value)) {
			$this->Apellido = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getApellido()
	{
		return $this->Apellido;
    }
    
    public function setNomUsuario($value)
	{
		if ($this->validateId($value)) {
			$this->NomUsuario = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getNomUsuario()
	{
		return $this->NomUsuario;
    }
    
    public function setContrasena($value)
	{
		if ($this->validateId($value)) {
			$this->Contrasena = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getContrasena()
	{
		return $this->Contrasena;
    }
    
    public function setCorreo($value)
	{
		if ($this->validateId($value)) {
			$this->Correo = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getCorreo()
	{
		return $this->Correo;
    }
    

    //Metodos para manejar los SCRUD

    public function checkAlias()
	{
		$sql = 'SELECT idusuario FROM usuario WHERE nomusuario = ?';
		$params = array($this->NomUsuario);
		$data = Database::getRow($sql, $params);
		if ($data) {
			$this->id = $data['idusuario'];
			return true;
		} else {
			return false;
		}
	}

	public function checkPassword()
	{
		$sql = 'SELECT contrasena FROM usuario WHERE idusuario = ?';
		$params = array($this->IdUsuario);
		$data = Database::getRow($sql, $params);
		if (password_verify($this->Contrasena, $data['contrasena'])) {
			return true;
		} else {
			return false;
		}
	}

	public function changePassword()
	{
		$hash = password_hash($this->Contrasena, PASSWORD_DEFAULT);
		$sql = 'UPDATE usuario SET contrasena = ? WHERE idusuario = ?';
		$params = array($hash, $this->IdUsuario);
		return Database::executeRow($sql, $params);
	}

	// Metodos para manejar el SCRUD
	public function readUsuarios()
	{
		$sql = 'SELECT idusuario, idrol,nombre, apellido, nomusuario, contrasena,correo FROM usuario ORDER BY apellido';
		$params = array(null);
		return Database::getRows($sql, $params);
	}

	public function searchUsuarios($value)
	{
		$sql = 'SELECT idusuario,idrol,nombre, apellido, nomusuario,contrasena, correo FROM usuario WHERE apellido LIKE ? OR nombre LIKE ? ORDER BY apellido';
		$params = array("%$value%", "%$value%");
		return Database::getRows($sql, $params);
	}

	public function createUsuario()
	{
		$hash = password_hash($this->Contrasena, PASSWORD_DEFAULT);
		$sql = 'INSERT INTO usuario(idrol,nombre, apellido, nomusuario,contrasena,correo) VALUES(?, ?, ?, ?, ?,?)';
		$params = array($this->IdRol, $this->Nombre, $this->Apellido, $this->NomUsuario,$this->Contrasena,$this->Correo, $hash);
		return Database::executeRow($sql, $params);
	}

	public function getUsuario()
	{
		$sql = 'SELECT idusuario,idrol,nombre, apellido, nomusuario,contrasena, correo FROM usuario WHERE idusuario = ?';
		$params = array($this->IdUsuario);
		return Database::getRow($sql, $params);
	}

	public function updateUsuario()
	{
		$sql = 'UPDATE usuarios SET nombres_usuario = ?, apellidos_usuario = ?, correo_usuario = ?, alias_usuario = ? WHERE id_usuario = ?';
		$params = array($this->nombres, $this->apellidos, $this->correo, $this->alias, $this->id);
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
}
?>
