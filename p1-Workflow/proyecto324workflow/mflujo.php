<?php
/*
http://localhost/segundoparcialworkflow/mflujo.php?flujo=F1&proceso=P1
*/
include "conexion.inc.php";
$flujo = $_GET["flujo"];
$proceso = $_GET["proceso"];

session_start();

$sql = "SELECT * FROM flujo ";
$sql .= "WHERE flujo='$flujo' AND proceso='$proceso'";
$resultado = mysqli_query($con, $sql);
$registros = mysqli_fetch_array($resultado);
$pantalla = $registros["pantalla"];
?>

<html>
<head>
	<title>Proceso de inscripción a materias</title>
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
	</style>
</head>
<body>
	<div class="container">
		<div class="card">
			<div class="card-body">
				<form action="motor.php" method="GET">
					<?php include $pantalla . ".php"; ?><br/>
					<input type="hidden" name="pantalla" value="<?php echo $pantalla; ?>">
					<input type="hidden" name="flujo" value="<?php echo $flujo; ?>">
					<input type="hidden" name="proceso" value="<?php echo $proceso; ?>">
						<input type="submit" class="btn btn-primary" value="Anterior" name="Anterior">
						<input type="submit" class="btn btn-primary" value="Siguiente" name="Siguiente">
				</form>
			</div>
		</div>
	</div>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
