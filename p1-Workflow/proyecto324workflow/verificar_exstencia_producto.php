<!---<?php echo "P3 F1"; ?>--->
<h2>Verifica el stock en la tienda</h2>
<br>
<br>
<?php 
  include "conexion.inc.php";
  if(isset($_GET['producto'])){
    $pro = $_GET['producto'];
  }
  else{
    $pro = "";
  }
  $sql = "SELECT * FROM tienda324.productos WHERE nombre LIKE '%$pro%'";
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

<p>¿Existe el stock del producto?</p>
<label for="si">Sí o seguir buscando</label>
<input type="radio" id="Si" name="Si" value="Si">
<br>
<label for="no">No </label>
<input type="radio" id="No" name="No" value="No">
<br>
<br>
  

