<?php

use PHPMailer\PHPMailer\PHPMailer;

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
	private $codigoValidacion = null;

	
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

	public function setCodigo($value)
	{
		if ($this->validateId($value)) {
			$this->codigoValidacion = $value;
			return true;
		} else {
			return false;
		}
	}

	//metodos para poder hacer lo de la doble autenticacion 
	public function iniciarSesion(){
        $retorno=0;
        $sql = 'SELECT `IDFactor` FROM `doblefactor` WHERE `Usuario`=? ';
        $params = array($this->id);
        $existe= Database::getRow($sql, $params);
        if(!$existe){

            $random=rand(10000,99999);
           
		   if( $this->enviarEmail($random)){
			$sql = 'INSERT INTO `doblefactor`(`IDFactor`, `Usuario`, `Codigo`, `SesionActiva`, `Bloqueo`, `FechaDesbloqueo`, `FechaCreacion`) VALUES (null,?,?,?,?,?,?)';
            $params = array($this->id,$random,0,0,null,date('Y-m-d G:i:s'));
            $retorno=Database::executeRow($sql, $params);
		   }else{
			   return $retorno;
		   }
        }else{
            $retorno=1;

        }
        
        return $retorno;
        
    }
    public function validateCodigo($Codigo){
        $retorno=0;
        $sql = 'SELECT `IDFactor` FROM `doblefactor` WHERE `Usuario`=? and `Codigo`=?';
        $params = array($this->id,$Codigo);
        $retorno= Database::getRow($sql, $params);
        return $retorno;
        
    }
    public function CerrarSesion($idusuario){
        $retorno=0;
        $sql = 'DELETE FROM `doblefactor` WHERE `Usuario`=?';
        $params = array($this->id);
        $retorno= Database::executeRow($sql, $params);
        return $retorno;
        
        
    }
    private function enviarEmail($Codigo){
		require_once('../../libraries/Exception.php');
		require_once('../../libraries/PHPMailer.php');  
		require_once('../../libraries/SMTP.php');  
        $mail = new PHPMailer();
		//indico a la clase que use SMTP
		//permite modo debug para ver mensajes de las cosas que van ocurriendo
		$mail->isSMTP();
		$mail->SMTPDebug = 0;
       
        //Debo de hacer autenticación SMTP
		$mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        //indico el servidor de Gmail para SMTP
        $mail->Host = 'smtp.gmail.com';
        //indico el puerto que usa Gmail
        $mail->Port = 587;
        //indico un usuario / clave de un usuario de gmail
        $mail->Username = "panayelyaguilar@gmail.com";
        $mail->Password = "flaudersitococo";
        $mail->setFrom('panayelyaguilar@gmail.com', 'Merch Studio');
		//$mail­>AddReplyTo($this->correo);
		$mail->Subject = 'Envío de codigo'.$Codigo;
		$mail->msgHTML('Este es el codigo para ingresar '.$Codigo);
        //indico destinatario
		$address = $this->correo;
		$mail->addAddress($address, $this->nombres);
		if ($mail->send()) {
			return true;
		} else {
			return false;
		}

    }


	public function validarCodigo() {
		$sql = 'SELECT Codigo FROM doblefactor WHERE Usuario = ?';
		$params = array($this->id);
		return Database::getRow($sql, $params);
	}


    //Metodos para manejar los SCRUD

    public function checkNomUsuario()
	{
		$sql = 'SELECT IdUsuario,Correo, FechaVencimiento FROM usuario WHERE NomUsuario = ?';
		$params = array($this->nomusuario);
		$data = Database::getRow($sql, $params);
		if ($data) {
			$this->id = $data['IdUsuario'];
			$this->correo = $data['Correo'];
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

	public function checkUsuario()
	{
		$sql = 'SELECT * FROM usuario WHERE IdUsuario = ?';
		$params = array($this->id);
		return Database::getRow($sql, $params);
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

	public function getAtributos($id)
	{
		$sql = 'SELECT atributos FROM roles inner join usuario USING(idrol) where idusuario = ? limit 0,1';
		$params = array($id);
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
