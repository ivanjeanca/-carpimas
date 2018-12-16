<?php 
include('header.php'); 
$web->validarRol(array("Administrador"));
$web->validarPermiso(array("CRUD"));

if(isset($_POST['enviar'])){
   	$tipo_producto = $_POST['tipo_producto'];
   	$statement = $web->db->prepare("insert into tipo_producto (tipo_prod) values (:tipo_producto)");
	$statement->bindParam(":tipo_producto", $tipo_producto);
	$statement->execute();

   	echo '<div class="alert alert-success" role="alert">El tipo de producto se insertó correctamente<a href="tipo_producto.php" class="btn btn-dark" style="margin-left:30px;">Volver a Tipo de producto</a></div>';
}
?>

<h1 class="display-4">Insertar tipo de producto</h1>
<hr>

<div class="container">
	<form action="tipo_producto.insertar.php" method="post" class="lead">
		<div class="form-group">
			<label>Tipo</label>
	   		<input type="text" name="tipo_producto" required class="form-control">
		</div>
		<div class="form-group">
			<input type="submit" name="enviar" value="Guardar" class="btn btn-dark">
		</div>
	</form>
</div>

<hr>

<?php include('footer.php'); ?>