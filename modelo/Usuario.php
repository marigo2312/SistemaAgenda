<?php

include_once("AccesoDatos.php");

class Usuario {
	private $id = 0;
	private $usuario = "";
	private $contrasena = "";
	private $rol = "";
	private $oAD = null;

	public function setUsuario($valor) {
		$this->usuario = $valor;
	}
	public function getUsuario() {
		return $this->usuario;
	}

	public function setContrasena($valor) {
		$this->contrasena = $valor;
	}
	public function getContrasena() {
		return $this->contrasena;
	}

	public function getRol() {
		return $this->rol;
	}

	public function getId() {
		return $this->id;
	}

	public function setId($valor) {
		$this->id = intval($valor);
	}

	public function validarLogin() {
		$bRet = false;
		$sQuery = "";
		$arrRS = null;

		if ($this->usuario == "" || $this->contrasena == "") {
			throw new Exception("Usuario->validarLogin: faltan datos");
		} else {
			$sQuery = "SELECT id, usuario, rol 
					   FROM usuarios 
					   WHERE usuario = '" . $this->usuario . "' 
					   AND contrasena = '" . $this->contrasena . "'";

			$oAD = new AccesoDatos();
			if ($oAD->conectar()) {
				$arrRS = $oAD->ejecutarConsulta($sQuery);
				$oAD->desconectar();

				if ($arrRS != null) {
					$this->id = $arrRS[0][0];
					$this->usuario = $arrRS[0][1];
					$this->rol = $arrRS[0][2];
					$bRet = true;
				}
			}
		}
		return $bRet;
	}
}
?>
