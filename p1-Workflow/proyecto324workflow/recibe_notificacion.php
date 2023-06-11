<!----P12 F1--->
<?php
	$tramite=$_SESSION["codtramite"];
	
    $sql="SELECT a.codTramite, a.cantidad, b.* from workflowproyecto.empleadoadministrador a INNER JOIN tienda324.productos b ON b.id=a.idProducto and a.codTramite='$tramite'";
    $resp = mysqli_query($con, $sql);
	

	//borramos todos de la tabla temporal
	$sql="DELETE from empleadoadministrador where codTramite='$tramite'";
	$ejecuta = mysqli_query($con, $sql);
?>


<p>Pedido realizado</p>
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


<p>Lista de productos actualizada:</p>
<?php 
	include "conexion.inc.php";
	$sql = "select * from tienda324.productos";
	$resultado = mysqli_query($con, $sql);
?>

<table class="table table-striped">
  <thead>
    <tr>
      <th>Id</th>
      <th>Nombre</th>
      <th>Categoría</th>
      <th>Marca</th>
      <th>Precio</th>
      <th>Stock</th>
    </tr>
  </thead>
  <tbody>
    <?php
    while ($registros = mysqli_fetch_array($resultado)) {
      echo "<tr>";
      echo "<td>" . $registros["id"] . "</td>";
      echo "<td>" . $registros["nombre"] . "</td>";
      echo "<td>" . $registros["categoria"]. "</td>";
      echo "<td>" . $registros["marca"] . "</td>";
      echo "<td>" . $registros["precio"] . "</td>";
      echo "<td>" . $registros["stock"] . "</td>";
      echo "</tr>";
    }
    ?>
  </tbody>
</table>
