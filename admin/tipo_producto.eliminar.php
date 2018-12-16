<?php
include('header.php');
$web->validarRol(array("Administrador"));
$web->validarPermiso(array("CRUD"));

if(isset($_GET['id_tipo_prod'])){
	$id_tipo_prod = $_GET['id_tipo_prod'];
	if(is_numeric($id_tipo_prod)){
		$statement = $web->db->prepare("delete from tipo_producto where id_tipo_prod = :id_tipo_prod");
		$statement->bindParam(":id_tipo_prod", $id_tipo_prod, PDO::PARAM_INT);
		$statement->execute();
		echo '<div class="alert alert-success" role="alert">El tipo de producto se eliminó correctamente.</div>';
	}
}
?>

<h1 class="display-4">Eliminar tipo de producto</h1>
<hr>
<div class="container">
	<a href="tipo_producto.php" class="btn btn-dark">Volver a Tipo de producto</a>
</div>

<hr>

<?php
include('footer.php');
?>