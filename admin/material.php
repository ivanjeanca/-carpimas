<?php 
include('header.php'); 
$web->validarRol(array("Administrador"));
$web->validarPermiso(array("CRUD"));

$material = $web->obtenerMaterial();
?>

<h1 class="display-4">Material</h1>
<hr>

<div class="container">
	<a href="material.insertar.php" class="btn btn-info">Insertar nuevo material</a>
	
	<table class="table separador-25 lead">
		<tr>
			<th>Material</th>
			<th>Actualizar</th>
			<th>Eliminar</th>
		</tr>

		<?php for ($i=0; $i < count($material); $i++) { ?>
			<tr>
				<td><?php echo $material[$i]['material']; ?></td>
				<td><a href="material.actualizar.php?id_material=<?php echo $material[$i]['id_material'];?>" class="btn btn-dark">Actualizar</a></td>
				<td><a href="material.eliminar.php?id_material=<?php echo $material[$i]['id_material'];?>" class="btn btn-danger">Eliminar</a></td>
			</tr>
		<?php } ?>
	</table>
</div>

<hr>

<?php include('footer.php'); ?>