<?php
include('header.php');
$web->validarRol(array("Administrador"));
$web->validarPermiso(array("CRUD"));

if(isset($_GET['id_estado'])){
	$id_estado = $_GET['id_estado'];
	if(is_numeric($id_estado)){
		if(isset($_POST['enviar'])){
			$datos = $_POST['datos'];
			$statement = $web->db->prepare("update estado set estado = :estado, id_pais = :id_pais where id_estado = :id_estado");
			$statement->bindParam(":estado", $datos['estado']);
			$statement->bindParam(":id_pais", $datos['id_pais']);
			$statement->bindParam(":id_estado", $id_estado);
			$statement->execute();
			echo '<div class="alert alert-success" role="alert">El Estado se actualizó correctamente.<a href="estado.php" class="btn btn-dark" style="margin-left:30px;">Volver a Estados</a></div>';
		}
		$parametros[':id_estado'] = $id_estado;
		$estados = $web->queryArray("select * from estado where id_estado = :id_estado", $parametros);
	}
}
?>

<h1 class="display-4">Actualizar estado</h1>
<hr>

<div class="container">
	<form action="estado.actualizar.php?id_estado=<?php echo $id_estado; ?>" method="post" class="lead">
		<div class="form-group">
			<label>Estado</label>
	   		<input type="text" name="datos[estado]" required class="form-control" value="<?php echo $estados[0]['estado']; ?>">
		</div>	
		<div class="form-group">
			<label>Color</label> 
			<select name="datos[id_pais]" id="id_pais" class="form-control">
			<?php
			$paises = $web->obtenerPais();
			for($i=0; $i<count($paises); $i++){
				$seleccionado = "";
				if($estados[0]['id_pais'] == $paises[$i]['id_pais'])
					$seleccionado = "selected";
				echo "<option $seleccionado value ='".$paises[$i]['id_pais']."'>".$paises[$i]['pais']."</option>";
			}
			?>
			</select>
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