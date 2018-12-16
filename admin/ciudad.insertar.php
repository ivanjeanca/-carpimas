<?php 
include('header.php'); 
$web->validarRol(array("Administrador"));
$web->validarPermiso(array("CRUD"));

if(isset($_POST['enviar'])){
    $ciudad = $_POST['ciudad'];
    $id_estado = $_POST['id_estado'];
   	$statement = $web->db->prepare("insert into ciudades(ciudad, id_estado) values (:ciudad, :id_estado)");
    $statement->bindParam(":ciudad", $ciudad);
    $statement->bindParam(":id_estado", $id_estado);
	$statement->execute();

   	echo '<div class="alert alert-success" role="alert">La ciudad se insertó correctamente<a href="ciudad.php" class="btn btn-dark" style="margin-left:30px;">Volver a Ciudad</a></div>';
}
?>

<h1 class="display-4">Insertar ciudad</h1>
<hr>
<div class="container">
	<form action="ciudad.insertar.php" method="post" class="lead">
		<div class="form-group">
			<label>Ciudad</label>
	   		<input type="text" name="ciudad" required class="form-control">
		</div>
        <div class="form-group">
            <label>Estado</label> 
            <select name="id_estado" id="id_estado" class="form-control">
            <?php
            $estado = $web->obtenerEstado();
            for($i=0; $i<count($estado); $i++)
                echo "<option value ='".$estado[$i]['id_estado']."'>".$estado[$i]['estado']."</option>";
            ?>
            </select>
        </div>
		<div class="form-group">
			<input type="submit" name="enviar" value="Guardar" class="btn btn-dark">
		</div>
	</form>
</div>
<hr>
<?php include('footer.php'); ?>