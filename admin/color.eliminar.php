<?php
include('header.php');

if(isset($_GET['id_color'])){
	$id_color = $_GET['id_color'];
	if(is_numeric($id_color)){
		$statement = $web->db->prepare("delete from color where id_color = :id_color");
		$statement->bindParam(":id_color", $id_color, PDO::PARAM_INT);
		$statement->execute();
		echo '<div class="alert alert-success" role="alert">El color se eliminó correctamente.</div>';
	}
}
?>

<h1 class="display-4">Eliminar color</h1>
<hr>
<div class="container">
	<a href="color.php" class="btn btn-dark">Volver a color</a>
</div>

<hr>

<?php
include('footer.php');
?>