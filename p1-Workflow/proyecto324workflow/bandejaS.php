<?php
session_start();

include "conexion.inc.php";
$sql = "SELECT * FROM flujousuario ";
$sql .= "WHERE usuario='" . $_SESSION["usuario"] . "' ";
$sql .= "AND fecha_fin IS NOT NULL ";
$resultado = mysqli_query($con, $sql);
?>
<html>
<head>
	<title>Flujos completados</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<style>
		.container {
			display: flex;
			justify-content: center;
			align-items: center;
			height: 100vh;
		}
		.card {
			width: 500px;
			padding: 20px;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="card">
			<div class="card-body">
				<table class="table">
					<thead>
						<tr>
							<th>Flujo</th>
							<th>Proceso</th>
							<th>Fecha inicio</th>
							<th>Fecha fin</th>
						</tr>
					</thead>
					<tbody>
						<?php while ($registros = mysqli_fetch_array($resultado)) { ?>
							<tr>
								<td><?php echo $registros["flujo"]; ?></td>
								<td><?php echo $registros["proceso"]; ?></td>
								<td><?php echo $registros["fecha_inicio"]; ?></td>
								<td><?php echo $registros["fecha_fin"]; ?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
				<br>
				<a href="bandejaE.php" class="btn btn-primary">Volver</a>
			</div>
		</div>
	</div>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
