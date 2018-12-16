<?php 
include('header.php');
$productos = $web->obtenerAllProductos();
?>

<section>
<div class="card bg-dark text-white text-center">
		<img class="card-img" src="images/banner.jpg" alt="Card image">
		<div class="card-img-overlay separador-100">
			<h5 class="card-title display-4">Trabajos Personalizados.</h5>
			<p class="lead">¿Alguna vez has necesitado algún mueble muy especifico? No dudes en preguntarnos, que seguro lo podemos hacer.</p>
		</div>
	</div>
	
	<div class="separador-25"></div>

	<div class="container-fluid">
		<div class="card-columns">
			<?php for ($i=0; $i < count($productos); $i++) {
			if($productos[$i]['id_tipo_prod'] == 6)
			echo "<div class=\"card\">
				<img class=\"card-img-top\" src=\"images/productos/".$productos[$i]['foto']."\" alt=\"Cocina ".($i + 1)."\">
				<div class=\"card-body\">
					<h5 class=\"display-4 titulo-tarjeta\"><em>".$productos[$i]['producto'].".</em></h5>
					<p class=\"lead\">".$productos[$i]['descripcion']."</p>
				</div>
				<div class=\"card-footer\">
					<small class=\"text-muted\"><em>Fecha de entrega: </em><strong>".$productos[$i]['fecha_entregado']."</strong></small>
				</div>
				<div class=\"\">
					<!-- Button trigger modal -->
					<button type=\"button\" class=\"btn btn-outline-dark btn-block\" data-toggle=\"modal\" data-target=\"#modal".($i + 1)."\">
						Ver Especificaciones >
					</button>
					<!-- Modal -->
					<div class=\"modal fade\" id=\"modal".($i + 1)."\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"titulomodal".($i + 1)."\" aria-hidden=\"true\">
						<div class=\"modal-dialog modal-dialog-centered modal-lg\" role=\"document\">
							<div class=\"modal-content\">
								<div class=\"modal-header\">
									<h5 class=\"modal-title\" id=\"titulomodal".($i + 1)."\">Especificaciones del trabajo</h5>
									<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
										<span aria-hidden=\"true\">&times;</span>
									</button>
								</div>
								<div class=\"modal-body\">
									<div class=\"container-fluid\">
										<div class=\"row\">
											<div class=\"col-sm-6\">
												<img class=\"card-img-top\" src=\"images/productos/".$productos[$i]['foto']."\" alt=\"Card image cap\">
											</div>
											<div class=\"col-sm-6\">
												<table class=\"table table-striped\">
												<tr>
													<th scope=\"row\">Modelo</th>
													<td>".$productos[$i]['modelo']."</td>
												</tr>
												<tr>
													<th scope=\"row\">Color</th>
													<td>".$productos[$i]['color']."</td>
												</tr>
													<tr>
														<th scope=\"row\">Material</th>
														<td>".$productos[$i]['material']."</td>
													</tr>
													<tr>
														<th scope=\"row\">Herrajes</th>
														<td>Sí*</td>
													</tr>
													<tr>
														<th scope=\"row\">Dimensiones</th>
														<td>
															<strong>Longitud total:</strong> ".$productos[$i]['largo']." metros<br />
															<strong>Fondo:</strong> ".$productos[$i]['ancho']." metros<br />
															<strong>Alto:</strong> ".$productos[$i]['alto']." metros
														</td>
													</tr>
												</table>
												<hr />
												<p class=\"text-right lead\"><em>Precio: </em><strong class=\"font-weight-bold\">$".$productos[$i]['precio']." MXN **</strong></p>
												<p class=\"text-right\">* No todos los muebles los necesitan. <br />** El precio estará sujeto a cambios.<br /><em>Ver <a href=\"\" target=\"_blank\">porqué varían los precios.</a></em></p>
											</div>
										</div>
									</div>
								</div>
								<div class=\"modal-footer\">
									<button type=\"button\" class=\"btn btn-dark\" data-dismiss=\"modal\">Cerrar</button>
									<form method=\"post\" action=\"carrito.php?sku=".$productos[$i]['id_producto']."\">
										<input type=\"submit\" class=\"btn btn-success\" value=\"Agregar al carrito\"/>		
									</form>
								</div>
							</div>
						</div>
					</div>
				</div> <!-- Modal Especificaciones -->
			</div> <!-- Card -->";
			} 
			?>
		</div>
	</div>
	<div class="separador-25"></div>
</section>

<?php include('footer.php'); ?>