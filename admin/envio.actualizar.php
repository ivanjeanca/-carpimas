<?php
include('header.php');
if(isset($_GET['id_envio'])){
	$id_envio = $_GET['id_envio'];
	if(is_numeric($id_envio)){
		if(isset($_POST['enviar'])){
			$envio = $_POST['envio'];
			$statement = $web->db->prepare("update envio set envio = :envio where id_envio = :id_envio");
			$statement->bindParam(":envio", $envio);
			$statement->bindParam(":id_envio", $id_envio);
			$statement->execute();
			echo '<div class="alert alert-success" role="alert">El envio se actualizó correctamente.<a href="envio.php" class="btn btn-dark" style="margin-left:30px;">Volver a Envío</a></div>';
		}
		$parametros[':id_envio'] = $id_envio;
		$tipo = $web->queryArray("select * from envio where id_envio = :id_envio", $parametros);
	}
}
?>

<h1 class="display-4">Actualizar envío</h1>
<hr>

<div class="container">
	<form action="envio.actualizar.php?id_envio=<?php echo $id_envio; ?>" method="post" class="lead">
		<div class="form-group">
			<label>Envío</label>
	   		<input type="text" name="envio" required class="form-control" value="<?php echo $tipo[0]['envio']; ?>">
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