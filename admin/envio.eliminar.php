<?php
include('header.php');

if(isset($_GET['id_envio'])){
	$id_envio = $_GET['id_envio'];
	if(is_numeric($id_envio)){
		$statement = $web->db->prepare("delete from envio where id_envio = :id_envio");
		$statement->bindParam(":id_envio", $id_envio, PDO::PARAM_INT);
		$statement->execute();
		echo '<div class="alert alert-success" role="alert">El envio se eliminó correctamente.</div>';
	}
}
?>

<h1 class="display-4">Eliminar envío</h1>
<hr>
<div class="container">
	<a href="envio.php" class="btn btn-dark">Volver a envío</a>
</div>

<hr>

<?php include('footer.php'); ?>