<?php 
include('header.php'); 
$web->validarRol(array("Administrador"));
$web->validarPermiso(array("CRUD"));

if(isset($_POST['enviar'])){
   	$material = $_POST['material'];
   	$statement = $web->db->prepare("insert into material (material) values (:material)");
	$statement->bindParam(":material", $material);
	$statement->execute();

   	echo '<div class="alert alert-success" role="alert">El material se insertó correctamente<a href="material.php" class="btn btn-dark" style="margin-left:30px;">Volver a Material</a></div>';
}
?>

<h1 class="display-4">Insertar material</h1>
<hr>

<div class="container">
	<form action="material.insertar.php" method="post" class="lead">
		<div class="form-group">
			<label>Material</label>
	   		<input type="text" name="material" required class="form-control">
		</div>
		<div class="form-group">
			<input type="submit" name="enviar" value="Guardar" class="btn btn-dark">
		</div>
	</form>
</div>

<hr>

<?php include('footer.php'); ?>