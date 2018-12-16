<?php 
include('header.php');
$total = 0;
$aux_carrito = array();
if(isset($_POST['borrar'])){
    if(isset($_GET['id_carrito'])){
        for ($i=0; $i < $sescount; $i++)
            if($i != $_GET['id_carrito'])
                array_push($aux_carrito, $_SESSION['productos'][$i]); 
        $_SESSION['productos'] = $aux_carrito;
        header("Location: carrito_compras.php");
    }
}

$id_cocinas = $web->queryArray("select id_tipo_prod from tipo_producto where tipo_prod = :tipo_prod", array(":tipo_prod"=>'Cocina'));
?>

<div class="jumbotron">
    <h5 class="display-4">Carrito de compras</h5>
    <hr class="my-4">
    <div class="container">
        <?php if($sescount > 0){ for ($i=0; $i < $sescount; $i++) { ?>
            <div class="row">
                <div class="col-md-4">
                    <img src="images/productos/<?php echo $_SESSION['productos'][$i]['foto']; ?>" class="img-fluid">
                </div>
                <div class="col-md-8">
                    <table class="table table-striped">
                        <tr>
                            <th scope="row" style="width=200px;">SKU</th>
                            <td><p><?php echo $_SESSION['productos'][$i]['id_producto']; ?></p></td>
                        </tr>
                        <tr>
                            <th scope="row">Modelo</th>
                            <td><?php echo $_SESSION['productos'][$i]['modelo']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Color</th>
                            <td><?php 
                                $sql = "select color from color where id_color = :id_color";
                                $colors = $web->queryArray($sql, array(":id_color"=>$_SESSION['productos'][$i]['id_color']));
                                echo $colors[0]['color']; 
                            ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Material</th>
                            <td><?php 
                            $sql = "select material from material where id_material = :id_material";
                            $materials = $web->queryArray($sql, array(":id_material"=>$_SESSION['productos'][$i]['id_material']));
                            echo $materials[0]['material']; 
                            ?></td>
                        </tr>
                        <?php if($_SESSION['productos'][$i]['id_tipo_prod'] == $id_cocinas[0]['id_tipo_prod']) { ?>
                        <tr>
                            <th scope="row">Cubierta</th>
                            <td><?php
                                switch($_SESSION['productos'][$i]['cubierta']){
                                    case 0: 
                                        echo "No, sin cubierta.";
                                    break;
                                    case 1: 
                                        echo "Cubierta de aglomerado.";
                                    break;
                                    case 2: 
                                        echo "Cubierta sólida.";
                                    break;
                                }
                            ?></td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <th scope="row">Herrajes</th>
                            <td><?php 
                                switch($_SESSION['productos'][$i]['herrajes']){
                                    case 1: echo "Sí.";
                                    break;
                                    case 2: echo "No.";
                                    break;
                                }
                            ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Longitud total</th>
                            <td><?php 
                                echo $_SESSION['productos'][$i]['largo'] . " metros.";
                            ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Fondo</th>
                            <td><?php 
                                echo $_SESSION['productos'][$i]['ancho'] . " metros.";
                            ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Alto</th>
                            <td><?php 
                                echo $_SESSION['productos'][$i]['alto'] . " metros.";
                            ?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-sm-12 text-right">
                    <p class="lead"><em>Precio estimado: </em><strong class="font-weight-bold">$<?php echo $_SESSION['productos'][$i]['precio']; ?> MXN **</strong> 
                        <button style="margin-left:15px;" data-toggle="modal" data-target="#modal<?php echo $i; ?>" class="btn btn-outline-danger">
                            Quitar del carrito. &nbsp;
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 -3 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve" height="22" style="margin-left:7px;">
                                <circle style="fill:#dc3545;" cx="256" cy="256" r="256"/>
                                <path style="fill:#C40606;" d="M510.28,285.304L367.912,142.936L150.248,368.608l140.928,140.928  C406.352,493.696,497.056,401.288,510.28,285.304z"/>
                                <g>
                                    <path style="fill:#FFFFFF;" d="M354.376,371.536c-5.12,0-10.232-1.952-14.144-5.856L146.408,171.848   c-7.816-7.816-7.816-20.472,0-28.28s20.472-7.816,28.28,0L368.52,337.4c7.816,7.816,7.816,20.472,0,28.28   C364.608,369.584,359.496,371.536,354.376,371.536z"/>
                                    <path style="fill:#FFFFFF;" d="M160.544,371.536c-5.12,0-10.232-1.952-14.144-5.856c-7.816-7.816-7.816-20.472,0-28.28   l193.832-193.832c7.816-7.816,20.472-7.816,28.28,0s7.816,20.472,0,28.28L174.688,365.68   C170.784,369.584,165.664,371.536,160.544,371.536z"/>
                                </g>
                            </svg>
                        </button>
                    </p>
                    <div class="modal fade" id="modal<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="titulomodal<?php echo $i; ?>" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="titulomodal<?php echo $i; ?>">¿Desea quitar del carrito?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p class="text-left">Si realmente quieres <strong>eliminar</strong> este producto, da click en el botón <strong style="color:#dc3545;"><em>rojo</em></strong>.</p>
                                    <p class="text-left">Para salir <strong>sin eliminar</strong>, da click en el botón <strong style="color:#28a745;"><em>verde</em></strong>, para volver al carrito.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" style="border:0; background-color:rgba(0,0,0,0);" data-dismiss="modal">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="56px" viewBox="0 0 512 512" style="margin-right:10px;"><path d="m512 256c0 141.386719-114.613281 256-256 256s-256-114.613281-256-256 114.613281-256 256-256 256 114.613281 256 256zm0 0" fill="#28a745"/><path d="m487.65625 365.054688-274.980469-274.984376v276.378907l130.359375 130.363281c63.855469-23.082031 115.894532-70.839844 144.621094-131.757812zm0 0" fill="#117027"/><path d="m368.722656 287.710938c-9.628906-62.75-63.613281-109.085938-127.101562-109.085938h-28.945313v-88.554688l-138.191406 138.191407 138.191406 138.1875v-93.96875h17.4375c32.542969 0 63.136719 15.523437 82.351563 41.789062l76.339844 104.335938zm0 0" fill="#fff"/><path d="m342.867188 227.929688-268.382813.332031 138.191406 138.1875v-93.96875h17.4375c32.542969 0 63.136719 15.523437 82.351563 41.789062l76.339844 104.335938-20.082032-130.894531c-3.453125-22.496094-12.605468-42.882813-25.855468-59.78125zm0 0" fill="#e9edf5"/></svg>
                                    </button>
                                    <form action="carrito_compras.php?id_carrito=<?php echo $i; ?>" method="post" class="hide-submit">
                                        <label>
                                            <input type="submit" name="borrar" value ="Eliminar">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512; padding-top:9px;" xml:space="preserve" height="65px">
                                                <circle style="fill:#dc3545;" cx="256" cy="256" r="256"/>
                                                <path style="fill:#8e1924;" d="M291.776,509.458c108.984-15.247,195.922-99.075,215.849-206.487L348.68,144.049  c-1.057-1.06-2.424-1.595-3.794-1.595h-40.276l-20.713-20.71c-1.674-1.72-3.971-2.647-6.354-2.647h-43.059  c-2.427,0-4.677,0.927-6.356,2.647c-1.723,1.679-2.652,3.932-2.652,6.362v7.15h-8.965v5.212v1.987h-49.37  c-1.416,0-2.742,0.532-3.845,1.595c-1.014,1.014-1.546,2.427-1.546,3.791v3.581h-0.881c-0.927,0-1.856,0.351-2.56,1.057  c-0.709,0.707-1.062,1.633-1.062,2.519v26.934l9.009,9.011v185.828c0,1.812,0.707,3.622,2.033,5.036l0.041,0.043l0.046,0.051  l6.843,6.84l2.086,2.084l-2.079,2.084L291.776,509.458z"/>
                                                <path style="fill:#F2F9FF;" d="M166.239,376.742c0,1.841,0.707,3.674,2.107,5.076c1.4,1.398,3.228,2.099,5.071,2.099h165.176  c1.841,0,3.681-0.701,5.077-2.099c1.4-1.405,2.112-3.238,2.112-5.076V181.939H166.239V376.742z"/>
                                                <rect x="175.232" y="383.923" style="fill:#B8D1E6;" width="161.562" height="8.975"/>
                                                <path style="fill:#F2F9FF;" d="M354.744,181.939H157.256v-26.931c0-0.916,0.358-1.836,1.06-2.54  c0.699-0.701,1.623-1.047,2.529-1.047h190.326c0.911,0,1.828,0.343,2.532,1.047c0.704,0.704,1.042,1.623,1.042,2.54L354.744,181.939  L354.744,181.939z"/>
                                                <path style="fill:#CEE2F2;" d="M350.272,151.424H161.743v-3.597c0-1.385,0.527-2.76,1.574-3.807  c1.073-1.055,2.429-1.577,3.827-1.577h177.733c1.382,0,2.757,0.522,3.807,1.577c1.06,1.047,1.587,2.422,1.587,3.807V151.424z"/>
                                                <path style="fill:#F2F9FF;" d="M295.514,142.446h-16.169v-14.359c0-0.282-0.059-0.814-0.525-1.272  c-0.451-0.468-0.986-0.527-1.262-0.527h-43.095c-0.276,0-0.819,0.059-1.267,0.527c-0.461,0.456-0.54,0.991-0.54,1.272v14.359  h-16.146v-7.188h8.978v-7.171c0-2.401,0.932-4.659,2.632-6.351c1.69-1.7,3.94-2.629,6.346-2.629h43.092  c2.391,0,4.644,0.929,6.339,2.629c1.695,1.692,2.644,3.95,2.644,6.351v7.171h8.975v7.188H295.514z"/>
                                                <g>
                                                    <path style="fill:#B8D1E6;" d="M192.714,199.887v151.718c0,1.377,0.532,2.752,1.587,3.807c1.039,1.052,2.424,1.58,3.791,1.58   c1.4,0,2.767-0.527,3.822-1.58c1.055-1.055,1.572-2.429,1.572-3.807V199.887H192.714z"/>
                                                    <path style="fill:#B8D1E6;" d="M231.324,199.887v151.718c0,1.377,0.525,2.752,1.577,3.807c1.06,1.052,2.429,1.58,3.807,1.58   c1.37,0,2.752-0.527,3.807-1.58c1.047-1.055,1.574-2.429,1.574-3.807V199.887H231.324z"/>
                                                    <path style="fill:#B8D1E6;" d="M269.926,199.887v151.718c0,1.377,0.522,2.752,1.582,3.807c1.047,1.052,2.411,1.58,3.789,1.58   c1.39,0,2.76-0.527,3.817-1.58c1.06-1.055,1.574-2.429,1.574-3.807V199.887H269.926z"/>
                                                    <path style="fill:#B8D1E6;" d="M308.513,199.887v151.718c0,1.377,0.538,2.752,1.579,3.807c1.057,1.052,2.429,1.58,3.822,1.58   c1.367,0,2.749-0.527,3.804-1.58c1.052-1.055,1.572-2.429,1.572-3.807V199.887H308.513z"/>
                                                </g>
                                                <rect x="166.239" y="181.939" style="fill:#CEE2F2;" width="179.558" height="7.68"/>
                                            </svg>
                                        </label>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        <?php 
            $total += $_SESSION['productos'][$i]['precio'];
            } 
        ?>
        <p class="lead text-right"><em>Total acumulado: </em><strong class="font-weight-bold">$<?php echo $total; ?> MXN **</strong> 
        <p class="text-right">
            
            <form method="post" action="facturacion.php" class="text-right">  
                <button type="submit" class="btn btn-success btn-lg" style="margin-left:15px;" name="confirmar"> 
                    Confirmar compra.
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 32 32" style="enable-background:new 0 0 32 32; margin-left:7px; padding-bottom:2px;" xml:space="preserve" width="25px" height="25px">
                        <g>
                            <g id="check_x5F_alt">
                                <path d="M16,0C7.164,0,0,7.164,0,16s7.164,16,16,16s16-7.164,16-16S24.836,0,16,0z M13.52,23.383    L6.158,16.02l2.828-2.828l4.533,4.535l9.617-9.617l2.828,2.828L13.52,23.383z" fill="#FFFFFF"/>
                            </g>
                        </g>
                    </svg>
                </button>
            </form>
        </p>
        <p class="lead text-right" style="font-size:14px;">* Ver <em><a href="" target="_blank">porqué varían los precios.</a></em> <br />** El precio estará sujeto a cambios.<br /></p>
        <?php } else { ?>
            <div class="text-center">
                <img src="images/CarpimasBN 300px.jpg" alt="Logo Carpimás" />
                <div class="alert alert-info my-4" role="alert">
                    <h1 class="display-4" style="font-size:40px;">No tienes ningún producto en tu carrito :(</h1>
                </div>
                <h3>Aprovecha a ver nuestros cátalogos y ¡anímate a comprar algo con nosotros!</h3>
                <br>
                <ul class="lead" style="list-style-type: none; font-size:22px; font-weight:500;">
                    <li><a href="closets.php" title="Closets" style="text-decoration:none;">Closets</a></li>
                    <li><a href="cocinas.php" title="Cocinas" style="text-decoration:none;">Cocinas</a></li>
                    <li><a href="puertas.php" title="Puertas" style="text-decoration:none;">Puertas</a></li>
                    <li><a href="trabajos-personalizados.php" title="Trabajos Personalizados" style="text-decoration:none;">Trabajos Personalizados</a></li>
                    <li><a href="novedades.php" title="Novedades" style="text-decoration:none;">Novedades</a></li>
                </ul>
            </div>
        <?php } ?>
    </div>
</div>
<?php 
include('footer.php');
?>