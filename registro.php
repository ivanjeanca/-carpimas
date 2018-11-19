<<?php include('header.php'); ?>

<section>
	<div class="container-fluid">
		<div class="row">
			<div class="jumbotron col-md-12">
				<div class="row">
					<div class="col-md-3"></div>
					<div class="alert alert-success col-md-6" role="alert">
						<h2 class="text-center font-weight-250">Registro</h2>
						<form class="needs-validation" novalidate>
							<div class="form-row">
								<div class="col-md-6">
									<label for="nombre">Nombre</label>
									<input type="text" class="form-control" id="nombre" placeholder="Nombre" required>
									<div class="invalid-feedback">
										Escribe tu nombre.
									</div>
								</div>
								<div class="col-md-6">
									<label for="apellido">Apellido</label>
									<input type="text" class="form-control" id="apellido" placeholder="Apellido" required>
									<div class="invalid-feedback">
										Escribe tu apellido.
									</div>
								</div>
							</div>
							<div class="form-row separador-25">
								<div class="col-md-6">
									<label for="contra1">Contraseña</label>
									<input type="password" class="form-control" id="contra1" placeholder="Contraseña" required>
									<div class="invalid-feedback">
										Escribe una contraseña.
									</div>
								</div>
								<div class="col-md-6">
									<label for="contra2">Vuelve a escribir la contraseña</label>
									<input type="password" class="form-control" id="contra2" placeholder="Contraseña" required>
									<div class="invalid-feedback">
										Escribe una contraseña.
									</div>
								</div>
							</div>
							<div class="form-row separador-25">
								<div class="col-md-12">
									<label for="correo1">Correo Electrónico</label>
									<div class="input-group">
										<input type="email" class="form-control" id="correo1" placeholder="Correo Electrónico" required>
										<div class="invalid-feedback">
											Escribe un correo electrónico válido.
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<label for="correo2">Vuelve a escribir el Correo Electrónico</label>
									<div class="input-group">
										<input type="email" class="form-control" id="correo2" placeholder="Correo Electrónico" required>
										<div class="invalid-feedback">
											Escribe un correo electrónico válido.
										</div>
									</div>
								</div>
							</div>
							<div class="form-row separador-25">
								<div class="col-md-6">
									<label for="ciudad">Ciudad</label>
									<input type="text" class="form-control" id="ciudad" placeholder="Ciudad" required>
									<div class="invalid-feedback">
										Escribe una ciudad válida.
									</div>
								</div>
								<div class="col-md-6">
									<label for="estado">Estado</label>
									<input type="text" class="form-control" id="estado" placeholder="Estado" required>
									<div class="invalid-feedback">
										Escribe un estado válido.
									</div>
								</div>
							</div>
							<div class="form-row">
								<div class="col-md-6">
									<label for="cp">Código Postal</label>
									<input type="text" class="form-control" id="cp" placeholder="Código Postal" required>
									<div class="invalid-feedback">
										Escribe un código postal valido.
									</div>
								</div>
								<div class="col-md-6">
									<label for="direccion">Dirección</label>
									<input type="text" class="form-control" id="direccion" placeholder="Dirección" required>
									<div class="invalid-feedback">
										Provee una dirección valida.
									</div>
								</div>
							</div>
							<div class="form-group separador-25">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
									<label class="form-check-label" for="invalidCheck">
										Acepto los términos y condiciones de CarpiMás.
									</label>
									<div class="invalid-feedback">
										Debes aceptar los términos y condiciones.
									</div><small id="terminos" class="form-text text-muted text-left"><a href="legal.html" target="_blank">Ver Términos y Condiciones.</a></small>
								</div>
								<small id="registrohelp" class="form-text text-muted text-right">¿Ya estás registrado? <a href="carrito.html">Inicia sesión aquí.</a></small>
							</div>
							<div class="text-center">
								<button class="btn btn-success" type="submit">Registrarse</button>

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
	<div class="separador-25"></div>
</section>

<<?php include('footer.php'); ?>