<?php

/**
 * Class: Carpimas
 * @autor: Iván Tirado
 * @date: 2018/11/01
 * @version: 0.1
 */

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
}
?>