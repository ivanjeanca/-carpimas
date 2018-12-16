<?php 
include('../core/carpimas.class.php');
$web = new Carpimas;
$web->Conexion();
$msg = "";

if(isset($_GET['admin'])){
	if($_GET['admin'] == 'required'){
        $autentificacion = "?admin=required";
        $msg = '<div class="alert alert-warning text-center" role="alert">Login incorrecto: Debe iniciar sesión con un usuario administrador.</div>';
    } else
		$autentificacion = "";
} else
	$autentificacion = "";

$correo = isset($_POST['correo']) ? $_POST['correo'] : null;
$contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : null;

if(is_null($_SESSION['email'])){
	if(!is_null($correo) && !is_null($contrasena)){
		if($web->login($correo, $contrasena)){
			$_SESSION['valido'] = true;
			$_SESSION['email'] = $correo;
			$_SESSION['roles'] = $web->obtenerRoles($correo);
			$_SESSION['permisos'] = $web->obtenerPermisos($correo);	
			header("Location: index.php");
		} else {
			$web->logout();
			$msg = '<div class="alert alert-warning text-center" role="alert">Login incorrecto: Usuario/contraseña inválido(s).<br /><label style="font-size:14px";>Si olvidaste tu contraseña, puedes <a href="../recuperar.php">recuperarla aquí</a>.</label></div>';
		}
	} else {
		$web->logout();
	}
} else {
	header("Location: logout.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="../css/styles.css">

	<title>CarpiMás - Administrador</title>
</head>
<body>
	<section>
		<div class="container-fluid separador-25">
			<div class="row">
				<div class="col-md-1"></div>
				<div class="col-md-10">
					<div class="jumbotron">
						<div>
							<h5 class="display-4">Inicio de sesión</h5>
							<hr>
						</div>
						<div class="row">
							<div class="col-md-3"></div>
							<div class="alert alert-danger col-md-6" role="alert">
								<?php echo $msg; ?>
								<h2 class="text-center font-weight-250">Iniciar Sesión de Administrador</h2>
								<form class="needs-validation" novalidate method="post" action="login.php<?php echo $autentificacion ?>">
									<div class="col-md-12">
										<label for="email">Correo Electrónico</label>
										<input type="email" class="form-control" id="email" name="correo" placeholder="Correo Electrónico" required>
										<div class="invalid-feedback">
											Ingresa un correo electrónico válido.
										</div>
										<label for="pass">Contraseña</label>
										<input type="password" class="form-control" id="pass" name="contrasena" placeholder="Contraseña" required>
										<div class="invalid-feedback">
											Escribe la contraseña.<br />
											¿Olvidaste la contraseña? <a href="#">Recuperar Contraseña.</a>
										</div>
										<small id="emailHelp" class="form-text text-muted text-right">¿No estás registrado? <a href="../registro.php" style="color:red;">Registrate aquí.</a></small>
									</div>
									<div class="text-center">
										<button class="btn btn-danger separador-25 text-center" type="submit">Iniciar Sesión</button>
									</div>
								</form>
							</div>

						</div>
						<script>
							(function() {
								'use strict';
								window.addEventListener('load', function() {
								var forms = document.getElementsByClassName('needs-validation');
								var validation = Array.prototype.filter.call(forms, function(form) {
									form.addEventListener('submit', function(event) {
										if (form.checkValidity() === false) {
											event.preventDefault();
											event.stopPropagation();
										}
										form.classList.add('was-validated');
									}, false);
								});
							}, false);
							})();
						</script>
					</div> <!-- Jumbotron -->
				</div>
			</div>
		</div>
		<div class="separador-25"></div>
	</section>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>

<?php include('footer.php'); ?>