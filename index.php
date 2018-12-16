<?php include('header.php'); ?>

<section>
	<div class="card bg-dark text-white text-center">
		<img class="card-img" src="images/banner.jpg" alt="Card image">
		<div class="card-img-overlay">
			<div class="separador-25"></div>
			<h5 class="card-title display-4">&Uacute;ltimos Trabajos</h5>
			<p class="card-text lead">Checa el alb&uacute;m de nuestros trabajos m&aacute;s nuevos.</p>
			<a href="novedades.php" class="btn btn-outline-light">Ver &aacute;lbum de novedades ></a>
		</div>
	</div>
	<div class="separador-25"></div>
	<div class="container-fluid">
		<div class="card-deck">
			<div class="card col-md-6 fondo-beige">
				<img class="card-img-top sombra" src="images/ubicacion.jpg" alt="Card image cap">
				<div class="card-body text-center">
					<h3 class="card-title display-4">Ubicaci&oacute;n</h3>
					<p class="card-text lead font-weight-normal text-justify">Para que no te pierdas, conoce la ubicaci&oacute;n de nuestro establecimiento, con gusto te esperamos aqu&iacute;.</p>
					<a href="ubicacion.php" class="btn btn-outline-dark">Ver ubicaci&oacute;n ></a>
				</div>
			</div>
			<div class="card col-md-6 fondo-negro">
				<img class="card-img-top margin-top-15" src="images/Carpimas.png" alt="Card image cap">
				<div class="card-body text-center">
					<h3 class="card-title display-4">Acerca de nosotros</h3>
					<p class="card-text lead text-justify">Nosotros somos una empresa socialmente responsable encargada de llevar la comodidad que deseas hasta tu hogar.</p>
					<a href="quienes-somos.php" class="btn btn-outline-light">Ver Quiénes somos ></a>
				</div>
			</div>
		</div>
	</div>
	<div class="separador-25"></div>
	<div class="jumbotron jumbotron-fluid fondo-gris-claro">
		<div class="container text-center">
			<h1 class="display-4">Diseña tu propio mueble</h1>
			<p class="lead font-weight-normal text-justify">Reserva una cita con nosotros para orientarte de la mejor manera y que puedas plasmar tu diseño deseado en algo real, las citas pueden ser físicas, por teléfono, vía WhatsApp o internet.</p>
			<div>
				<a href="trabajos-personalizados.php" class="btn btn-outline-dark">Ver Trabajos Personalizados ></a>
				<a href="carrito_compras.php" class="btn btn-outline-dark">Reservar una cita ></a>
			</div>
		</div>
	</div>
</section>
<?php include('footer.php'); ?>