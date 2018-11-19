<?php
include('core/carpimas.class.php');
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
	<link rel="stylesheet" type="text/css" href="css/styles.css">

	<title>CarpiMás</title>
</head>

<body>
<nav class="sticky-top py-1 navbar navbar-expand-lg navbar-dark bg-dark-half"> <!-- Barra de navegacion -->
	<a class="navbar-brand" href="index.php">
		<img src="images/Carpimas-Logo.png" height="30" class="d-inline-block align-top" alt="Logo Carpimas">
	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarNav">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item">
				<a class="nav-link lead" href="cocinas.php">Cocinas</a>
			</li>
			<li class="nav-item">
				<a class="nav-link lead" href="closets.php">Closets</a>
			</li>
			<li class="nav-item">
				<a class="nav-link lead" href="puertas.php">Puertas</a>
			</li>
			<li class="nav-item">
				<a class="nav-link lead" href="trabajos-personalizados.php">Trabajos Personalizados</a>
			</li>
			<li class="nav-item">
				<a class="nav-link lead" href="novedades.php">Novedades</a>
			</li>
		</ul>
		<span class="navbar-text">
			<a href="carrito.php">
				<svg class="bolsa-compras" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 17" height="22">
					<g id="bolsa-vacia" data-name="Bolsa Vacia">
						<path class="bolsa-vacia-asa" fill="rgba(255,255,255,.35)" d="M1.5,3A1.5,1.5,0,0,0,0,4.5v11A1.5,1.5,0,0,0,1.5,17h11A1.5,1.5,0,0,0,14,15.5V4.5A1.5,1.5,0,0,0,12.5,3ZM13,15.5a.5.5,0,0,1-.5.5H1.5a.5.5,0,0,1-.5-.5V4.5A.5.5,0,0,1,1.5,4h11a.5.5,0,0,1,.5.5Z"/>
						<path class="bolsa-vacia-cuerpo" fill="rgba(255,255,255,.35)" d="M10.75,4H3.25V3.5A3.65,3.65,0,0,1,7,0a3.65,3.65,0,0,1,3.75,3.5ZM4.3,3H9.7A2.72,2.72,0,0,0,7,1,2.72,2.72,0,0,0,4.3,3Z"/>
					</g>
				</svg>
			</a>
		</span>
	</div>
</nav> <!-- Termina la barra de navegacion -->