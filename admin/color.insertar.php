<?php 
include('header.php'); 
$web->validarRol(array("Administrador"));
$web->validarPermiso(array("CRUD"));

if(isset($_POST['enviar'])){
   	$color = $_POST['color'];
   	$statement = $web->db->prepare("insert into color (color) values (:color)");
	$statement->bindParam(":color", $color);
	$statement->execute();
   	echo '<div class="alert alert-success" role="alert">El color se insertó correctamente<a href="color.php" class="btn btn-dark" style="margin-left:30px;">Volver a Material</a></div>';
}
?>
<h1 class="display-4">Insertar color</h1>
<hr>
<div class="container">
	<form action="color.insertar.php" method="post" class="lead">
		<div class="form-group">
			<label>Color</label>
	   		<input type="text" name="color" required class="form-control">
		</div>
		<div class="form-group">
			<input type="submit" name="enviar" value="Guardar" class="btn btn-dark">
		</div>
	</form>
</div>
<hr>
<?php include('footer.php'); ?>