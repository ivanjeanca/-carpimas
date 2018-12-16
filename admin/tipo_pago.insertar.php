<?php 
include('header.php'); 
$web->validarRol(array("Administrador"));
$web->validarPermiso(array("CRUD"));

if(isset($_POST['enviar'])){
   	$tipo_pago = $_POST['tipo_pago'];
   	$statement = $web->db->prepare("insert into tipo_pago (tipo_pago) values (:tipo_pago)");
	$statement->bindParam(":tipo_pago", $tipo_pago);
	$statement->execute();

   	echo '<div class="alert alert-success" role="alert">El tipo de pago se insertó correctamente<a href="tipo_pago.php" class="btn btn-dark" style="margin-left:30px;">Volver a Tipo de pago</a></div>';
}
?>

<h1 class="display-4">Insertar tipo de pago</h1>
<hr>

<div class="container">
	<form action="tipo_pago.insertar.php" method="post" class="lead">
		<div class="form-group">
			<label>Tipo</label>
	   		<input type="text" name="tipo_pago" required class="form-control">
		</div>
		<div class="form-group">
			<input type="submit" name="enviar" value="Guardar" class="btn btn-dark">
		</div>
	</form>
</div>

<hr>

<?php include('footer.php'); ?>