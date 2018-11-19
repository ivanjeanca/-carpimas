<?php
include('header.php');

if(isset($_GET['id_pais'])){
	$id_pais = $_GET['id_pais'];
	if(is_numeric($id_pais)){
		$statement = $web->db->prepare("delete from pais where id_pais = :id_pais");
		$statement->bindParam(":id_pais", $id_pais, PDO::PARAM_INT);
		$statement->execute();
		echo '<div class="alert alert-success" role="alert">El material se eliminó correctamente.</div>';
	}
}
?>

<h1 class="display-4">Eliminar país</h1>
<hr>
<div class="container">
	<a href="pais.php" class="btn btn-dark">Volver a país</a>
</div>

<hr>

<?php
include('footer.php');
?>