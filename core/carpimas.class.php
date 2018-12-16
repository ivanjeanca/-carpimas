<?php

/**
 * Class: Carpimas
 * @autor: Iván Tirado
 * @date: 2018/11/01
 * @version: 0.1
*/

session_start();

class Carpimas{
	var $db;

	function conexion(){
		$db_host = "localhost";
		$db_user = "carpimas";
		$db_pass = "1";
		$db_name = "carpimas";
		$this->db = new PDO("mysql:host=$db_host; dbname=$db_name;charset=utf8", $db_user, $db_pass);
	}

	function queryArray($query, $parametros = array()){
		$this->conexion();
		$datos = array();
		$statement = $this->db->prepare($query);
		if(count($parametros) > 0){
			$etiquetas = array_keys($parametros);
			for ($i=0; $i < count($etiquetas); $i++)
				$statement->bindParam($etiquetas[$i], $parametros[$etiquetas[$i]]);
		}

		$statement->execute();

		while ($fila = $statement->fetch(PDO::FETCH_ASSOC))
			array_push($datos, $fila);
		
		return $datos;
	}

	function queryArray2($conexion, $query, $parametros = array()){
		$datos = array();
		$statement = $conexion->db->prepare($query);
		if(count($parametros) > 0){
			$etiquetas = array_keys($parametros);
			for ($i=0; $i < count($etiquetas); $i++) { 
				$statement->bindParam($etiquetas[$i], $parametros[$etiquetas[$i]]);
			}
		}
		$statement->execute();
		while ($fila = $statement->fetch(PDO::FETCH_ASSOC))
			array_push($datos, $fila);		
		return $datos;
	}

	function obtenerTipoProducto(){
		$this->conexion();
		$datos = array();
		$statement = $this->db->prepare("select * from tipo_producto");
		$statement->execute();

		while ($fila = $statement->fetch(PDO::FETCH_ASSOC))
			array_push($datos, $fila);
		
		return $datos;
	}

	function obtenerMaterial(){
		$this->conexion();
		$datos = array();
		$statement = $this->db->prepare("select * from material");
		$statement->execute();

		while ($fila = $statement->fetch(PDO::FETCH_ASSOC))
			array_push($datos, $fila);
		
		return $datos;
	}

	function obtenerColor(){
		$this->conexion();
		$datos = array();
		$statement = $this->db->prepare("select * from color");
		$statement->execute();

		while ($fila = $statement->fetch(PDO::FETCH_ASSOC))
			array_push($datos, $fila);
		
		return $datos;
	}


	function obtenerPais(){
		$this->conexion();
		$datos = array();
		$statement = $this->db->prepare("select * from pais");
		$statement->execute();

		while ($fila = $statement->fetch(PDO::FETCH_ASSOC))
			array_push($datos, $fila);
		
		return $datos;
	}

	function obtenerTipoPago(){
		$this->conexion();
		$datos = array();
		$statement = $this->db->prepare("select * from tipo_pago");
		$statement->execute();

		while ($fila = $statement->fetch(PDO::FETCH_ASSOC))
			array_push($datos, $fila);
		
		return $datos;
	}

	function obtenerEnvio(){
		$this->conexion();
		$datos = array();
		$statement = $this->db->prepare("select * from envio");
		$statement->execute();

		while ($fila = $statement->fetch(PDO::FETCH_ASSOC))
			array_push($datos, $fila);
		
		return $datos;
	}

	function validarArchivo($archivo){
		switch($archivo['error']){
			case 0:
				$tipos = array("image/jpg", "image/png", "image/jpeg");
				if(in_array($archivo['type'], $tipos)){
					if($archivo['size'] < 2097152)
						return true;
					else
						return false;
					return false;
				} else
					return false;
			break;

			default:
				return false;
		}
	}

