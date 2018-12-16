<?php 
include('header.php'); 

if(isset($_GET['auth'])){
	if($_GET['auth'] == 'required')
		$autentificacion = "?auth=required";
	else
		$autentificacion = "";
} else
	$autentificacion = "";

$msg = "";
$correo = isset($_POST['correo']) ? $_POST['correo'] : null;
$contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : null;

if(is_null($_SESSION['email'])){
	if(!is_null($correo) && !is_null($contrasena)){
		if($web->login($correo, $contrasena)){
			$_SESSION['valido'] = true;
			$_SESSION['email'] = $correo;
			$_SESSION['roles'] = $web->obtenerRoles($correo);
			$_SESSION['permisos'] = $web->obtenerPermisos($correo);
			
			if($autentificacion)
				header("Location: carrito_compras.php");
			else 
				header("Location: index.php");
		} else {
			$web->logout();
			$msg = '<div class="alert alert-danger text-center" role="alert">Login incorrecto: Usuario/contraseña inválido(s).<br /><label style="font-size:14px";>Si olvidaste tu contraseña, puedes <a href="recuperar.php">recuperarla aquí</a>.</label></div>';
		}
	} else {
		$web->logout();
	}
} else {
	header("Location: logout.php");
}
?>

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
						<div class="alert alert-primary col-md-6" role="alert">
							<?php echo $msg; ?>
							<h2 class="text-center font-weight-250">Iniciar Sesión</h2>
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
									<small id="emailHelp" class="form-text text-muted text-right">¿No estás registrado? <a href="registro.php">Registrate aquí.</a></small>
								</div>
								<div class="text-center">
									<button class="btn btn-primary separador-25 text-center" type="submit">Iniciar Sesión</button>
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
<?php include('footer.php'); ?>