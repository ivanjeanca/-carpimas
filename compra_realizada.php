<?php 
include('header.php');
$facturacion = $_REQUEST;
$web->db->beginTransaction();

if($_SESSION['valido']){
    $query = "select * from usuario where correo = :correo";
    $parametros[':correo'] = $_SESSION['email'];
    $usuario = $web->queryArray2($web, $query, $parametros);
}

if (count($usuario) > 0) {
    $id_usuario = $usuario[0]['id_usuario'];

    $sql = "insert into venta(id_usuario, fecha, id_tipo_pago, id_ciudad, id_envio, direccion, numero_ext, numero_int) values(:id_usuario, now(), :id_tipo_pago, :id_ciudad, :id_envio, :direccion, :numero_ext, :numero_int)";

    $statement = $web->db->prepare($sql);
    $statement->bindParam(":id_usuario", $id_usuario);
    $statement->bindParam(":id_tipo_pago", $facturacion['id_tipo_pago']);
    $statement->bindParam(":id_ciudad", $facturacion['id_ciudad']);
    $statement->bindParam(":id_envio", $facturacion['id_envio']);
    $statement->bindParam(":direccion", $facturacion['direccion']);
    $statement->bindParam(":numero_ext", $facturacion['numero_ext']);
    $statement->bindParam(":numero_int", $facturacion['numero_int']);
    $statement->execute();

    $sql = "select folio from venta where id_usuario = :id_usuario order by folio desc limit 1";
    $folio = $web->queryArray2($web, $sql, array(":id_usuario"=>$id_usuario));
    $folio = $folio[0]['folio'];

    $no_producto = 1;

    $insertar = "insert into transaccion (folio, no_producto, id_producto, id_tipo_prod, id_color, id_material, cubierta, herrajes, largo, ancho, alto, precio) values ($folio, :no_producto, :id_producto, :id_tipo_prod, :id_color, :id_material, :cubierta, :herrajes, :largo, :ancho, :alto, :precio)";
    $statement = $web->db->prepare($insertar);

    foreach($_SESSION['productos'] as $key => $value) {
        $statement->bindParam(":no_producto", $no_producto);
        $statement->bindParam(":id_producto", $_SESSION['productos'][$key]['id_producto']);
        $statement->bindParam(":id_tipo_prod", $_SESSION['productos'][$key]['id_tipo_prod']);
        $statement->bindParam(":id_color", $_SESSION['productos'][$key]['id_color']);
        $statement->bindParam(":id_material", $_SESSION['productos'][$key]['id_material']);
        $statement->bindParam(":cubierta", $_SESSION['productos'][$key]['cubierta']);
        $statement->bindParam(":herrajes", $_SESSION['productos'][$key]['herrajes']);
        $statement->bindParam(":largo", $_SESSION['productos'][$key]['largo']);
        $statement->bindParam(":ancho", $_SESSION['productos'][$key]['ancho']);
        $statement->bindParam(":alto", $_SESSION['productos'][$key]['alto']);
        $statement->bindParam(":precio", $_SESSION['productos'][$key]['precio']);
        $fila = $statement->execute();
        if($fila == 0){
            $web->db->rollback();
            die("Error al insertar productos");
        }
        $no_producto++;
    } 
    
    if(count($_SESSION['productos']) > 0){
        $_SESSION['productos'] = array();
        header("Refresh: 0");
    }
    ?>
<div class="container text-center">
    <h1 class="display-4">¡Gracias por tu compra!</h1>
    <hr>
    <p class="lead">Te agradecemos por su preferencia en <strong>Carpimás</strong>, esperamos que la experiencia en tu compra haya sido tal y como la esperabas, presenta tu recibo en la sucursal para agendar una cita y realizar el calculo del precio real, así como para corroborar las medidas.</p>
    <p class="lead">Para continuar con la impresión de su recibo, dar click en el botón azul en la parte inferior para continuar.</p>
    <br>
    <a class="btn btn-info btn-lg" target="_blank" href="recibo.php?folio=<?php echo $folio ?>">Imprimir recibo con el folio: <strong><?php echo $folio ?></strong></a>
    <hr>
</div>
<?php }
$web->db->commit();

include('footer.php')
?>