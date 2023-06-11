<!---P6 F2--->
<?php
	$tramite=$_SESSION["codtramite"];
	$usuario=$_SESSION["usuario"];
	$sql="SELECT a.idProducto, a.cantidad, a.empleado, b.* FROM workflowproyecto.empleadoadministrador a INNER JOIN tienda324.productos b where a.codTramite='$tramite' and a.idProducto=b.id";
	$ejecuta = mysqli_query($con, $sql);
	$today = getdate();
	$fecha = $today["year"] . "-" . $today["mon"] . "-" . $today["mday"] . " " . $today["hours"] . ":" . $today["minutes"];
	while ($registros = mysqli_fetch_array($ejecuta)) {
		$cantidad=$registros["cantidad"];
		$precio=$registros["precio"];
		$id=$registros["idProducto"];
		$empleado=$registros["empleado"];
		$sqlInsert = "INSERT INTO tienda324.venta VALUES ('$tramite', '$usuario', '$empleado','$id','$cantidad','$precio', '$fecha')";
    	mysqli_query($con, $sqlInsert);
	}

	//borramos todos de la tabla temporal
	/*$sql="DELETE from empleadoadministrador where codTramite='$tramite'";
	$ejecuta = mysqli_query($con, $sql);*/
?>


<p>Venta registrada con exito: </p>
<img src="./imagenes/guardado.png">
<br>
