<!---*-P5 F2---->
<?php 
	include "conexion.inc.php";
	$tramite=$_SESSION["codtramite"];
	$sql = "SELECT * from apempleado where codTramite='$tramite' limit 1";
	$resultado = mysqli_query($con, $sql);
	$registro=mysqli_fetch_array($resultado);
	$tramite=$registro["codTramite"];
	$usuario=$registro["usuario"];
	$explicacion=$registro["explicacion"];

	//borramos
	$sql = "DELETE * from apempleado where codTramite='$tramite'";
	$resultado = mysqli_query($con, $sql);
?>
<p>Informe de rechazo recibido por: <?php echo $usuario ?>: </p>
<label for="texto">Explicación:</label>
<textarea id="texto" name="texto" rows="4" cols="50"><?php echo $explicacion ?></textarea>

