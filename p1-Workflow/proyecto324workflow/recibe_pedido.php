<!---<?php echo "P7 F1"; ?>--->

<?php
	$tramite=$_SESSION["codtramite"];
	$sql="SELECT * from empleadoadministrador where codTramite='$tramite' LIMIT 1";
	$ejecuta = mysqli_query($con, $sql);
	$resultado = mysqli_fetch_array($ejecuta);
	$empleado=$resultado["empleado"];
	$tramite1=$resultado["codTramite"];
    $total=0;
    $sql="SELECT a.codTramite, a.cantidad, b.* from workflowproyecto.empleadoadministrador a INNER JOIN tienda324.productos b ON b.id=a.idProducto and a.codTramite='$tramite'";
    $resp = mysqli_query($con, $sql);
?>
<h1>Trámite #: <?php echo $tramite1; ?></h1>
<h3>Informe de pedido realizado por: <?php echo $empleado; ?></h3>
<table class="table table-striped">
  <thead>
    <tr>
      <th>Id</th>
      <th>Nombre</th>
      <th>Categoría</th>
      <th>Marca</th>
      <th>Cantidad solicitada</th>
      <th>Precio a pagar (Bs.)</th>
    </tr>
  </thead>
  <tbody>
    <?php
    while ($registros = mysqli_fetch_array($resp)) {
      echo "<tr>";
      echo "<td>" . $registros["id"] . "</td>";
      echo "<td>" . $registros["nombre"] . "</td>";
      echo "<td>" . $registros["categoria"] . "</td>";
      echo "<td>" . $registros["marca"] . "</td>";
      echo "<td>" . $registros["cantidad"] . "</td>";
      $precioCompra = $registros["precio"] * 0.15;
      echo "<td>" . $precioCompra . "</td>";
      echo "</tr>";
    }
    ?>
  </tbody>
</table>





