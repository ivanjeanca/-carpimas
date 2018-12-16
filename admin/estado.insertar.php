<?php 
include('header.php'); 
$web->validarRol(array("Administrador"));
$web->validarPermiso(array("CRUD"));

if(isset($_POST['enviar'])){
    $estado = $_POST['estado'];
    $id_pais = $_POST['id_pais'];
   	$statement = $web->db->prepare("insert into estado (estado, id_pais) values (:estado, :id_pais)");
    $statement->bindParam(":estado", $estado);
    $statement->bindParam(":id_pais", $id_pais);
	$statement->execute();

   	echo '<div class="alert alert-success" role="alert">El estado se insertó correctamente<a href="estado.php" class="btn btn-dark" style="margin-left:30px;">Volver a Estado</a></div>';
}
?>

<h1 class="display-4">Insertar estado</h1>
<hr>

<div class="container">
	<form action="estado.insertar.php" method="post" class="lead">
		<div class="form-group">
			<label>Estado</label>
	   		<input type="text" name="estado" required class="form-control">
		</div>
        <div class="form-group">
            <label>País</label> 
            <select name="id_pais" id="id_pais" class="form-control">
            <?php
            $pais = $web->obtenerPais();
            for($i=0; $i<count($pais); $i++)
                echo "<option value ='".$pais[$i]['id_pais']."'>".$pais[$i]['pais']."</option>";
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