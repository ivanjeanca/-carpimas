<?php 
include('header.php'); 
$web->validarRol(array("Administrador"));
$web->validarPermiso(array("CRUD"));

if(isset($_POST['enviar'])){
   	$envio = $_POST['envio'];
   	$statement = $web->db->prepare("insert into envio (envio) values (:envio)");
	$statement->bindParam(":envio", $envio);
	$statement->execute();

   	echo '<div class="alert alert-success" role="alert">El envio se insertó correctamente<a href="envio.php" class="btn btn-dark" style="margin-left:30px;">Volver a Envío</a></div>';
}
?>

<h1 class="display-4">Insertar envío</h1>
<hr>

<div class="container">
	<form action="envio.insertar.php" method="post" class="lead">
		<div class="form-group">
			<label>Envío</label>
	   		<input type="text" name="envio" required class="form-control">
		</div>
		<div class="form-group">
			<input type="submit" name="enviar" value="Guardar" class="btn btn-dark">
		</div>
	</form>
</div>

<hr>

<?php include('footer.php'); ?>