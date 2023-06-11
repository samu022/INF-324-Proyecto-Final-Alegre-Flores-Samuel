<!---- P8  F2--->
<?php
	$tramite=$_SESSION["codtramite"];
	
    $sql="SELECT a.codTramite, a.cantidad, b.* from workflowproyecto.empleadoadministrador a INNER JOIN tienda324.productos b ON b.id=a.idProducto and a.codTramite='$tramite'";
    $resp = mysqli_query($con, $sql);
	

	//borramos todos de la tabla temporal
	$sql="DELETE from empleadoadministrador where codTramite='$tramite'";
	$ejecuta = mysqli_query($con, $sql);
?>

<h3>Compra realizada exitosamente</h3>
<h5>Productos comprados</h5>
<table class="table table-striped">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Categoría</th>
      <th>Marca</th>
      <th>Cantidad solicitada</th>
      <th>Precio unitario (Bs.)</th>
      <th>Precio total (Bs.)</th>
    </tr>
  </thead>
  <tbody>
    <?php
    while ($registros = mysqli_fetch_array($resp)) {
      $preciototal = $registros["precio"] * $registros["cantidad"];
      echo "<tr>";
      echo "<td>" . $registros["nombre"] . "</td>";
      echo "<td>" . $registros["categoria"] . "</td>";
      echo "<td>" . $registros["marca"] . "</td>";
      echo "<td>" . $registros["cantidad"] . "</td>";
      echo "<td>" . $registros["precio"] . "</td>";
      echo "<td>" . $preciototal . "</td>";
      echo "</tr>";
    }
    ?>
  </tbody>
</table>


