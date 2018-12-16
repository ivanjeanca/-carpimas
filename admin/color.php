<?php 
include('header.php');
$web->validarRol(array("Administrador"));
$web->validarPermiso(array("CRUD")); 

$color = $web->obtenerColor();
?>
<h1 class="display-4">Color</h1>
<hr>
<div class="container">
	<a href="color.insertar.php" class="btn btn-info">Insertar nuevo color</a>
	
	<table class="table separador-25 lead">
		<tr>
			<th>Color</th>
			<th>Actualizar</th>
			<th>Eliminar</th>
		</tr>

		<?php for ($i=0; $i < count($color); $i++) { ?>
			<tr>
				<td><?php echo $color[$i]['color']; ?></td>
				<td><a href="color.actualizar.php?id_color=<?php echo $color[$i]['id_color'];?>" class="btn btn-dark">Actualizar</a></td>
				<td><a href="color.eliminar.php?id_color=<?php echo $color[$i]['id_color'];?>" class="btn btn-danger">Eliminar</a></td>
			</tr>
		<?php } ?>
	</table>
</div>
<hr>
<?php include('footer.php'); ?>