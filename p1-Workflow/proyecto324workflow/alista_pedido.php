<!----P9 F1--->
<?php
	$tramite=$_SESSION["codtramite"];
	$sql="SELECT * from empleadoadministrador where codTramite='$tramite' LIMIT 1";
	$ejecuta = mysqli_query($con, $sql);
	$resultado = mysqli_fetch_array($ejecuta);
	$empleado=$resultado["empleado"];
	$tramite1=$resultado["codTramite"];
    $sql="SELECT a.codTramite, a.cantidad, b.* from workflowproyecto.empleadoadministrador a INNER JOIN tienda324.productos b ON b.id=a.idProducto and a.codTramite='$tramite'";
    $resp = mysqli_query($con, $sql);
?>
<h3>Dar click en siguiente cuando todos los porductos esten listos para su envio: </h3>
<img src="./imagenes/mandar.png"><br>

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Nombre</th>
      <th scope="col">Categoría</th>
      <th scope="col">Marca</th>
      <th scope="col">Cantidad solicitada</th>
      <th scope="col">Precio a pagar (Bs.)</th>
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
