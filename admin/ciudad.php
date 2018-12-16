<?php 
include('header.php'); 

$web->validarRol(array("Administrador"));
$web->validarPermiso(array("CRUD"));

$ciudades = $web->obtenerCiudad();
?>

<h1 class="display-4">Ciudades</h1>
<hr>

<div class="container">
	<a href="ciudad.insertar.php" class="btn btn-info">Insertar nueva ciudad</a>
	
	<table class="table separador-25 lead">
		<tr>
			<th>Ciudad</th>
			<th>País</th>
			<th>Actualizar</th>
			<th>Eliminar</th>
		</tr>

		<?php for ($i=0; $i < count($ciudades); $i++) { ?>
			<tr>
				<td><?php echo $ciudades[$i]['ciudad']; ?></td>
				<td><?php echo $ciudades[$i]['estado']; ?></td>
				<td><?php echo $ciudades[$i]['pais']; ?></td>
				<td><a href="ciudad.actualizar.php?id_ciudad=<?php echo $ciudades[$i]['id_ciudad'];?>" class="btn btn-dark">Actualizar</a></td>
				<td><a href="ciudad.eliminar.php?id_ciudad=<?php echo $ciudades[$i]['id_ciudad'];?>" class="btn btn-danger">Eliminar</a></td>
			</tr>
		<?php } ?>
	</table>
</div>

<hr>

<?php include('footer.php'); ?>