	function obtenerAllProductos(){
		$this->conexion();
		$datos = array();
		$statement = $this->db->prepare("select * from producto 
										 join color using(id_color) 
										 join material using(id_material) 
										 join tipo_producto using(id_tipo_prod)");
		$statement->execute();

		while ($fila = $statement->fetch(PDO::FETCH_ASSOC))
			array_push($datos, $fila);
		
		return $datos;
	}

	function obtenerNovedades(){
		$this->conexion();
		$datos = array();
		$statement = $this->db->prepare("select * from producto 
										 join color using(id_color) 
										 join material using(id_material) 
										 join tipo_producto using(id_tipo_prod)
										 order by fecha_entregado desc
										 limit 6");
		$statement->execute();

		while ($fila = $statement->fetch(PDO::FETCH_ASSOC))
			array_push($datos, $fila);
		
		return $datos;
	}

	function obtenerEstado(){
		$this->conexion();
		$datos = array();
		$statement = $this->db->prepare("select e.id_estado, e.estado, p.pais from estado e  
										 join pais p using(id_pais)
										 order by p.pais asc, e.estado asc");
		$statement->execute();

		while ($fila = $statement->fetch(PDO::FETCH_ASSOC))
			array_push($datos, $fila);
		
		return $datos;
	}

	function obtenerCiudad(){
		$this->conexion();
		$datos = array();
		$statement = $this->db->prepare("select c.id_ciudad, c.ciudad, e.estado, p.pais from ciudades c
										 join estado e using(id_estado)
										 join pais p using(id_pais)
										 order by p.pais asc, e.estado asc, c.ciudad asc");
		$statement->execute();

		while ($fila = $statement->fetch(PDO::FETCH_ASSOC))
			array_push($datos, $fila);
		
		return $datos;
	}

	function obtenerAllUsuarios(){
		$this->conexion();
		$datos = array();
		$statement = $this->db->prepare("select u.id_usuario, concat(u.nombre, ' ', u.apellido) as nombre, u.correo, r.rol from usuario u
		join rol_usuario ru on u.id_usuario = ru.id_usuario
		join rol r on ru.id_rol = r.id_rol
		order by u.id_usuario asc");
		$statement->execute();

		while ($fila = $statement->fetch(PDO::FETCH_ASSOC))
			array_push($datos, $fila);
		
		return $datos;
	}

	public function obtenerPermisos($email){
		$this->conexion();
		$permisos = array();
		$query = "select p.permiso from usuario u
		join rol_usuario r using(id_usuario)
		join rol_permiso rp USING(id_rol)
		join permiso p using(id_permiso)
		where u.correo = :correo";
		$statement = $this->db->prepare($query);
		$statement->bindParam(":correo", $email);
		$statement->execute();
		while ($fila = $statement->fetch(PDO::FETCH_ASSOC))
			array_push($permisos, $fila['permiso']);
		return $permisos;
	}

	public function obtenerRoles($email){
		$this->conexion();
		$roles = array();
		$query = "select r.rol from usuario u
		join rol_usuario ru using(id_usuario)
		join rol r using(id_rol)
		where u.correo = :correo";
		$statement = $this->db->prepare($query);
		$statement->bindParam(":correo", $email);
		$statement->execute();
		while ($fila = $statement->fetch(PDO::FETCH_ASSOC))
			array_push($roles, $fila['rol']);
		return $roles;
	}

	public function login($email, $contrasena){
		$this->conexion();
		$contrasena = md5($contrasena);
		$query = "select * from usuario where correo = :correo and contrasena = :contrasena";
		$statement = $this->db->prepare($query);
		$statement->bindParam(":correo", $email);
		$statement->bindParam(":contrasena", $contrasena);
		$statement->execute();
		if($statement->fetch(PDO::FETCH_ASSOC))
			return true;
		else
			return false;
	}

	public function validarRol($roles_permitidos){
		$roles = $this->obtenerRoles($this->obtenerUsuario());
		$valido = false;
		
		foreach ($roles as $key => $value) 
			if(in_array($value, $roles_permitidos))
				$valido = true;
		if(!$valido){
			$this->logout();
			header("Location: login.php?admin=required");
		}
	}

	public function validarPermiso($permisos_permitidos){
		$permisos = $this->obtenerPermisos($this->obtenerUsuario());
		$valido = false;
		
		foreach ($permisos as $key => $value) 
			if(in_array($value, $permisos_permitidos))
				$valido = true;
		if(!$valido){
			$this->logout();
			header("Location: login.php?admin=required");
		}
	}

	public function obtenerUsuario(){
		return $_SESSION['email'];
	}

	public function logout(){
		unset($_SESSION['valido']);
		$_SESSION['email'] = null;
		unset($_SESSION['roles']);
		unset($_SESSION['permisos']);
	}
}
?>