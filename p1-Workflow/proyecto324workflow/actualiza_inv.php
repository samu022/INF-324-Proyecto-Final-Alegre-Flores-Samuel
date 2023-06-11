<!----P7 F2 ----->
<?php
	$tramite=$_SESSION["codtramite"];
	$usuario=$_SESSION["usuario"];
	$sql="SELECT a.idProducto, a.cantidad from empleadoadministrador a where a.codTramite='$tramite'";
	$ejecuta = mysqli_query($con, $sql);
	while ($registros = mysqli_fetch_array($ejecuta)) {
		$cantidad = $registros["cantidad"];
	$id = $registros["idProducto"];
	$sqlUPDATE = "UPDATE tienda324.productos SET stock = stock - '$cantidad' WHERE id = '$id'";
	mysqli_query($con, $sqlUPDATE);

	}

	//borramos todos de la tabla temporal
	/*$sql="DELETE from empleadoadministrador where codTramite='$tramite'";
	$ejecuta = mysqli_query($con, $sql);*/
?>


<p>Inventario actualizado con exito: </p>
<img src="./imagenes/guardado.png">
<br>
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
      echo "<td>" . $registros["categoria"] . "</td>";
      echo "<td>" . $registros["marca"] . "</td>";
      echo "<td>" . $registros["precio"] . "</td>";
      echo "<td>" . $registros["stock"] . "</td>";
      echo "</tr>";
    }
    ?>
  </tbody>
</table>
