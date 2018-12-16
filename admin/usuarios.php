<?php	
include('header.php');
$web->validarRol(array("Administrador"));
$web->validarPermiso(array("CRUD"));

$usuarios = $web->obtenerAllUsuarios();
?>

<h1 class="display-4">Usuarios</h1>
<hr>
<div class="container-fluid">
<hr>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Rol</th>
            <th>Hacer Administrador</th>
            <th>Eliminar</th>
        </tr>
    <?php for($i = 0; $i < count($usuarios); $i++): ?>
        <tr>
            <td><?php echo $usuarios[$i]['id_usuario']; ?></td>
            <td><?php echo $usuarios[$i]['nombre']; ?></td>
            <td><?php echo $usuarios[$i]['correo']; ?></td>
            <td><?php echo $usuarios[$i]['rol']; ?></td>
            <td>
                <?php if($usuarios[$i]['id_usuario'] != 1){ 
                        if($usuarios[$i]['rol'] != 'Administrador'){ ?>
                <a href="usuarios.haceradmin.php?id_usuario=<?php echo $usuarios[$i]['id_usuario']; ?>" class="btn btn-warning">Hacer Administrador</a>
                    <?php } else { ?>
                <a href="usuarios.quitaradmin.php?id_usuario=<?php echo $usuarios[$i]['id_usuario']; ?>" class="btn btn-info">Quitar Administrador</a>
                    <?php } } ?>
            </td>
            <td>
            <?php if($usuarios[$i]['id_usuario'] != 1){ ?>    
                <a href="usuarios.eliminar.php?id_usuario=<?php echo $usuarios[$i]['id_usuario']; ?>" class="btn btn-danger">Eliminar</a></td>
            <?php } ?>
        </tr>
    <?php endfor; ?>
    </table>
</div>
<?php include('footer.php'); ?>