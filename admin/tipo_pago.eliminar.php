<?php
include('header.php');
$web->validarRol(array("Administrador"));
$web->validarPermiso(array("CRUD"));

if(isset($_GET['id_tipo_pago'])){
	$id_tipo_pago = $_GET['id_tipo_pago'];
	if(is_numeric($id_tipo_pago)){
		$statement = $web->db->prepare("delete from tipo_pago where id_tipo_pago = :id_tipo_pago");
		$statement->bindParam(":id_tipo_pago", $id_tipo_pago, PDO::PARAM_INT);
		$statement->execute();
		echo '<div class="alert alert-success" role="alert">El tipo de pago se eliminó correctamente.</div>';
	}
}
?>

<h1 class="display-4">Eliminar tipo de pago</h1>
<hr>
<div class="container">
	<a href="tipo_pago.php" class="btn btn-dark">Volver a Tipo de pago</a>
</div>

<hr>

<?php
include('footer.php');
?>