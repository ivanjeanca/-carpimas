<?php
include('header.php');
$web->validarRol(array("Administrador"));
$web->validarPermiso(array("CRUD"));

if(isset($_GET['id_ciudad'])){
	$id_ciudad = $_GET['id_ciudad'];
	if(is_numeric($id_ciudad)){
		$statement = $web->db->prepare("delete from ciudades where id_ciudad = :id_ciudad");
		$statement->bindParam(":id_ciudad", $id_ciudad, PDO::PARAM_INT);
		$statement->execute();
		echo '<div class="alert alert-success" role="alert">La ciudad se eliminó correctamente.</div>';
	}
}
?>

<h1 class="display-4">Eliminar ciudad</h1>
<hr>
<div class="container">
	<a href="ciudad.php" class="btn btn-dark">Volver a Ciudades</a>
</div>

<hr>

<?php
include('footer.php');
?>