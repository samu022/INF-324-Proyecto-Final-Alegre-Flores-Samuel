<!---<?php echo "P5 F1"; ?>--->

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
<h1>Tramite #: <?php echo $tramite1; ?>  </h1>
<h3>Informe de pedido realizado por: <?php echo $empleado; ?>  </h3>
<table class="table table-striped">
  <thead>
    <tr>
      <th>Id</th>
      <th>Nombre</th>
      <th>Categoría</th>
      <th>Marca</th>
      <th>Precio venta (Bs.)</th>
      <th>Stock</th>
      <th>Cantidad a pedir</th>
      <th>Precio compra (Bs.)</th>
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
      echo "<td>" . $registros["precio"] . "</td>";
      echo "<td>" . $registros["stock"] . "</td>";
      echo "<td>" . $registros["cantidad"] . "</td>";
      $precioCompra = $registros["precio"] * 0.15;
      echo "<td>" . $precioCompra . "</td>";
      $total = $total + ($precioCompra * $registros["cantidad"]);
      echo "</tr>";
    }
    ?>
  </tbody>
</table>

<p>El costo total del pedido será: <?php echo $total; ?>  Bs.</p>

<div class="form-group">
  <h4 class="mb-3">¿Aprueba el pedido?</h4>
  <div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" id="Si" name="Si" value="Si">
    <label class="form-check-label" for="si">Sí</label>
  </div>
  <div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" id="No" name="No" value="No" onclick="mostrarCuadroTexto()">
    <label class="form-check-label" for="no">No</label>
  </div>
</div>

<div class="form-group">
  <label for="explicacion">Explicación:</label>
  <textarea class="form-control" id="explicacion" name="explicacion" rows="4" disabled></textarea>
</div>

<p>Al dar siguiente se enviará al empleado</p>

<script>
  function mostrarCuadroTexto() {
    var checkboxNo = document.getElementById("No");
    var cuadroTexto = document.getElementById("explicacion");

    if (checkboxNo.checked) {
      cuadroTexto.removeAttribute("disabled");
    } else {
      cuadroTexto.setAttribute("disabled", "disabled");
    }
  }
</script>
