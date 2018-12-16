<?php 
include('header.php'); 
$web->validarRol(array("Administrador"));
$web->validarPermiso(array("CRUD"));

$tipo_pago = $web->obtenerTipoPago();
?>

<h1 class="display-4">Tipo de pago</h1>
<hr>

<div class="container">
	<a href="tipo_pago.insertar.php" class="btn btn-info">Insertar nuevo Tipo de pago</a>
	
	<table class="table separador-25 lead">
		<tr>
			<th>Tipo</th>
			<th>Actualizar</th>
			<th>Eliminar</th>
		</tr>

		<?php for ($i=0; $i < count($tipo_pago); $i++) { ?>
			<tr>
				<td><?php echo $tipo_pago[$i]['tipo_pago']; ?></td>
				<td><a href="tipo_pago.actualizar.php?id_tipo_pago=<?php echo $tipo_pago[$i]['id_tipo_pago'];?>" class="btn btn-dark">Actualizar</a></td>
				<td><a href="tipo_pago.eliminar.php?id_tipo_pago=<?php echo $tipo_pago[$i]['id_tipo_pago'];?>" class="btn btn-danger">Eliminar</a></td>
			</tr>
		<?php } ?>
	</table>
</div>

<hr>

<?php include('footer.php'); ?>