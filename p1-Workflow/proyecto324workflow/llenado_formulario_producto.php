<!-------<?php echo "P4 F1"; ?>---------->
<h2>Llena el siguiente formulario para solicitar el producto:</h2>
<br>
<p>Seleccione productos a pedir: </p>
<?php 
	include "conexion.inc.php";
	$sql = "SELECT * from tienda324.productos";
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
      <th>Seleccionar</th>
      <th>Cantidad</th>
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
        echo "<td><input class='form-check-input' type='checkbox' name='productos[]' value='" . $registros["id"] . "-" . $registros["stock"] . "'></td>";
        echo "<td><input class='form-control' type='number' name='cantidad[" . $registros["id"] . "]' min='0'></td>";
        echo "</tr>";
    }
    ?>
  </tbody>
</table>
<br>
