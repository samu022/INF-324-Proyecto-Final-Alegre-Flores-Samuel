<?php
	session_start();
	include "conexion.inc.php";

	$rol = $_SESSION["rol"];

	if ($rol == 'cliente' || $rol == 'empleado') {
		$proceso = "P1";
	}
	elseif ($rol == 'administrador') {
		$proceso = "P5";
	}
	elseif ($rol == 'proveedor') {
		$proceso = "P7";
	}

	$sql = "SELECT * FROM flujo WHERE (proceso = 'P1' AND rol = '$rol') OR (proceso = 'P5' AND rol = '$rol') OR (proceso = 'P7' AND rol = '$rol')";

	$resultado = mysqli_query($con, $sql);
?>

<html>
<head>
	<title>Flujos disponibles</title>
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
			text-align: center;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="card">
			<?php while ($registros = mysqli_fetch_array($resultado)) { ?>
				<h3><?php echo $registros['flujo']; ?></h3>
				<a href="nuevoflujorol.php?flujo=<?php echo $registros['flujo']; ?>&proceso=<?php echo $proceso; ?>" class="btn btn-primary">
					Nuevo
				</a>
				<br>
			<?php } ?>
		</div>
	</div>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<div class="card-footer text-muted">
    	LEGUA VILLEGAS JHOEL MAURICIO
  	</div>
</body>
</html>
