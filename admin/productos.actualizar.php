<?php
include('header.php');
if (isset($_GET['id_producto'])) {
    $id_producto = $_GET['id_producto'];
	if(is_numeric($id_producto)){
		if(isset($_POST['enviar'])){
			$datos = $_POST['datos'];
			$foto = $_FILES['foto']['name'];

			$sql = "update producto set producto = :producto, descripcion = :descripcion, precio = :precio, id_color = :id_color, modelo = :modelo, alto = :alto, ancho = :ancho, largo = :largo, id_material = :id_material, id_tipo_prod = :id_tipo_prod ";

			$arch = false;
			$valid = true;

			if($foto != ""){
				$foto_size = $_FILES['foto']['size'];
				$foto_tmp = $_FILES['foto']['tmp_name'];
				$origen = $foto_tmp;
				$cualquiera = substr(md5(rand()), 20);
				$foto = $cualquiera . "_" . $foto;
				$foto = str_replace(" ", "_", $foto);
				$destino = "../images/productos/" . $foto;

				if ($web->validarArchivo($_FILES['foto'])) {
					if(move_uploaded_file($origen, $destino)){
						$arch = true;
						$sql = $sql . ", foto = :foto ";
					} else 
						echo '<div class="alert alert-danger" role="alert">Error desconocido.</div>';
				} else {
					$valid = false;
					echo '<div class="alert alert-danger" role="alert">Error, la imagen/archivo no cumple con las características.</div>';
				}
			}

            $sql = $sql . ", fecha_entregado = :fecha_entregado where id_producto = :id_producto;";

			$statement = $web->db->prepare($sql);
			$statement->bindParam(":producto", $datos['producto']);
			$statement->bindParam(":descripcion", $datos['descripcion']);
			$statement->bindParam(":precio", $datos['precio']);
			$statement->bindParam(":id_color", $datos['id_color']);
			$statement->bindParam(":modelo", $datos['modelo']);
			$statement->bindParam(":alto", $datos['alto']);
			$statement->bindParam(":ancho", $datos['ancho']);
			$statement->bindParam(":largo", $datos['largo']);
			$statement->bindParam(":id_material", $datos['id_material']);
			$statement->bindParam(":id_tipo_prod", $datos['id_tipo_prod']);
			if($arch){				
				$statement->bindParam(":foto", $foto);
			}
			$statement->bindParam(":fecha_entregado", $datos['fecha_entregado']);
			$statement->bindParam(":id_producto", $id_producto, PDO::PARAM_INT);
			if($statement->execute() && $valid)
                echo '<div class="alert alert-success" role="alert">El producto se actualizó correctamente.<a href="productos.php" class="btn btn-primary" style="margin-left:30px;">Volver a Productos</a></div>';
		}
		$parametros[':id_producto'] = $id_producto;
		$sql = "select * from producto where id_producto = :id_producto;";
		$producto = $web->queryArray($sql, $parametros);
	}
}
?>

<h1 class="display-4">Actualizar producto</h1>
<hr>

<form action="productos.actualizar.php?id_producto=<?php echo $id_producto; ?>" method="post" class="form container" enctype="multipart/form-data">
	<div class="form-group">
		<label>Fotografía actual</label>
		<img src="../images/productos/<?php echo $producto[0]['foto']; ?>" class="img-fluid" style="max-height: 300px; margin-left: 20px; max-width:90%;">
	</div>
	<div class="form-group">
		<label>Producto</label> 
		<input type="text" name="datos[producto]" required maxlength="100" class="form-control" value="<?php echo $producto[0]['producto']; ?>">
	</div>
	<div class="form-group">
		<label>Descripcion</label> 
		<textarea name="datos[descripcion]" required rows="3" class="form-control"><?php echo $producto[0]['descripcion']; ?></textarea>
	</div>
	<div class="form-group">
		<label>Precio</label> 
        <input type="number" required name="datos[precio]" min="0"  value="<?php echo $producto[0]['precio']; ?>" step=".50" class="form-control">
	</div>
	<div class="form-group">
		<label>Color</label> 
		<select name="datos[id_color]" id="id_color" class="form-control">
		<?php
		$color = $web->obtenerColor();
		for($i=0; $i<count($color); $i++){
            $seleccionado = "";
			if($producto[0]['id_color'] == $color[$i]['id_color'])
				$seleccionado = "selected";
			echo "<option $seleccionado value ='".$color[$i]['id_color']."'>".$color[$i]['color']."</option>";
		}
		?>
		</select>
	</div>
	<div class="form-group">
		<label>Modelo</label> 
		<input type="text" name="datos[modelo]" required maxlength="100" class="form-control" value="<?php echo $producto[0]['modelo']; ?>">
	</div>
	<div class="form-group">
		<label>Alto (en metros)</label> 
		<input type="number" name="datos[alto]" maxlength="2" max="20" min="0"  value="<?php echo $producto[0]['alto']; ?>" step=".05" class="form-control">
	</div>
	<div class="form-group">
		<label>Ancho (en metros)</label> 
		<input type="number" name="datos[ancho]" maxlength="2" max="20" min="0"  value="<?php echo $producto[0]['ancho']; ?>" step=".05" class="form-control">
	</div>
	<div class="form-group">
		<label>Largo (en metros)</label> 
		<input type="number" name="datos[largo]" maxlength="2" max="20" min="0"  value="<?php echo $producto[0]['largo']; ?>" step=".05" class="form-control">
	</div>
	<div class="form-group">
		<label>Material</label> 
		<select name="datos[id_material]" id="id_material" class="form-control">
		<?php
		$material = $web->obtenerMaterial();
		for($i=0; $i<count($material); $i++){
            $seleccionado = "";
			if($producto[0]['id_material'] == $material[$i]['id_material'])
				$seleccionado = "selected";
			echo "<option $seleccionado value ='".$material[$i]['id_material']."'>".$material[$i]['material']."</option>";
		}
		?>
		</select>
	</div>
	<div class="form-group">
		<label>Tipo</label> 
		<select name="datos[id_tipo_prod]" id="id_tipo_prod" class="form-control">
		<?php
		$tipo = $web->obtenerTipoProducto();
		for($i=0; $i<count($tipo); $i++){
            $seleccionado = "";
			if($producto[0]['id_tipo_prod'] == $tipo[$i]['id_tipo_prod'])
				$seleccionado = "selected";
			echo "<option $seleccionado value ='".$tipo[$i]['id_tipo_prod']."'>".$tipo[$i]['tipo_prod']."</option>";
		}
		?>
		</select>
	</div>
	<div class="form-group">
			<label>Subir nueva fotografía (Tamaño máximo de 2MB)</label>
			<input type="file" name="foto" class="form-control">
	</div>
	<div class="form-group">
			<label>Fecha de trabajo entregado</label>
			<input type="date" name="datos[fecha_entregado]" class="form-control" value="<?php echo $producto[0]['fecha_entregado']; ?>">
	</div>
	<input type="submit" name="enviar" value="Actualizar" class="btn btn-dark">
</form>

<?php
include('footer.php');
?>