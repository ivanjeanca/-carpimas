<?php
include('header.php');
$web->validarRol(array("Administrador"));
$web->validarPermiso(array("CRUD"));

if(isset($_GET['id_ciudad'])){
	$id_ciudad = $_GET['id_ciudad'];
	if(is_numeric($id_ciudad)){
		if(isset($_POST['enviar'])){
			$datos = $_POST['datos'];
			$statement = $web->db->prepare("update ciudades set ciudad = :ciudad, id_estado = :id_estado where id_ciudad = :id_ciudad");
			$statement->bindParam(":ciudad", $datos['ciudad']);
			$statement->bindParam(":id_estado", $datos['id_estado']);
			$statement->bindParam(":id_ciudad", $id_ciudad);
			$statement->execute();
			echo '<div class="alert alert-success" role="alert">La Ciudad se actualizó correctamente.<a href="ciudad.php" class="btn btn-dark" style="margin-left:30px;">Volver a Ciudades</a></div>';
		}
		$parametros[':id_ciudad'] = $id_ciudad;
		$ciudades = $web->queryArray("select * from ciudades where id_ciudad = :id_ciudad", $parametros);
	}
}
?>

<h1 class="display-4">Actualizar ciudad</h1>
<hr>

<div class="container">
	<form action="ciudad.actualizar.php?id_ciudad=<?php echo $id_ciudad; ?>" method="post" class="lead">
		<div class="form-group">
			<label>ciudad</label>
	   		<input type="text" name="datos[ciudad]" required class="form-control" value="<?php echo $ciudades[0]['ciudad']; ?>">
		</div>	
		<div class="form-group">
			<label>Color</label> 
			<select name="datos[id_estado]" id="id_estado" class="form-control">
			<?php
			$estados = $web->obtenerEstado();
			for($i=0; $i<count($estados); $i++){
				$seleccionado = "";
				if($ciudades[0]['id_estado'] == $estados[$i]['id_estado'])
					$seleccionado = "selected";
				echo "<option $seleccionado value ='".$estados[$i]['id_estado']."'>".$estados[$i]['estado']."</option>";
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