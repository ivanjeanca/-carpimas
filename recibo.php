<?php
include('core/carpimas.class.php');
$web = new Carpimas;
$web->Conexion();

require_once dirname(__FILE__).'/../vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

$folio = isset($_GET['folio']) ? $_GET['folio'] : 1;
try {
    ob_start();
    $sql="select concat(u.nombre, ' ', u.apellido) as nombre, v.folio, v.fecha, ti.tipo_pago, c.ciudad, e.estado, p.pais, en.envio, v.direccion, v.numero_ext, v.numero_int, t.id_producto, tp.tipo_prod, co.color, ma.material, t.cubierta, t.herrajes, t.largo, t.ancho, t.alto, t.precio from venta v
    join usuario u on v.id_usuario = u.id_usuario
    join tipo_pago ti on v.id_tipo_pago = ti.id_tipo_pago
    join ciudades c on v.id_ciudad = c.id_ciudad
    join estado e on c.id_estado = e.id_estado
    join pais p on e.id_pais = p.id_pais
    join envio en on v.id_envio = en.id_envio
    join transaccion t on v.folio = t.folio
    join tipo_producto tp on t.id_tipo_prod = tp.id_tipo_prod
    join color co on t.id_color = co.id_color
    join material ma on t.id_material = ma.id_material
    where v.folio = :folio
    order by t.no_producto asc";
    $statement = $web->db->prepare($sql);
    $statement->bindParam(":folio", $folio);
    $statement->execute();
    $datos = array();
    while($fila = $statement->fetch(PDO::FETCH_ASSOC))
        array_push($datos, $fila);	
    $content = "
    <page>
        <div style=\"text-align:center\">
            <img src=\"images/Carpimas 300px.jpg\" style=\"width:200px;\" >
            <p><b>CarpiMás</b> - Salvatierra, Guanajuato, México.<br> Telefono: (466) 6 63 07 31.<br>Calle: Guadalupe #70.<br>Colonia: Guadalupe.</p>
        </div>
        <p> <label style=\"font-size:20px;\">Datos del cliente:</label><br /><br />
            <strong>Folio de venta:</strong> ".$datos[0]['folio']."<br />
            <strong>Cliente:</strong> ".$datos[0]['nombre']."<br />
            <strong>Fecha de compra:</strong> ".$datos[0]['fecha']."<br />
            <strong>Dirección del cliente:</strong> ".$datos[0]['direccion'].", <strong>No. Ext.:</strong> ".$datos[0]['numero_ext'].", <strong>No. Int.:</strong> ".$datos[0]['numero_int'].", ".$datos[0]['ciudad'].", ".$datos[0]['estado'].", ".$datos[0]['pais'].".
        </p>
        <hr>
        <p style=\"font-size:20px;\">Producto(s):</p>";
        $total = 0;
        $content .= "
        <table>
            <tr>
                <th style=\"text-align:center; padding-right:20px\">SKU</th>
                <th style=\"text-align:center; padding-right:20px\">Tipo de producto</th>
                <th style=\"text-align:center; padding-right:20px\">Color</th>
                <th style=\"text-align:center; padding-right:20px\">Material</th>
                <th style=\"text-align:center; padding-right:20px\">Cubierta</th>
                <th style=\"text-align:center; padding-right:20px\">Herrajes</th>
                <th style=\"text-align:center; padding-right:20px\">Largo</th>
                <th style=\"text-align:center; padding-right:20px\">Ancho</th>
                <th style=\"text-align:center; padding-right:20px\">Alto</th>
                <th style=\"text-align:center; padding-right:20px\">Precio Unitario</th>
            </tr>";
        for ($i=0; $i < count($datos); $i++) { 
            $content .= "
            <tr>
                <td style=\"text-align:center; padding-right:20px\">".$datos[$i]['id_producto']."</td>
                <td style=\"text-align:center; padding-right:20px\">".$datos[$i]['tipo_prod']."</td>
                <td style=\"text-align:center; padding-right:20px\">".$datos[$i]['color']."</td>
                <td style=\"text-align:center; padding-right:20px\">".$datos[$i]['material']."</td>
                <td style=\"text-align:center; padding-right:20px\">";
            switch($datos[$i]['cubierta']){
                case 0:
                    $content .= "---";
                    break;
                case 1:
                    if($datos[$i]['tipo_prod'] == 'Cocina')
                        $content .= "Cubierta de aglomerado";
                    else
                        $content .= "---";
                    break;
                case 2:
                    $content .= "Cubierta sólida";
                    break;
                default:
            }
            $content .= "</td>
                <td style=\"text-align:center; padding-right:20px\">";
            if($datos[$i]['herrajes'] == 1)
                $content .= "Sí";
            else
                $content .= "No";
            $content .= "</td>
                <td style=\"text-align:center; padding-right:20px\">".$datos[$i]['largo']." mts.</td>
                <td style=\"text-align:center; padding-right:20px\">".$datos[$i]['ancho']." mts.</td>
                <td style=\"text-align:center; padding-right:20px\">".$datos[$i]['alto']." mts.</td>
                <td style=\"text-align:center; padding-right:20px\">$".$datos[$i]['precio']." MXN.</td>
            </tr>";
            $total += $datos[$i]['precio'];
        }
        $content .= "
        </table>
        <br />
        <br />
        <hr>
        <div style=\"text-align:right\">
        <p>
            <strong>Tipo de pago:</strong> ".$datos[0]['tipo_pago']."<br />
            <strong>Tipo de envio/entrega:</strong> ".$datos[0]['envio']."<br />
        </p>
        </div>
        <p style=\"text-align:right;\">
            <label style=\"text-align:right; color:rgb(0,0,0); text-decoration:underline; background-color:rgb(255,100,100); padding:10px; font-weight:300; border-color: black; font-size:20px;\">Importe total: $".$total." MXN. **</label><br />
            <label>** El precio final puede variar, las medidas, materiales y accessorios <br />hacen que este precio cambie, por tanto es necesaria su visita <br />en la sucursal o comunicarse por teléfono, via correo electrónico <br />o redes sociales presentando este recibo de compra.</label>
        </p>
        <em><h3 style=\"text-align:center; text-decoration:underline;\">¡GRACIAS POR SU COMPRA!</h3></em>
    </page>";

    $html2pdf = new Html2Pdf('L', 'Letter', 'fr');
    $html2pdf->writeHTML($content);
    $html2pdf->output('example01.pdf');
} catch (Html2PdfException $e) {
    $html2pdf->clean();
    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}
?>