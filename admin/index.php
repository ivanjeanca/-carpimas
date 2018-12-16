<?php 
include('header.php'); 
$web->validarRol(array("Administrador"));
$web->validarPermiso(array("CRUD"));
?>

<div class="container">
    <div class="row">
        <div class="jumbotron container-fluid">
            <h1 class="display-4 text-center" style="font-size:30px;">Bienvenido administrador, <strong><?php echo $_SESSION['email']; ?></strong>.</h1>
            <hr>
            <p class="lead text-center">Para hacer ajustes a la página, selecciona alguna opcion de la barra de navegación o tambien puedes seleccionar de esta lista.</p>
            <ul>
                <li style="list-style:none;"><a href="ciudad.php" title="Ciudades" class="nav-link lead">Ciudades</a></li>
                <li style="list-style:none;"><a href="color.php" title="Colores" class="nav-link lead">Colores</a></li>
                <li style="list-style:none;"><a href="envio.php" title="Envío" class="nav-link lead">Envío</a></li>
                <li style="list-style:none;"><a href="estado.php" title="Estados" class="nav-link lead">Estados</a></li>
                <li style="list-style:none;"><a href="material.php" title="Materiales" class="nav-link lead">Materiales</a></li>
                <li style="list-style:none;"><a href="pais.php" title="Países" class="nav-link lead">Países</a></li>
                <li style="list-style:none;"><a href="productos.php" title="Productos" class="nav-link lead">Productos</a></li>
                <li style="list-style:none;"><a href="tipo_pago.php" title="Tipos de pago" class="nav-link lead">Tipos de pago</a></li>
                <li style="list-style:none;"><a href="tipo_producto.php" title="Tipos de producto" class="nav-link lead">Tipos de producto</a></li>
            </ul>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>