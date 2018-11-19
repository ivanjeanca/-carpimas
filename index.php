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

	<div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
		<div class="carousel-inner">
			<div class="carousel-item active">
				<img class="d-block w-100" src="images/promocion1.jpg" alt="Primera promocion">
				<div class="carousel-caption d-none d-md-block margin-bottom-50">
					<h5>Compra x producto y con $0.00MXN más, llevate x cosa.</h5>
					<p>Promoción válida solo para la ciudad X, fecha limite 01/01/2018</p>
				</div>
			</div>
			<div class="carousel-item">
				<img class="d-block w-100" src="images/promocion2.jpg" alt="Segunda promocion">
				<div class="carousel-caption d-none d-md-block margin-bottom-50">
					<h5>Compra x producto y con $0.00MXN más, llevate x cosa.</h5>
					<p>Promoción válida solo para la ciudad X, fecha limite 02/02/2018</p>
				</div>
			</div>
			<div class="carousel-item">
				<img class="d-block w-100" src="images/promocion3.jpg" alt="Third slide">
				<div class="carousel-caption d-none d-md-block margin-bottom-50">
					<h5>Compra x producto y con $0.00MXN más, llevate x cosa.</h5>
					<p>Promoción válida solo para la ciudad X, fecha limite 03/03/2018</p>
				</div>
			</div>
			<div class="card-img-overlay">
				<div class="text-center">
					<h2 class="display-4 text-white">Promociones</h2>
				</div>

				<div class="carousel-button-overlay">
					<a href="#" class="btn btn-outline-light carousel-control-center">Ver promociones ></a>
				</div>
			</div>
			
		</div>
		<a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>

	<div class="separador-25"></div>

	<div class="container-fluid">
		<div class="card-deck">
			<div class="card col-md-6 fondo-beige">
				<img class="card-img-top sombra" src="images/ubicacion.jpg" alt="Card image cap">
				<div class="card-body text-center">
					<h3 class="card-title display-4">Ubicaci&oacute;n</h3>
					<p class="card-text lead font-weight-normal text-justify">Para que no te pierdas, conoce la ubicaci&oacute;n de nuestro establecimiento, con gusto te esperamos aqu&iacute;.</p>
					<a href="ubicacion.html" class="btn btn-outline-dark">Ver ubicaci&oacute;n ></a>
				</div>
			</div>

			<div class="card col-md-6 fondo-negro">
				<img class="card-img-top margin-top-15" src="images/Carpimas.png" alt="Card image cap">
				<div class="card-body text-center">
					<h3 class="card-title display-4">Acerca de nosotros</h3>
					<p class="card-text lead text-justify">Nosotros somos una empresa socialmente responsable encargada de llevar la comodidad que deseas hasta tu hogar.</p>
					<a href="quienes-somos.html" class="btn btn-outline-light">Ver Quiénes somos ></a>
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
					<a href="carrito.php" class="btn btn-outline-dark">Reservar una cita ></a>
			</div>
		</div>
	</div>
</section>
<?php include('footer.php'); ?>