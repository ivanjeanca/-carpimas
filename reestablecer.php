<?php
include('header.php');

if(!is_null($_SESSION['email']))
    header("Location: logout.php");

if(isset($_GET['llave'])){
    $llave = $_GET['llave'];
    $datos = $web->queryArray("select * from usuario where llave = :llave", array(':llave'=>$llave));
    if(isset($datos[0])){
        if(isset($_POST['recuperar'])){
            $contraseña = md5($_POST['contrasena']);
            $sql = "update usuario set contrasena = :contrasena, llave = null where llave = :llave";
            $statement = $web->db->prepare($sql);
            $statement->bindParam(":contrasena", $contraseña);
            $statement->bindParam(":llave", $llave);
            if($statement->execute())
            echo "Si agarró la query y actualizo todo";
            header("Location: login.php");
        }
    } else
        die("La llave expiró");
} else
    die();
?>

 <div class="container-fluid">
    <h1 class="display-4">Reestablecer contraseña</h1>
    <hr>
    <div class="container">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <div class="jumbotron">
                    <form class="form-signin" action="reestablecer.php?llave=<?php echo $llave ?>" method="POST">
                        <h1 class="h3 mb-3 font-weight-normal">Reestablecer contraseña</h1>
                        <label for="inputPassword" class="sr-only">Nueva contraseña</label>
                        <input type="password" id="inputPassword" name="contrasena" class="form-control" placeholder="Contraseña" required="">
                        <br />
                        <button class="btn btn-lg btn-primary btn-block" type="submit" name="recuperar">Reestablecer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>