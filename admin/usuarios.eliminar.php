<?php 
include('header.php');

$web->db->beginTransaction();
if(isset($_GET['id_usuario'])){
    $id_usuario = $_GET['id_usuario'];
    if(is_numeric($id_usuario)){
        $statement = $web->db->prepare("delete from rol_usuario where id_usuario = :id_usuario");
        $statement->bindParam(":id_usuario", $id_usuario);
        $statement->execute();
        
        $statement = $web->db->prepare("delete from usuario where id_usuario = :id_usuario");
        $statement->bindParam(":id_usuario", $id_usuario);
        $statement->execute();
    } else 
        $web->db->rollback();
} else 
    $web->db->rollback();
$web->db->commit();

echo '<div class="alert alert-success" role="alert">El usuario se eliminó correctamente.</div>';
?>

<h1 class="display-4">Eliminar usuario</h1>
<hr>
<div class="container">
	<a href="usuarios.php" class="btn btn-dark">Volver a Usuarios</a>
</div>

<hr>

<?php
include('footer.php');
?>