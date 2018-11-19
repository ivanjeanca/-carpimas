<?php
include('header.php');
if(isset($_GET['id_tipo_prod'])){
	$id_tipo_prod = $_GET['id_tipo_prod'];
	if(is_numeric($id_tipo_prod)){
		if(isset($_POST['enviar'])){
			$tipo_prod = $_POST['tipo_prod'];
			$statement = $web->db->prepare("update tipo_producto set tipo_prod = :tipo_prod where id_tipo_prod = :id_tipo_prod");
			$statement->bindParam(":tipo_prod", $tipo_prod);
			$statement->bindParam(":id_tipo_prod", $id_tipo_prod);
			$statement->execute();
			echo '<div class="alert alert-success" role="alert">El tipo de producto se actualizó correctamente.<a href="tipo_producto.php" class="btn btn-dark" style="margin-left:30px;">Volver a Tipo de producto</a></div>';
		}
		$parametros[':id_tipo_prod'] = $id_tipo_prod;
		$tipo = $web->queryArray("select * from tipo_producto where id_tipo_prod = :id_tipo_prod", $parametros);
	}
}
?>

<h1 class="display-4">Actualizar tipo de producto</h1>
<hr>

<div class="container">
	<form action="tipo_producto.actualizar.php?id_tipo_prod=<?php echo $id_tipo_prod; ?>" method="post" class="lead">
		<div class="form-group">
			<label>Tipo</label>
	   		<input type="text" name="tipo_prod" required class="form-control" value="<?php echo $tipo[0]['tipo_prod']; ?>">
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