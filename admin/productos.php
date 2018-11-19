<?php	
	include ('header.php');
	$productos = $web->obtenerAllProductos();
?>

<h1 class="display-4">Productos</h1>
<hr>
<div class="container-fluid">
<a href="productos.insertar.php" class="btn btn-info">Nuevo Producto</a>
<hr>
    <table class="table">
        <tr>
            <th>Producto</th>
            <th>Descripcion</th>
            <th>Precio</th>
            <th>Color</th>
            <th>Modelo</th>
            <th>Alto</th>
            <th>Ancho</th>
            <th>Largo</th>
            <th>Material</th>
            <th>Tipo</th>
            <th>Foto</th>
            <th>Fecha Entregado</th>
            <th>Actualizar</th>
            <th>Eliminar</th>
        </tr>
    <?php for($i = 0; $i < count($productos); $i++): ?>
        <tr>
            <td><?php echo substr($productos[$i]['producto'], 0, 15) ?>...</td>
            <td><?php echo substr($productos[$i]['descripcion'], 0, 15) ?>...</td>
            <td><?php echo $productos[$i]['precio'] ?></td>
            <td><?php echo $productos[$i]['color'] ?></td>
            <td><?php echo $productos[$i]['modelo'] ?></td>
            <td><?php echo $productos[$i]['alto'] ?></td>
            <td><?php echo $productos[$i]['ancho'] ?></td>
            <td><?php echo $productos[$i]['largo'] ?></td>
            <td><?php echo $productos[$i]['material'] ?></td>
            <td><?php echo $productos[$i]['tipo_prod'] ?></td>
            <td><?php echo substr($productos[$i]['foto'], 0, 10) ?>...</td>
            <td><?php echo $productos[$i]['fecha_entregado'] ?></td>
            <td><a href="productos.actualizar.php?id_producto=<?php echo $productos[$i]['id_producto']; ?>" class="btn btn-dark">Actualizar</a></td>
            <td><a href="productos.eliminar.php?id_producto=<?php echo $productos[$i]['id_producto']; ?>" class="btn btn-danger">Eliminar</a></td>
        </tr>
    <?php endfor; ?>
    </table>
</div>
<?php include('footer.php'); ?>