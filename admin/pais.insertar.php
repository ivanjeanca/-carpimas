<?php 
include ('header.php'); 
if(isset($_POST['enviar'])){
   	$pais = $_POST['pais'];
   	$statement = $web->db->prepare("insert into pais (pais) values (:pais)");
	$statement->bindParam(":pais", $pais);
	$statement->execute();

   	echo '<div class="alert alert-success" role="alert">El país se insertó correctamente<a href="pais.php" class="btn btn-dark" style="margin-left:30px;">Volver a País</a></div>';
}
?>

<h1 class="display-4">Insertar pais</h1>
<hr>

<div class="container">
	<form action="pais.insertar.php" method="post" class="lead">
		<div class="form-group">
			<label>País</label>
	   		<input type="text" name="pais" required class="form-control">
		</div>
		<div class="form-group">
			<input type="submit" name="enviar" value="Guardar" class="btn btn-dark">
		</div>
	</form>
</div>

<hr>

<?php include('footer.php'); ?>