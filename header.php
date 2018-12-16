<?php
include('core/carpimas.class.php');

if(!is_null($_SESSION) && count($_SESSION) == 0){
	$_SESSION['productos'] = array();
	$_SESSION['email'] = null;
}
$sescount = (!is_null($_SESSION) && !is_null($_SESSION['productos'])) ? count($_SESSION['productos']) : 0;

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
			<ul class="navbar-nav mr-auto">
				<li class="nav-item" style="margin-right:25px;">
					<?php echo $sesion_nav; ?>
				</li>
				<li class="nav-item">
					<a href="carrito_compras.php" class="nav-link" title="Carrito de compras">
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 554.748 554.748" style="enable-background:new 0 0 554.748 554.748;" xml:space="preserve" width="25px" height="25px">

							<g id="bolsa-vacia" data-name="Bolsa Vacia">
								<g>
									<path d="M548.873,164.412c4.896,6.12,6.73,13.464,5.508,22.032l-23.256,133.417    c-0.816,6.938-3.979,12.648-9.486,17.136c-5.508,4.488-11.729,6.732-18.666,6.732H163.925l-6.732,37.944H480.33    c7.752,0,14.48,2.754,20.195,8.262c5.713,5.508,8.566,12.342,8.566,20.502s-2.854,14.994-8.566,20.502    c-5.715,5.508-12.443,8.262-20.195,8.262H122.921c-8.568,0-15.912-3.468-22.032-10.401c-5.712-6.938-7.956-14.895-6.732-23.868    l15.3-83.232L86.201,87.914L20.105,67.106c-7.752-2.448-13.362-7.141-16.83-14.076c-3.468-6.937-4.182-14.28-2.142-22.032    c2.448-7.752,7.242-13.362,14.382-16.83s14.382-4.182,21.726-2.142l84.456,26.928c5.304,1.632,9.69,4.692,13.158,9.18    c3.468,4.488,5.61,9.589,6.426,15.301l4.896,46.512l383.112,42.84C537.857,154.008,544.385,157.884,548.873,164.412z     M166.374,455.113c12.24,0,22.644,4.284,31.212,12.854c8.568,8.565,12.852,18.972,12.852,31.212    c0,12.237-4.284,22.746-12.852,31.518c-8.568,8.772-18.972,13.158-31.212,13.158s-22.644-4.386-31.212-13.158    c-8.568-8.771-12.852-19.278-12.852-31.518s4.284-22.646,12.852-31.212C143.729,459.397,154.133,455.113,166.374,455.113z     M427.697,455.113c12.238,0,22.645,4.284,31.213,12.854c8.564,8.565,12.852,18.972,12.852,31.212    c0,12.237-4.285,22.746-12.852,31.518c-8.568,8.772-18.975,13.158-31.213,13.158c-12.24,0-22.646-4.386-31.211-13.158    c-8.568-8.771-12.855-19.278-12.855-31.518s4.285-22.646,12.855-31.212C405.053,459.397,415.457,455.113,427.697,455.113z" fill="<?php echo ($sescount > 0) ? "#DDD" : "#888"; ?>"/>
								</g>
							</g>
						</svg>
						
						<?php if($sescount > 0) echo "<span class=\"badge badge-pill badge-light\">$sescount</span>"; ?>
					</a>
				</li>
			</ul>
		</span>
	</div>
</nav> <!-- Termina la barra de navegacion -->