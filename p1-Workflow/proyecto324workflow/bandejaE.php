<?php
session_start();

include "conexion.inc.php";
$sql = "SELECT * FROM workflowproyecto.flujousuario ";
$sql .= "WHERE usuario='" . $_SESSION["usuario"] . "' ";
$sql .= "AND fecha_fin IS NULL ";
$resultado = mysqli_query($con, $sql);
?>
<html>
<head>
	<title>Bandeja de entrada</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<style>
		.container {
			display: flex;
			justify-content: center;
			align-items: center;
			height: 100vh;
		}
		.card {
			width: 1000px;
			padding: 20px;
		}
		.logout {
			margin-bottom: 10px;
		}
		.button {
			margin-top: 10px;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="card">
			<div class="card-body">
				<a href="cerrar.php" class="btn btn-primary logout">Cerrar sesión</a>
				<table class="table">
					<thead>
						<tr>
							<th>Flujo</th>
							<th>Proceso</th>
							<th>Operacion</th>
						</tr>
					</thead>
					<tbody>
						<?php while ($registros = mysqli_fetch_array($resultado)) { ?>
							<tr>
								<td><?php echo $registros["flujo"]; ?></td>
								<td><?php echo $registros["proceso"]; ?></td>
								<td>
									<a href="mflujo.php?flujo=<?php echo $registros["flujo"]; ?>&proceso=<?php echo $registros["proceso"]; ?>" class="btn btn-primary">Ir</a>
								</td>
							</tr>
							<?php $_SESSION['codtramite'] = $registros["numerotramite"]; ?>
						<?php } ?>
					</tbody>
				</table>
				<br>
				<a href="nuevoflujo.php" class="btn btn-primary button">Nuevo</a><br>
				<a href="bandejaS.php" class="btn btn-primary button">Ver bandeja de salida</a><br>
			</div>
		</div>
	</div>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	
</body>
</html>
