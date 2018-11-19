<?php
include('header.php');
if(isset($_GET['id_tipo_pago'])){
	$id_tipo_pago = $_GET['id_tipo_pago'];
	if(is_numeric($id_tipo_pago)){
		if(isset($_POST['enviar'])){
			$tipo_pago = $_POST['tipo_pago'];
			$statement = $web->db->prepare("update tipo_pago set tipo_pago = :tipo_pago where id_tipo_pago = :id_tipo_pago");
			$statement->bindParam(":tipo_pago", $tipo_pago);
			$statement->bindParam(":id_tipo_pago", $id_tipo_pago);
			$statement->execute();
			echo '<div class="alert alert-success" role="alert">El tipo de pago se actualizó correctamente.<a href="tipo_pago.php" class="btn btn-dark" style="margin-left:30px;">Volver a Tipo de pago</a></div>';
		}
		$parametros[':id_tipo_pago'] = $id_tipo_pago;
		$tipo = $web->queryArray("select * from tipo_pago where id_tipo_pago = :id_tipo_pago", $parametros);
	}
}
?>

<h1 class="display-4">Actualizar tipo de pago</h1>
<hr>

<div class="container">
	<form action="tipo_pago.actualizar.php?id_tipo_pago=<?php echo $id_tipo_pago; ?>" method="post" class="lead">
		<div class="form-group">
			<label>Tipo</label>
	   		<input type="text" name="tipo_pago" required class="form-control" value="<?php echo $tipo[0]['tipo_pago']; ?>">
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