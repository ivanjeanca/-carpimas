<?php include('header.php'); ?>

<section>
	<div class="container-fluid separador-25">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<div class="jumbotron">
					<div>
						<h5 class="display-4">Carrito de compras</h5>
						<p class="lead">Para acceder al carrito de compras necesitas acceder a tu cuenta.</p>
						<hr class="my-4">
					</div>
					<div class="row">
						<div class="col-md-3"></div>
						<div class="alert alert-primary col-md-6" role="alert">
							<h2 class="text-center font-weight-250">Iniciar Sesión</h2>
							<form class="needs-validation" novalidate>
								<div class="col-md-12">
									<label for="email">Correo Electrónico</label>
									<input type="email" class="form-control" id="email" placeholder="Correo Electrónico" required>
									<div class="invalid-feedback">
										Ingresa un correo electrónico válido.
									</div>
									<label for="pass">Contraseña</label>
									<input type="password" class="form-control" id="pass" placeholder="Contraseña" required>
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
						// Example starter JavaScript for disabling form submissions if there are invalid fields
						(function() {
							'use strict';
							window.addEventListener('load', function() {
						    // Fetch all the forms we want to apply custom Bootstrap validation styles to
						    var forms = document.getElementsByClassName('needs-validation');
						    // Loop over them and prevent submission
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