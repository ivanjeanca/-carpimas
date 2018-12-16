<?php 
include('header.php'); 
$web->validarRol(array("Administrador"));
$web->validarPermiso(array("CRUD"));

$estado = $web->obtenerEstado();
?>

<h1 class="display-4">Estado</h1>
<hr>
<div class="container">
	<a href="estado.insertar.php" class="btn btn-info">Insertar nuevo estado</a>
	<table class="table separador-25 lead">
		<tr>
			<th>Estado</th>
			<th>País</th>
			<th>Actualizar</th>
			<th>Eliminar</th>
		</tr>
		<?php for ($i=0; $i < count($estado); $i++) { ?>
			<tr>
				<td><?php echo $estado[$i]['estado']; ?></td>
				<td><?php echo $estado[$i]['pais']; ?></td>
				<td><a href="estado.actualizar.php?id_estado=<?php echo $estado[$i]['id_estado'];?>" class="btn btn-dark">Actualizar</a></td>
				<td><a href="estado.eliminar.php?id_estado=<?php echo $estado[$i]['id_estado'];?>" class="btn btn-danger">Eliminar</a></td>
			</tr>
		<?php } ?>
	</table>
</div>
<hr>
<?php include('footer.php'); ?>