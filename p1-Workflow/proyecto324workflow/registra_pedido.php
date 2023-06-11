<!-----------P11 F1------->
<?php
	$tramite=$_SESSION["codtramite"];
	$sql="SELECT a.idProducto, a.cantidad from empleadoadministrador a where codTramite='$tramite'";
	$ejecuta = mysqli_query($con, $sql);
	while ($registros = mysqli_fetch_array($ejecuta)) {
		$cantidad=$registros["cantidad"];
		$id=$registros["idProducto"];
		$sqlUpdate = "UPDATE tienda324.productos SET stock = stock + '$cantidad' WHERE id = '$id'";
    	mysqli_query($con, $sqlUpdate);
	}

	//borramos todos de la tabla temporal
	/*$sql="DELETE from empleadoadministrador where codTramite='$tramite'";
	$ejecuta = mysqli_query($con, $sql);*/
?>


<p>Pedido registrado con exito: </p>
<img src="./imagenes/guardado.png">
<br>
<p>Lista de productos actualizados: </p>
<?php 
	include "conexion.inc.php";
	$sql = "select * from tienda324.productos";
	$resultado = mysqli_query($con, $sql);
?>

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Nombre</th>
      <th scope="col">Categoría</th>
      <th scope="col">Marca</th>
      <th scope="col">Precio</th>
      <th scope="col">Stock</th>
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
