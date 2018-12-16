<?php 
include('header.php'); 
$web->validarRol(array("Administrador"));
$web->validarPermiso(array("CRUD"));

$envio = $web->obtenerEnvio();
?>

<h1 class="display-4">Envío</h1>
<hr>

<div class="container">
	<a href="envio.insertar.php" class="btn btn-info">Insertar nuevo envío</a>
	
	<table class="table separador-25 lead">
		<tr>
			<th>Envío</th>
			<th>Actualizar</th>
			<th>Eliminar</th>
		</tr>

		<?php for ($i=0; $i < count($envio); $i++) { ?>
			<tr>
				<td><?php echo $envio[$i]['envio']; ?></td>
				<td><a href="envio.actualizar.php?id_envio=<?php echo $envio[$i]['id_envio'];?>" class="btn btn-dark">Actualizar</a></td>
				<td><a href="envio.eliminar.php?id_envio=<?php echo $envio[$i]['id_envio'];?>" class="btn btn-danger">Eliminar</a></td>
			</tr>
		<?php } ?>
	</table>
</div>

<hr>

<?php include('footer.php'); ?>