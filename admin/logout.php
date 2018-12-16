<?php 
include('header.php');
$web->validarRol(array("Administrador"));
$web->validarPermiso(array("CRUD"));

if(!is_null($_SESSION['email'])){
    if(isset($_POST['logout'])){
        $web->logout();
        header("Location: login.php");
    }
} else {
    header("Location: login.php");
}
?>

<div class="jumbotron">
    <h5 class="display-4">Sesión actual</h5>
    <hr class="my-4">
    <div class="container">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6 text-center">
                <h1 class="display-4" style="font-size:40px;">Sesion iniciada como:</h1>
                <p class="lead" style="font-size:30px;"><strong><?php echo $_SESSION['email']; ?></strong></p>
                <form action="logout.php" method="post">
                    <input type="submit" name="logout" value="Cerrar sesión" class="btn btn-danger btn-lg">
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>