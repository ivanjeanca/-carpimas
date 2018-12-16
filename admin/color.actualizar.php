<?php
include('header.php');
$web->validarRol(array("Administrador"));
$web->validarPermiso(array("CRUD"));

if(isset($_GET['id_color'])){
	$id_color = $_GET['id_color'];
	if(is_numeric($id_color)){
		if(isset($_POST['enviar'])){
			$color = $_POST['color'];
			$statement = $web->db->prepare("update color set color = :color where id_color = :id_color");
			$statement->bindParam(":color", $color);
			$statement->bindParam(":id_color", $id_color);
			$statement->execute();
			echo '<div class="alert alert-success" role="alert">El color se actualizó correctamente.<a href="color.php" class="btn btn-dark" style="margin-left:30px;">Volver a Color</a></div>';
		}
		$parametros[':id_color'] = $id_color;
		$tipo = $web->queryArray("select * from color where id_color = :id_color", $parametros);
	}
}
?>

<h1 class="display-4">Actualizar color</h1>
<hr>

<div class="container">
	<form action="color.actualizar.php?id_color=<?php echo $id_color; ?>" method="post" class="lead">
		<div class="form-group">
			<label>Color</label>
	   		<input type="text" name="color" required class="form-control" value="<?php echo $tipo[0]['color']; ?>">
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