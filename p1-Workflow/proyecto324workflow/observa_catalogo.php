<!---- P2 F2 ---->
<p>Los productos disponibles son: </p>
<?php 
	include "conexion.inc.php";
	$sql = "select * from tienda324.productos";
	$resultado = mysqli_query($con, $sql);
?>
<table class="table">
  <thead>
    <tr>
      <th>Id</th>
      <th>Nombre</th>
      <th>Categoría</th>
      <th>Marca</th>
      <th>Precio Bs.</th>
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
      echo "</tr>";
    }
    ?>
  </tbody>
</table>

