<?php
include('header.php');
if(isset($_GET['id_material'])){
	$id_material = $_GET['id_material'];
	if(is_numeric($id_material)){
		if(isset($_POST['enviar'])){
			$material = $_POST['material'];
			$statement = $web->db->prepare("update material set material = :material where id_material = :id_material");
			$statement->bindParam(":material", $material);
			$statement->bindParam(":id_material", $id_material);
			$statement->execute();
			echo '<div class="alert alert-success" role="alert">El material se actualizó correctamente.<a href="material.php" class="btn btn-dark" style="margin-left:30px;">Volver a Material</a></div>';
		}
		$parametros[':id_material'] = $id_material;
		$tipo = $web->queryArray("select * from material where id_material = :id_material", $parametros);
	}
}
?>

<h1 class="display-4">Actualizar material</h1>
<hr>

<div class="container">
	<form action="material.actualizar.php?id_material=<?php echo $id_material; ?>" method="post" class="lead">
		<div class="form-group">
			<label>Material</label>
	   		<input type="text" name="material" required class="form-control" value="<?php echo $tipo[0]['material']; ?>">
		</div>
		<div class="form-group">
			<input type="submit" name="enviar" value="Actualizar" class="btn btn-dark">
		</div>
	</form>
</div>

<hr>

<?php
include('footer.php');
?>