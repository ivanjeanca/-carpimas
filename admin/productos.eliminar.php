<?php
include('header.php');
$web->validarRol(array("Administrador"));
$web->validarPermiso(array("CRUD"));

if(isset($_GET['id_producto'])){
	$id_producto = $_GET['id_producto'];
	if(is_numeric($id_producto)){
		$statement = $web->db->prepare("delete from producto where id_producto = :id_producto");
		$statement->bindParam(":id_producto", $id_producto, PDO::PARAM_INT);
		$statement->execute();
		echo '<div class="alert alert-success" role="alert">El producto se eliminó correctamente.</div>';
	}
}
?>

<h1 class="display-4">Eliminar producto</h1>
<hr>
<div class="container">
	<a href="productos.php" class="btn btn-dark">Volver a Productos</a>
</div>
<hr>

<?php include('footer.php'); ?>