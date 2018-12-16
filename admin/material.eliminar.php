<?php
include('header.php');
$web->validarRol(array("Administrador"));
$web->validarPermiso(array("CRUD"));

if(isset($_GET['id_material'])){
	$id_material = $_GET['id_material'];
	if(is_numeric($id_material)){
		$statement = $web->db->prepare("delete from material where id_material = :id_material");
		$statement->bindParam(":id_material", $id_material, PDO::PARAM_INT);
		$statement->execute();
		echo '<div class="alert alert-success" role="alert">El material se eliminó correctamente.</div>';
	}
}
?>

<h1 class="display-4">Eliminar material</h1>
<hr>
<div class="container">
	<a href="material.php" class="btn btn-dark">Volver a material</a>
</div>

<hr>

<?php
include('footer.php');
?>