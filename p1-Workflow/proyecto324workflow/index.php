<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>WorkFlow | Inicio</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/estilos.css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>   
    <div class="login-box">
        <img src="imagenes/imagen.jpg" alt="Logo" style="max-width: 100%;">
        <h2>BIENVENIDO AL SISTEMA</h2>
        <form method="POST" action = "control.php">
            <div class="user-box">
                <label>USUARIO</label>
                <br>
                <input type="text" id="username" name="usuario" required>
            </div>
            <div class="user-box">
                <label>CONTRASEÑA</label>
                <br>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" name="Ingresar" value="Ingresar"/>INGRESAR</button>
        </form>
    </div>
</body>
</html>

