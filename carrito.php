<?php include('header.php');

$largo = "";
$ancho = "";
$alto = "";
$cubierta = "";

if(isset($_GET['sku'])){
    $id_producto = $_GET['sku'];
    if(is_numeric($id_producto)){
        
        $sql = "select * from producto where id_producto = :id_producto";
        $parametros = array(":id_producto" => $id_producto);
        $datos = $web->queryArray($sql, $parametros);
        if(count($datos) > 0){
            $tipo = $web->obtenerTipoProducto();
            for($i=0; $i<count($tipo); $i++)
                if($datos[0]['id_tipo_prod'] == $tipo[$i]['id_tipo_prod']){
                    $id_tipo_prod = $tipo[$i]['id_tipo_prod'];
                    $tipo_product = $tipo[$i]['tipo_prod'];
                }
            
            switch($tipo_product){
                case 'Closet':
                    $largo = "Fondo";
                    $ancho = "Ancho";
                    $alto = "Alto";
                    $cubierta = "";
                    break;
                case 'Puerta':
                    $largo = "Fondo";
                    $ancho = "Ancho";
                    $alto = "Alto";
                    $cubierta = "";
                    break;
                case 'Cocina':
                    $largo = "Longitud total";
                    $ancho = "Fondo";
                    $alto = "Alto";
                    $cubierta = "Si";
                    break;
                case 'Personalizado':
                    $largo = "Largo";
                    $ancho = "Ancho";
                    $alto = "Alto";
                    $cubierta = "";
                    break;
                default:
                    echo "Es otro";
            }
        } else
            header("Location: novedades.php");

        if(isset($_POST['confirmar'])){
            $productos = array();
            $productos = $_SESSION['productos'];
            $produpost = $_POST['productos'];
            $produpost['foto'] = $datos[0]['foto'];
            $produpost['modelo'] = $datos[0]['modelo'];
            $produpost['id_tipo_prod'] = $id_tipo_prod;
            if($tipo_product != 'Cocina')
                $produpost['cubierta'] = 1;
            switch($produpost['cubierta']){
                case 0: 
                    $datos[0]['precio'] -= 2500;
                break;
                case 2: 
                    $datos[0]['precio'] += 4000;
                break;
            }
            if($produpost['herrajes'] == 2)
                $datos[0]['precio'] -= 500;

            $produpost['precio'] = $datos[0]['precio'];
            array_push($productos, $produpost);
            $_SESSION['productos'] = $productos;
            header("Location: carrito_compras.php");
        }
    } else
        header("Location: novedades.php");
} else
    header("Location: novedades.php");
?>

<div class="jumbotron">
    <h5 class="display-4">Carrito de compras</h5>
    <hr class="my-4">
    <div class="container">
        <h3 class="text-center">Añadir producto al carrito de compras.</h3>
        <div class="row">
            <div class="col-md-4">
                <img src="images/productos/<?php echo $datos[0]['foto']; ?>" class="img-fluid">
            </div>
            <div class="col-md-8">
                <form method="post" action="carrito.php?sku=<?php echo $datos[0]['id_producto'] ?>">
                    <table class="table table-striped">
                        <tr>
                            <th scope="row" style="width=200px;">SKU:</th>
                            <td><input type="text" name="productos[id_producto]" value="<?php echo $datos[0]['id_producto'] ?>" readonly class="form-control"/></td>
                        </tr>
                        <tr>
                            <th scope="row">Modelo</th>
                            <td><?php echo $datos[0]['modelo'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Color</th>
                            <td>
                                <select name="productos[id_color]" id="id_color" class="form-control">
                                <?php
                                $color = $web->obtenerColor();
                                for($i=0; $i<count($color); $i++){
                                    $seleccionado = "";
                                    if($datos[0]['id_color'] == $color[$i]['id_color'])
                                        $seleccionado = "selected";
                                    echo "<option $seleccionado value ='".$color[$i]['id_color']."'>".$color[$i]['color']."</option>";
                                }
                                ?>
                                </select>
                            </td>
                        </tr>
                            <tr>
                                <th scope="row">Material</th>
                                <td>
                                    <select name="productos[id_material]" id="id_material" class="form-control">
                                    <?php
                                    $material = $web->obtenerMaterial();
                                    for($i=0; $i<count($material); $i++){
                                        $seleccionado = "";
                                        if($datos[0]['id_material'] == $material[$i]['id_material'])
                                            $seleccionado = "selected";
                                        echo "<option $seleccionado value ='".$material[$i]['id_material']."'>".$material[$i]['material']."</option>";
                                    }
                                    ?>
                                    </select>
                                </td>
                            </tr>
                            <?php if($cubierta == 'Si'){ ?>
                            <tr>
                                <th scope="row">Cubierta</th>
                                <td>
                                    <select name="productos[cubierta]" id="cubierta" class="form-control">
                                        <option value="0">No, sin cubierta</option>
                                        <option selected value="1">Cubierta de aglomerado</option>
                                        <option value="2">Cubierta sólida</option>
                                    </select>
                                    <p class="text-right" style="font-size:12px;">Si seleccionas una opción diferente a <strong><em>"Cubierta de aglomerado"</em></strong>,<br />afectará de manera considerable al precio estimado. *</p>
                                </td>
                            </tr>
                            <?php } ?>
                            <tr>
                                <th scope="row">Herrajes</th>
                                <td>
                                    <input type="radio" id="si" name="productos[herrajes]" required value="1" checked>
                                    <label for="si" class="">Sí.</label>
                                    <br/>
                                    <input type="radio" id="no" name="productos[herrajes]" value="2">
                                    <label for="no" class="">No, ya los tengo.</label>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo $largo; ?></th>
                                <td>
                                    <div class ="row">
                                        <div class="col-sm-8">
                                            <input type="number" name="productos[largo]" maxlength="2" max="20" min="0"  value="<?php echo $datos[0]['largo']; ?>" step=".05" class="form-control" style="width=200px;">
                                        </div>
                                        <div class="col-sm-4 py-2">
                                            metro(s).
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo $ancho; ?></th>
                                <td>
                                    <div class ="row">
                                        <div class="col-sm-8">
                                            <input type="number" name="productos[ancho]" maxlength="2" max="20" min="0"  value="<?php echo $datos[0]['ancho']; ?>" step=".05" class="form-control" style="width=200px;">
                                        </div>
                                        <div class="col-sm-4 py-2">
                                            metro(s).
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo $alto; ?></th>
                                <td>
                                    <div class ="row">
                                        <div class="col-sm-8">
                                            <input type="number" name="productos[alto]" maxlength="2" max="20" min="0"  value="<?php echo $datos[0]['alto']; ?>" step=".05" class="form-control" style="width=200px;">
                                        </div>
                                        <div class="col-sm-4 py-2">
                                            metro(s).
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                </div>
            </div>
            <hr />
            <div class="container">
                <div class="row">
                    <div class="col-sm-7"></div>
                    <div class="col-sm-5">
                        <p class="lead text-center"><em>Precio estimado: </em><strong class="font-weight-bold">$<?php echo $datos[0]['precio']; ?> MXN **</strong></p>
                        <table class="table text-right">
                            <tr>
                                <td><input class="btn btn-success" name="confirmar" type="submit" value="Agregar al carrito"></td>
                                <td><a href="cocinas.php" class="btn btn-danger">Cancelar</a></td>
                            </tr>
                        </table>
                        <p class="lead text-right" style="font-size:14px;">* Ver <em><a href="" target="_blank">porqué varían los precios.</a></em> <br />** El precio estará sujeto a cambios.<br /></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>