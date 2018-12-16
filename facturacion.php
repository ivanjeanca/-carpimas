<?php 
include('header.php');

if(isset($_POST['confirmar'])){
    if(!is_null($_SESSION['email'])){
        if($_SESSION['valido'] == 1 && in_array('Cliente', $_SESSION['roles']) && in_array('Comprar', $_SESSION['permisos'])){ ?>
<div class="container">
    <form action="compra_realizada.php" method="post">
        <h1 class="display-4">Información de facturación</h1>
        <hr>
        <label class="lead" for="id_tipo_pago">Selecciona un método de pago</label> 
        <select name="id_tipo_pago" id="id_tipo_pago" class="form-control" required>
        <?php
        $tipo_pago = $web->obtenerTipoPago();
        for($i=0; $i<count($tipo_pago); $i++)
            echo "<option value ='".$tipo_pago[$i]['id_tipo_pago']."'>".$tipo_pago[$i]['tipo_pago']."</option>";
        ?>
        </select>
        <br />
        <div class="row">
            <div class="col-md-6">
                <label for="id_ciudad" class="lead">Ciudades disponibles</label>
                <select name="id_ciudad" id="id_ciudad" class="form-control" required>
                <?php
                $ciudad = $web->obtenerCiudad();
                for($i=0; $i<count($ciudad); $i++)
                    echo "<option value ='".$ciudad[$i]['id_ciudad']."'>".$ciudad[$i]['ciudad']."</option>";
                ?>
                </select>
            </div>
            <div class="col-md-6">
                <label for="id_envio" class="lead">Tipo de envío</label>
                <select name="id_envio" id="id_envio" class="form-control" required>
                <?php
                $tipo_envio = $web->obtenerEnvio();
                for($i=0; $i<count($tipo_envio); $i++)
                    echo "<option value ='".$tipo_envio[$i]['id_envio']."'>".$tipo_envio[$i]['envio']."</option>";
                ?>
                </select>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-md-8">
                <label for="direccion" class="lead">Dirección de facturación</label>
                <input type="text" name="direccion" required maxlength="100" id="direccion" placeholder="Dirección de facturación" class="form-control">
            </div>
            <div class="col-md-2">
                <label for="numero_ext" class="lead">Número exterior</label>
                <input type="number" min="1" max="99999" required name="numero_ext" id="numero_ext" placeholder="Número exterior" class="form-control">
            </div>
            <div class="col-md-2">
                <label for="numero_int" class="lead">Número interior</label>
                <input type="number" min="1" max="99999" name="numero_int" id="numero_int" placeholder="Número interior" class="form-control">
            </div>
        </div>
        <br />
        <div class="text-right">
            <input type="submit" value="Confirmar información de facturación" class="btn btn-success">
        </div>
    </form>
</div>
        <?php } else { ?>
            <div class="container">
                <div class="row">
                    <h1 class="display-4">Error al comprar</h1>
                    <hr>
                    <p class="lead">Tu cuenta no cuenta con los permisos necesarios para realizar la compra, inicia sesion con una cuenta que pueda realizar compras o bien, sea cliente.</p>
                    <hr>
                    <a href="logout.php" class="btn btn-danger btn-lg">Cerrar sesión</a>
                </div>
            </div>
        <?php }
    } else {
        header("Location: login.php?auth=required");
    }
} else {
    header("Location: index.php");
}
?>
<div class="separador-50"></div>
<?php include('footer.php'); ?>