<?php 
include('header.php'); 
$tipo_producto = $web->obtenerTipoProducto();
?>

<h1 class="display-4">Tipo de producto</h1>
<hr>

<div class="container">
	<a href="tipo_producto.insertar.php" class="btn btn-info">Insertar nuevo Tipo de producto</a>
	
	<table class="table separador-25 lead">
		<tr>
			<th>Tipo</th>
			<th>Actualizar</th>
			<th>Eliminar</th>
		</tr>

		<?php for ($i=0; $i < count($tipo_producto); $i++) { ?>
			<tr>
				<td><?php echo $tipo_producto[$i]['tipo_prod']; ?></td>
				<td><a href="tipo_producto.actualizar.php?id_tipo_prod=<?php echo $tipo_producto[$i]['id_tipo_prod'];?>" class="btn btn-dark">Actualizar</a></td>
				<td><a href="tipo_producto.eliminar.php?id_tipo_prod=<?php echo $tipo_producto[$i]['id_tipo_prod'];?>" class="btn btn-danger">Eliminar</a></td>
			</tr>
		<?php } ?>
	</table>
</div>

<hr>

<?php include('footer.php'); ?>