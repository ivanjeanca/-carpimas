<?php
include('header.php');
$web->validarRol(array("Administrador"));
$web->validarPermiso(array("CRUD"));

if(isset($_GET['id_estado'])){
	$id_estado = $_GET['id_estado'];
	if(is_numeric($id_estado)){
		$statement = $web->db->prepare("delete from estado where id_estado = :id_estado");
		$statement->bindParam(":id_estado", $id_estado, PDO::PARAM_INT);
		$statement->execute();
		echo '<div class="alert alert-success" role="alert">El estado se eliminó correctamente.</div>';
	}
}
?>

<h1 class="display-4">Eliminar estado</h1>
<hr>
<div class="container">
	<a href="estado.php" class="btn btn-dark">Volver a Estado</a>
</div>

<hr>

<?php
include('footer.php');
?>