<?php
	include('../core/carpimas.class.php');

	$sesion_nav = "";
	if(is_null($_SESSION['email']))
		$sesion_nav = "<a class=\"nav-link lead\" href=\"login.php\">Iniciar sesión</a>";
	else
		$sesion_nav = "<a class=\"nav-link lead\" href=\"logout.php\" title=\"Sesión actual\">".$_SESSION['email']."</a>";

	$web = new Carpimas;
	$web->Conexion();
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
<nav class="sticky-top py-1 navbar navbar-expand-lg navbar-dark bg-dark-half bg-red-half"> <!-- Barra de navegacion -->
	<a class="navbar-brand" href="index.php">
		<img src="../images/Carpimas-Logo.png" height="30" class="d-inline-block align-top" alt="Logo Carpimas">
	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarNav">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item">
				<a class="nav-link lead" href="productos.php">Productos</a>
			</li>
			<li class="nav-item dropdown">
			<a class="nav-link lead dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Productos</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="material.php">Material</a>
					<a class="dropdown-item" href="tipo_producto.php">Tipo de producto</a>
					<a class="dropdown-item" href="color.php">Color</a>
				</div>
			</li>
			<li class="nav-item dropdown">
			<a class="nav-link lead dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Usuario</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="pais.php">Pais</a>
					<a class="dropdown-item" href="estado.php">Estado</a>
					<a class="dropdown-item" href="ciudad.php">Ciudad</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="usuarios.php">Usuarios/Administradores</a>
				</div>
			</li>
			<li class="nav-item dropdown">
			<a class="nav-link lead dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Carrito</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="envio.php">Envio</a>
					<a class="dropdown-item" href="tipo_pago.php">Tipo de pago</a>
				</div>
			</li>
		</ul>
		<span class="navbar-text">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item" style="margin-right:25px;">
					<?php echo $sesion_nav; ?>
				</li>
			</ul>
		</span>
	</div>
</nav>