<?php
include('header.php');
$web->validarRol(array("Administrador"));
$web->validarPermiso(array("CRUD"));

if(isset($_GET['id_pais'])){
	$id_pais = $_GET['id_pais'];
	if(is_numeric($id_pais)){
		if(isset($_POST['enviar'])){
			$pais = $_POST['pais'];
			$statement = $web->db->prepare("update pais set pais = :pais where id_pais = :id_pais");
			$statement->bindParam(":pais", $pais);
			$statement->bindParam(":id_pais", $id_pais);
			$statement->execute();
			echo '<div class="alert alert-success" role="alert">El pais se actualizó correctamente.<a href="pais.php" class="btn btn-dark" style="margin-left:30px;">Volver a Material</a></div>';
		}
		$parametros[':id_pais'] = $id_pais;
		$tipo = $web->queryArray("select * from pais where id_pais = :id_pais", $parametros);
	}
}
?>

<h1 class="display-4">Actualizar pais</h1>
<hr>

<div class="container">
	<form action="pais.actualizar.php?id_pais=<?php echo $id_pais; ?>" method="post" class="lead">
		<div class="form-group">
			<label>Material</label>
	   		<input type="text" name="pais" required class="form-control" value="<?php echo $tipo[0]['pais']; ?>">
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