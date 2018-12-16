<?php 
include('header.php');

if(!is_null($_SESSION['email']))
    header("Location: logout.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';
$mail = new PHPMailer(true);

$msg = '<div class="alert alert-info text-center" role="alert">Ingresa tu correo electrónico, se te enviará un correo con un vínculo para recuperar tu contraseña.</div>';
$email = isset($_POST['email']) ? $_POST['email'] : null;
if(!is_null($email)){
    $sql = "select * from usuario where correo = :correo";
    $parametros[':correo'] = $email;
    $datos = $web->queryArray($sql, $parametros);
    if(isset($datos[0])){
        $llave = md5($email.rand(1,90000000).crypt("jeancarlo", "esdios").rand(1,43)).md5(crypt("taniaconde", "md5").sha1("teregalomiesencial").soundex("todomimundo").rand(1,2));
        $sql = "update usuario set llave = :llave where correo = :correo";
        $statement = $web->db->prepare($sql);
        $statement->bindParam(":llave", $llave);
        $statement->bindParam(":correo", $email);
        $statement->execute();
        try {
            $mail->isSMTP();
            $mail->SMTPDebug = 0;
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPSecure = 'tls';
            $mail->SMTPAuth = true;
            $mail->Username = '15030104@itcelaya.edu.mx';
            $mail->Password = 'Timori1106';
        
            $mail->setFrom('15030104@itcelaya.edu.mx', 'CarpiMas');
            $mail->addAddress($email, 'Estimado Usuario');
        
            $mail->isHTML(true);
            $mail->Subject = 'Recuperacion de contrasena';
            $mail->Body    = 'Estimado usuario, a continuaci&oacute;n se mostrar&aacute; un v&iacute;nculo para reestablecer su contrasena: <br> <a href="http://localhost:8080/Carpimas/reestablecer.php?llave='.$llave.'">Reestablecer contrasena</a><br><br><b>No compartas con nadie este vínculo porque podrían hacerse de tu cuenta.</b>';
        
            $mail->send();
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    } else {
        $msg = '<div class="alert alert-danger text-center" role="alert">El email no existe.</div>';
    }
}
?>
<div class="container-fluid">
    <h1 class="display-4">Recuperar contraseña</h1>
    <hr>
    <div class="container">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <div class="jumbotron">
                    <form class="form-signin" action="recuperar.php" method="POST">
                    <?php echo $msg; ?>
                    <label for="inputEmail" class="lead">Correo electrónico</label>
                    <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Correo electrónico" required autofocus>
                    <br />
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Recuperar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>