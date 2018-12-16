<?php 
include('header.php');

$web->db->beginTransaction();
if(isset($_GET['id_usuario'])){
    $id_usuario = $_GET['id_usuario'];
    if(is_numeric($id_usuario)){
        $statement = $web->db->prepare("update rol_usuario set id_rol = 1 where id_usuario = :id_usuario");
        $statement->bindParam(":id_usuario", $id_usuario);
        $statement->execute();
    } else 
        $web->db->rollback();
} else 
    $web->db->rollback();
$web->db->commit();
header("Location: usuarios.php");
?>