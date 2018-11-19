<?php 
include('header.php'); 
$pais = $web->obtenerPais();
?>

<h1 class="display-4">País</h1>
<hr>

<div class="container">
	<a href="pais.insertar.php" class="btn btn-info">Insertar nuevo país</a>
	
	<table class="table separador-25 lead">
		<tr>
			<th>País</th>
			<th>Actualizar</th>
			<th>Eliminar</th>
		</tr>

		<?php for ($i=0; $i < count($pais); $i++) { ?>
			<tr>
				<td><?php echo $pais[$i]['pais']; ?></td>
				<td><a href="pais.actualizar.php?id_pais=<?php echo $pais[$i]['id_pais'];?>" class="btn btn-dark">Actualizar</a></td>
				<td><a href="pais.eliminar.php?id_pais=<?php echo $pais[$i]['id_pais'];?>" class="btn btn-danger">Eliminar</a></td>
			</tr>
		<?php } ?>
	</table>
</div>

<hr>

<?php include('footer.php'); ?>