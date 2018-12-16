<?php include('header.php'); ?>
<section>
	<div class="card bg-dark text-white text-center">
		<img class="card-img" src="images/banner.jpg" alt="Card image">
		<div class="card-img-overlay separador-100">
			<h5 class="card-title display-4">¿Quiénes somos?</h5>
			<p class="lead">Averigua la información <em>acerca de nosotros</em>.</p>
		</div>
	</div>
	<div class="separador-25"></div>
	<div class="container-fluid">
		<div class="row">
			<div id="list-example" class="list-group col-md-2">
				<a class="list-group-item list-group-item-action" href="#list-item-1">¿Qué es CarpiMás?</a>
				<a class="list-group-item list-group-item-action" href="#list-item-2">Misión</a>
				<a class="list-group-item list-group-item-action" href="#list-item-3">Visión</a>
				<a class="list-group-item list-group-item-action" href="#list-item-4">Valores</a>
			</div>
			<div data-spy="scroll" data-target="#list-example" data-offset="0" class="scrollspy-example col-md-10 jumbotron">
				<h4 id="list-item-1" class="display-4 text-center">¿Qué es CarpiMás?</h4>
				<hr class="my-1">
				<div class="row">
					<div class="col-sm-3">
						<img src="images/Carpimas.png" class="img-fluid" alt="Carpimas Logo">
					</div>
					<div class="col-sm-9">
						<p class="text-justify lead">CarpiMás es una Empresa Socialmente Responsable (ESR) que cumple con los estándares del mercado, para asi mantenerse en la competencia de la manufacturación de productos de la madera y servir a la gente de la mejor manera posible por los distintos canales de comunicación a los cuales nos hemos dado a la tarea de satisfacer.</p>
					</div>
				</div>
				<div class="separador-50"></div>
				<h4 id="list-item-2" class="display-4 text-center">Misión</h4>
				<hr class="my-1">
				<p class="text-justify lead">Nuestra misión es convertir la materia prima y crear objetos de calidad para que nuestros clientes disfruten del mueble que siempre desearon, satisfaciendo asi sus necesidades.</p>
				<div class="separador-50"></div>
				<h4 id="list-item-3" class="display-4 text-center">Visión</h4>
				<hr class="my-1">
				<p class="text-justify lead">Tomar en cuenta los comentarios y difundir nuestra misión por los medios de comunicacion disponibles para que la persona que desee este tipo de trabajos tenga la satisfaccion que necesita.</p>
				<div class="separador-50"></div>
				<h4 id="list-item-4" class="display-4 text-center">Valores</h4>
				<hr class="my-1">
				<ul class="text-left">
					<li class="lead">Calidad</li>
					<li class="lead">Honestidad</li>
					<li class="lead">Respeto</li>
					<li class="lead">Lealtad</li>
					<li class="lead">Responsabilidad</li>
				</ul>
			</div> <!-- Jumbotron -->
		</div>
	</div>
	<div class="separador-25"></div>
</section>
<<?php include('footer.php'); ?>