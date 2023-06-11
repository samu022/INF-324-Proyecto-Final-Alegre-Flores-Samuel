<!-----P8 F1------>
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
<p>Informe de pedido realizado por: <?php echo $empleado; ?>  </p>
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

<p>¿Tiene el stock suficiente para realizar el pedido?</p>
<label for="si">Sí</label>
<input type="radio" id="Si" name="Si" value="Si">
<br>
<label for="no">No</label>
<input type="radio" id="No" name="No" value="No" onclick="mostrarCuadroTexto()">

<br>
<label for="explicacion">Explicación de que productos no tiene stock:</label>
<textarea id="explicacion" name="explicacion" rows="4" disabled></textarea><br>
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