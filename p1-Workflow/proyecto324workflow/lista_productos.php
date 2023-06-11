<!----P2 F1 ---->
<h2>Los productos disponibles son:</h2>
<?php 
	include "conexion.inc.php";
	$sql = "select * from tienda324.productos";
	$resultado = mysqli_query($con, $sql);
?>
<label for="producto">Ingrese producto para ver stock:</label>
<input type="producto" name="producto" id="producto" required>
<br>
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

