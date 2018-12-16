<?php 
include('header.php'); 
$msg = "";

if(!is_null($_SESSION['email']))
	header("Location: index.php");

if(isset($_POST['registrar'])){
	$checar_duplicado = $web->queryArray("select id_usuario from usuario where (correo = :correo)", array(":correo"=>$_POST['correo']));
	if(count($checar_duplicado) == 0){
		$sql = "insert into usuario(nombre, apellido, correo, contrasena) values (:nombre, :apellido, :correo, md5(:contrasena))";
		$statement = $web->db->prepare($sql);
		$statement->bindParam(":nombre", $_POST['nombre']);
		$statement->bindParam(":apellido", $_POST['apellido']);
		$statement->bindParam(":correo", $_POST['correo']);
		$statement->bindParam(":contrasena", $_POST['contrasena']);
		$statement->execute();

		$id_usuario = $web->queryArray("select id_usuario from usuario where (correo = :correo) and (contrasena = md5(:contrasena))", array(":correo"=>$_POST['correo'], ":contrasena"=>$_POST['contrasena']));
		
		if(count($id_usuario) == 0) 
			die("No se encontró el usuario /registro mal en la bd");
		$sql = "insert into rol_usuario(id_rol, id_usuario) values (2, :id_usuario);";
		$statement = $web->db->prepare($sql);
		$statement->bindParam(":id_usuario", $id_usuario[0]['id_usuario']);
		$statement->execute();
		
		header("Location: login.php");
	} else {
		$msg = '<div class="alert alert-danger text-center" role="alert">Ya existe un usuario con este correo electrónico.</div>';
	}
}
?>

<section>
	<div class="container-fluid">
		<div class="row">
			<div class="jumbotron col-md-12">
				<h1 class="display-4">Registro</h1>
				<hr>
				<div class="row">
					<div class="col-md-3"></div>
					<div class="alert alert-success col-md-6" role="alert">
						<?php echo $msg; ?>
						<h2 class="text-center font-weight-250">Llena los campos para efectuar tu registro</h2>
						<hr class="my-3">
						<form class="needs-validation" novalidate method="post" action="registro.php">
							<div class="form-row">
								<div class="col-md-6">
									<label for="nombre">Nombre</label>
									<input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre" required>
									<div class="invalid-feedback">
										Escribe tu nombre.
									</div>
								</div>
								<div class="col-md-6">
									<label for="apellido">Apellido</label>
									<input type="text" class="form-control" id="apellido" placeholder="Apellido" name="apellido" required>
									<div class="invalid-feedback">
										Escribe tu apellido.
									</div>
								</div>
							</div>
							<div class="form-row separador-25">
								<div class="col-md-12">
									<label for="correo1">Correo Electrónico</label>
									<div class="input-group">
										<input type="email" class="form-control" id="correo1" placeholder="Correo Electrónico" name="correo" required>
										<div class="invalid-feedback">
											Escribe un correo electrónico válido.
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<label for="contra1">Contraseña</label>
									<input type="password" class="form-control" id="contra1" placeholder="Contraseña" name="contrasena" required>
									<div class="invalid-feedback">
										Escribe una contraseña.
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
									</div><small id="terminos" class="form-text text-muted text-left"><a href="legal.php" target="_blank">Ver Términos y Condiciones.</a></small>
								</div>
								<small id="registrohelp" class="form-text text-muted text-right">¿Ya estás registrado? <a href="login.php">Inicia sesión aquí.</a></small>
							</div>
							<div class="text-center">
								<input class="btn btn-success" type="submit" value="Registrarte" name="registrar">
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
	<div class="separador-25"></div>
</section>

<<?php include('footer.php'); ?>