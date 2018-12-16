<?php
header('Content-Type: application/json');
include('../../core/carpimas.class.php');

class usuarios extends Carpimas{

    # http://localhost:8080/Carpimas/ws/usuario/index.php

	function mostrarUsuarios($id_usuario = null){
		$sqlpart="";
		$parametros = array();
		if (!is_null($id_usuario)) {
			$sqlpart="where id_usuario=:id_usuario";
			$parametros[':id_usuario'] = $id_usuario;
		}
        $sql="select u.id_usuario, u.nombre, u.apellido, u.correo, u.contrasena, u.llave, r.rol from usuario u join rol_usuario ru on u.id_usuario = ru.id_usuario join rol r on ru.id_rol = r.id_rol ".$sqlpart;
        $sql .= " order by u.id_usuario asc";
		$datos= $this->queryArray($sql,$parametros);
		return $datos;
    }
    

    /*
    [
        {
            "nombre": "Postman2",
            "apellido": "Postman2",
            "correo": "postman2@postman2.com",
            "contrasena": "1"
        }
    ]
    */

	function insertarUsuario(){
		$cadena = file_get_contents("php://input");
        $cadena = json_decode($cadena);
        $contrasena = md5($cadena[0]->contrasena);
        $this->Conexion();
		$this->db->beginTransaction();
        $sql="insert into usuario (nombre, apellido, correo, contrasena) values (:nombre, :apellido, :correo, :contrasena)";
		$statement=$this->db->prepare($sql);
		$statement->bindParam(':nombre',$cadena[0]->nombre);
		$statement->bindParam(':apellido',$cadena[0]->apellido);
		$statement->bindParam(':correo',$cadena[0]->correo);
		$statement->bindParam(':contrasena',$contrasena);
		$statement->execute();

        $parametros[':correo'] = $cadena[0]->correo;
        $datos = $this->queryArray2($this, "select id_usuario from usuario where correo = :correo", $parametros);
        
        $id_usuario = $datos[0]['id_usuario'];

        $sql = "insert into rol_usuario (id_rol, id_usuario) values (2, :id_usuario)";
        $statement = $this->db->prepare($sql);
        $statement->bindParam(":id_usuario", $id_usuario);
        $statement->execute();

        $datos = array();
        $datos['estatus'] = "OK";
        $datos['mensaje'] = "Se insertó el usuario y rol."; 
        $datos['id_usuario'] = $id_usuario;
        $this->db->commit();
        return $datos;
    }
    

    # http://localhost:8080/Carpimas/ws/usuario/index.php?id_usuario=9

	function eliminarUsuario($id_usuario){
		if (is_numeric($id_usuario)) {
			$sql="delete from usuario where id_usuario=:id_usuario";
			$this->Conexion();
			$statement = $this->db->prepare($sql);
			$statement->bindParam(':id_usuario',$id_usuario);
			$fila=$statement->execute();
			if ($statement->rowCount()>0) {
				$datos['estatus']= "Ok";
				$datos['mensaje']= "Se eliminó el usuario ".$id_usuario;
			} else {
				$datos['estatus']= "No";
				$datos['mensaje']= "No se encontró el usuario";
			}
		} else {
			$datos['estatus']= "No";
			$datos['mensaje']= "Se requiere id númerico";
		}
		return $datos;
    }
    

    # http://localhost:8080/Carpimas/ws/usuario/index.php?email_admin=admin@carpimas.com&contr_admin=1&id_usuario=9

    function hacerUsuarioAdministrador($email_admin, $contr_admin, $id_usuario){
        if($this->login($email_admin, $contr_admin)){
            if($this->validarRoles(array("Administrador"), $email_admin) && ($this->validarPermisos(array("CRUD"), $email_admin))){
                if(!is_null($id_usuario)){
                    if($this->validarExistencia($id_usuario)){
                        $this->Conexion();
                        $this->db->beginTransaction();
                        if(is_numeric($id_usuario)){
                            $statement = $this->db->prepare("update rol_usuario set id_rol = 1 where id_usuario = :id_usuario");
                            $statement->bindParam(":id_usuario", $id_usuario);
                            $statement->execute();
                            if ($statement->rowCount() > 0) {
                                $datos['estatus']= "Ok";
                                $datos['mensaje']= "Se hizo administrador el usuario ".$id_usuario;
                            } else {
                                $datos['estatus']= "No";
                                $datos['mensaje']= "Ya es administrador";
                            }
                        } else {
                            $datos['estatus']= "No";
                            $datos['mensaje']= "Se requiere id númerico";
                            $this->db->rollback();
                        }
                        $this->db->commit();
                    } else {
                        $datos['estatus']= "No";
                        $datos['mensaje']= "El id de usuario no corresponde a algun usuario registrado";
                    }
                } else {
                    $datos['estatus']= "No";
                    $datos['mensaje']= "Se requiere id del usuario a afectar";
                }
            } else {
                $datos['estatus']= "No";
                $datos['mensaje']= "La cuenta no tiene los permisos necesarios.";
            }
        } else {
            $datos['estatus']= "No";
            $datos['mensaje']= "No es una cuenta valida, Correo/contraseña incorrectos.";
        }
        return $datos;
    }

    public function validarRoles($roles_permitidos, $email){
		$roles = $this->obtenerRoles($email);
		$valido = false;
		
		foreach ($roles as $key => $value) 
			if(in_array($value, $roles_permitidos))
				$valido = true;
        
        return $valido;
	}

	public function validarPermisos($permisos_permitidos, $email){
		$permisos = $this->obtenerPermisos($email);
		$valido = false;
		
		foreach ($permisos as $key => $value) 
			if(in_array($value, $permisos_permitidos))
                $valido = true;
                
        return $valido;
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
    
    public function validarExistencia($id_usuario){
        $this->conexion();
		$query = "select * from usuario where id_usuario = :id_usuario";
		$statement = $this->db->prepare($query);
		$statement->bindParam(":id_usuario", $id_usuario);
		$statement->execute();
		if($statement->fetch(PDO::FETCH_ASSOC))
			return true;
		else
			return false;
    }
}

$usuarios = new usuarios;
$metodo = $_SERVER['REQUEST_METHOD'];

switch($metodo){
    case 'POST':
        $datos = $usuarios->insertarUsuario();
        break;
    case 'PUT':
        $email_admin = isset($_GET['email_admin']) ? $_GET['email_admin'] : null;
        $contr_admin = isset($_GET['contr_admin']) ? $_GET['contr_admin'] : null;
        $id_usuario = isset($_GET['id_usuario']) ? $_GET['id_usuario'] : null;
        $datos = $usuarios->hacerUsuarioAdministrador($email_admin, $contr_admin, $id_usuario);
        break;
    case 'DELETE':
        $id_usuario = isset($_GET['id_usuario']) ? $_GET['id_usuario'] : null;
        $datos = $usuarios->eliminarUsuario($id_usuario);
        break;
    case 'GET':
    default:
        $id_usuario = isset($_GET['id_usuario']) ? $_GET['id_usuario'] : null;
        $datos = $usuarios->mostrarUsuarios($id_usuario);
        break;
}

$cadena = json_encode($datos);
echo $cadena;
?>