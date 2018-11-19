<?php 
include('header.php');
if(isset($_POST['enviar'])){
	$foto = $_FILES['foto']['name'];
	$foto_size = $_FILES['foto']['size'];
	$foto_tmp = $_FILES['foto']['tmp_name'];
	$origen = $foto_tmp;
	$cualquiera = substr(md5(rand()), 20);
	$foto = $cualquiera . "_" . $foto;
	$foto = str_replace(" ", "_", $foto);
	$destino = "../images/productos/".$foto;

	if ($web->validarArchivo($_FILES['foto'])) {
		if(move_uploaded_file($origen, $destino)){
			$statement = $web->db->prepare("insert into producto (producto, descripcion, precio, id_color, modelo, alto, ancho, largo, id_material, id_tipo_prod, foto, fecha_entregado) values (:producto, :descripcion, :precio, :id_color, :modelo, :alto, :ancho, :largo, :id_material, :id_tipo_prod, :foto, :fecha_entregado)");
			$statement->bindParam(":producto", $_POST['producto']);
			$statement->bindParam(":descripcion", $_POST['descripcion']);
			$statement->bindParam(":precio", $_POST['precio']);
			$statement->bindParam(":id_color", $_POST['id_color']);
			$statement->bindParam(":modelo", $_POST['modelo']);
			$statement->bindParam(":alto", $_POST['alto']);
			$statement->bindParam(":ancho", $_POST['ancho']);
			$statement->bindParam(":largo", $_POST['largo']);
			$statement->bindParam(":id_material", $_POST['id_material']);
			$statement->bindParam(":id_tipo_prod", $_POST['id_tipo_prod']);
			$statement->bindParam(":foto", $foto);
			$statement->bindParam(":fecha_entregado", $_POST['fecha_entregado']);
			$statement->execute();
			echo '<div class="alert alert-success" role="alert">El producto se insertó correctamente.<a href="productos.php" class="btn btn-primary" style="margin-left:30px;">Volver a Productos</a></div>';
		} else
			echo '<div class="alert alert-danger" role="alert">Error desconocido.</div>';
	} else
		echo '<div class="alert alert-danger" role="alert">Error, la imagen/archivo no cumple con las características.</div>';
}
?>

<h1 class="display-4">Insertar Producto</h1>
<hr>

<form action="productos.insertar.php" method="post" class="form container" enctype="multipart/form-data">
	<div class="form-group">
			<label>Fotografía (Tamaño máximo de 2MB)</label>
			<input type="file" name="foto" class="form-control">
	</div>
	<div class="form-group">
		<label>Producto</label> 
		<input type="text" name="producto" required maxlength="100" class="form-control">
	</div>
	<div class="form-group">
		<label>Descripcion</label> 
		<textarea name="descripcion" required rows="3" class="form-control"></textarea>
	</div>
	<div class="form-group">
		<label>Precio</label> 
        <input type="number" required name="precio" min="0" value="0" step=".50" class="form-control">
	</div>
	<div class="form-group">
		<label>Color</label> 
		<select name="id_color" id="id_color" class="form-control">
		<?php
		$color = $web->obtenerColor();
		for($i=0; $i<count($color); $i++){
			echo "<option value ='".$color[$i]['id_color']."'>".$color[$i]['color']."</option>";
		}
		?>
		</select>
	</div>
	<div class="form-group">
		<label>Modelo</label> 
		<input type="text" name="modelo" required maxlength="100" class="form-control">
	</div>
	<div class="form-group">
		<label>Alto (en metros)</label> 
		<input type="number" name="alto" maxlength="2" max="20" min="0" value="0" step=".05" class="form-control">
	</div>
	<div class="form-group">
		<label>Ancho (en metros)</label> 
		<input type="number" name="ancho" maxlength="2" max="20" min="0" value="0" step=".05" class="form-control">
	</div>
	<div class="form-group">
		<label>Largo (en metros)</label> 
		<input type="number" name="largo" maxlength="2" max="20" min="0" value="0" step=".05" class="form-control">
	</div>
	<div class="form-group">
		<label>Material</label> 
		<select name="id_material" id="id_material" class="form-control">
		<?php
		$material = $web->obtenerMaterial();
		for($i=0; $i<count($material); $i++){
			echo "<option value ='".$material[$i]['id_material']."'>".$material[$i]['material']."</option>";
		}
		?>
		</select>
	</div>
	<div class="form-group">
		<label>Tipo</label> 
		<select name="id_tipo_prod" id="id_tipo_prod" class="form-control">
		<?php
		$tipo = $web->obtenerTipoProducto();
		for($i=0; $i<count($tipo); $i++){
			echo "<option value ='".$tipo[$i]['id_tipo_prod']."'>".$tipo[$i]['tipo_prod']."</option>";
		}
		?>
		</select>
	</div>
	<div class="form-group">
			<label>Fecha de trabajo entregado</label>
			<input type="date" name="fecha_entregado" class="form-control">
	</div>
	<input type="submit" name="enviar" value="Guardar" class="btn btn-dark" >
</form>

<?php include('footer.php'); ?>