<?php
/*
http://localhost/work/mflujo.php?flujo=F1&proceso=P1
*/
include "conexion.inc.php";
session_start();
$flujo = $_GET["flujo"];
$proceso = $_GET["proceso"];

$pantalla = $_GET["pantalla"];
$tramite = $_SESSION["codtramite"];
$uuu = $_SESSION["usuario"]; //usuario global

$condi = "SELECT tipo FROM flujo ";
$condi .= "WHERE flujo='$flujo' and proceso='$proceso' ";
$result = mysqli_query($con, $condi);
$regist = mysqli_fetch_array($result);
$tipo = $regist["tipo"];

if ($tipo == 'C') {

    if (isset($_GET["Siguiente"])) {
        if (isset($_GET["Si"])) {
            $sql = "SELECT * FROM flujocondicional ";
            $sql .= "WHERE codFlujo='$flujo' and codProceso='$proceso'";
            $resultado = mysqli_query($con, $sql);
            $registros = mysqli_fetch_array($resultado);
            $procesoSiguiente = $registros["codProcesoSi"];
        }
        if (isset($_GET["No"])) {
            $sql = "SELECT * FROM flujocondicional ";
            $sql .= "WHERE codFlujo='$flujo' and codProceso='$proceso'";
            $resultado = mysqli_query($con, $sql);
            $registros = mysqli_fetch_array($resultado);
            $procesoSiguiente = $registros["codProcesoNo"];
        }
        //completar el flujo usuario
        $today = getdate();
	    $fecha_fin = $today["year"] . "-" . $today["mon"] . "-" . $today["mday"] . " " . $today["hours"] . ":" . $today["minutes"];
	    $sql = "UPDATE flujousuario SET fecha_fin='$fecha_fin' WHERE numerotramite='$tramite' and proceso='$proceso' and flujo='$flujo' LIMIT 1";
	    $resultado = mysqli_query($con, $sql);
        if(($procesoSiguiente == "P6") && ($flujo == "F1") && !(isset($_GET["Anterior"]))){

            //enviamos mensaje de error a empleado
            //creamos flujo y conseguimos a empleado
            $sql="SELECT empleado from empleadoadministrador where codTramite='$tramite' LIMIT 1";
            $ejecuta = mysqli_query($con, $sql);
            $registro=mysqli_fetch_array($ejecuta);
            $usuario=$registro["empleado"];
            $today = getdate();
            $fecha_ini = $today["year"] . "-" . $today["mon"] . "-" . $today["mday"] . " " . $today["hours"] . ":" . $today["minutes"];
            $fecha_fin = "NULL";
            $proceso="P6";
            $flujo="F1";
            $sql = "INSERT INTO flujousuario VALUES ('" . $tramite . "','" . $flujo . "','$proceso','" . $fecha_ini . "', ";
            $sql .= $fecha_fin . ",'" . $usuario . "')";
            $resultado = mysqli_query($con, $sql);
            //eliminamos de la tabla temporal
            $sql="Delete from empleadoadministrador where codTramite='$tramite'";
            $ejecuta = mysqli_query($con, $sql);

            $explicacion=$_GET["explicacion"];
            //guardamos los datos en APempleado
            $sql = "INSERT INTO apempleado VALUES ('$tramite', '$uuu', '$explicacion')";
            $resultado = mysqli_query($con, $sql);
            header("Location: bandejaE.php");
            exit;
        }
        if(($procesoSiguiente == "P5") && ($flujo == "F2") && !(isset($_GET["Anterior"]))){

            //enviamos mensaje de error a cliente
            //creamos flujo y conseguimos a cliente
            $sql="SELECT empleado from empleadoadministrador where codTramite='$tramite' LIMIT 1";
            $ejecuta = mysqli_query($con, $sql);
            $registro=mysqli_fetch_array($ejecuta);
            $usuario=$registro["empleado"];
            $today = getdate();
            $fecha_ini = $today["year"] . "-" . $today["mon"] . "-" . $today["mday"] . " " . $today["hours"] . ":" . $today["minutes"];
            $fecha_fin = "NULL";
            $proceso="P5";
            $flujo="F2";
            $sql = "INSERT INTO flujousuario VALUES ('" . $tramite . "','" . $flujo . "','$proceso','" . $fecha_ini . "', ";
            $sql .= $fecha_fin . ",'" . $usuario . "')";
            $resultado = mysqli_query($con, $sql);
            //eliminamos de la tabla temporal
            $sql="Delete from empleadoadministrador where codTramite='$tramite'";
            $ejecuta = mysqli_query($con, $sql);

            $explicacion=$_GET["explicacion"];
            //guardamos los datos en APempleado
            $sql = "INSERT INTO apempleado VALUES ('$tramite', '$uuu', '$explicacion')";
            $resultado = mysqli_query($con, $sql);
            header("Location: bandejaE.php");
            exit;
        }
         if(($procesoSiguiente == "P7") && ($flujo == "F1") && !(isset($_GET["Anterior"]))){
            //enviamos al proveedor con menos pedidos
            // Hallar proveedor conmenos tareas
            $sql = "SELECT username, contador FROM (
                        SELECT a.username, COUNT(a.username) AS contador
                        FROM workflowproyecto.flujousuario b
                        INNER JOIN tienda324.usuario a ON a.rol = 'proveedor' AND a.username = b.usuario
                        GROUP BY usuario
                    ) AS subconsulta
                    ORDER BY contador ASC
                    LIMIT 1;";
            $resultado2 = mysqli_query($con, $sql);
            $registros2 = mysqli_fetch_array($resultado2);
            $usuario = $registros2["username"];

            $flujo = "F1";
            $proceso = "P7";
            
            $today = getdate();
            $fecha_ini = $today["year"] . "-" . $today["mon"] . "-" . $today["mday"] . " " . $today["hours"] . ":" . $today["minutes"];
            $fecha_fin = "NULL";

            $sql = "INSERT INTO flujousuario VALUES ('" . $tramite . "','" . $flujo . "','$proceso','" . $fecha_ini . "' ";
            $sql .= "," . $fecha_fin . ",'" . $usuario . "')";
            $resultado = mysqli_query($con, $sql);
            header("Location: carga.php?usuario='$usuario'");
            exit;
        }
        
    }
    if (isset($_GET["Anterior"])) {
        $sql = "SELECT * FROM flujo ";
        $sql .= "WHERE flujo='$flujo' and proceso_Siguiente='$proceso'";
        $resultado = mysqli_query($con, $sql);
        $registros = mysqli_fetch_array($resultado);
        $procesoSiguiente = $registros["proceso"];
        if ($procesoSiguiente == null) {
            $sql = "SELECT * FROM flujocondicional ";
            $sql .= "WHERE codFlujo='$flujo' and (codProcesoSi='$proceso' or codProcesoNo='$proceso') ";
            $resultado = mysqli_query($con, $sql);
            $registros = mysqli_fetch_array($resultado);
            $procesoSiguiente = $registros["codProceso"];
        }
    }

    
	        header("Location: mflujo.php?flujo=$flujo&proceso=$procesoSiguiente");
	
} else {
    if (isset($_GET["Anterior"])) {

        $sql = "SELECT * FROM flujo ";
        $sql .= "WHERE flujo='$flujo' and proceso_siguiente='$proceso'";
        $resultado = mysqli_query($con, $sql);
        $registros = mysqli_fetch_array($resultado);

        $procesoSiguiente = $registros["proceso"];
        if ($procesoSiguiente == null) {

            $sql = "SELECT * FROM flujocondicional ";
            $sql .= "WHERE codFlujo='$flujo' and (codProcesoSi='$proceso' or codProcesoNo='$proceso') ";
            $resultado = mysqli_query($con, $sql);
            $registros = mysqli_fetch_array($resultado);
            $procesoSiguiente = $registros["codProceso"];
            
        }if($proceso=="P1" || ($proceso=="P5" && $flujo=="F1") || ($proceso=="P7" && $flujo=="F1") || ($proceso=="P6" && $flujo=="F1") || ($proceso=="P10" && $flujo=="F1") ||($proceso=="P12" && $flujo=="F1")  || ($proceso=="P4" && $flujo=="F2") || ($proceso=="P5" && $flujo=="F2") || ($proceso=="P8" && $flujo=="F2")   ){
			$procesoSiguiente = $proceso;

        }

    }
    if (isset($_GET["Siguiente"])) {
        $sql = "SELECT * FROM flujo ";
        $sql .= "WHERE flujo='$flujo' and proceso='$proceso'";
        $resultado = mysqli_query($con, $sql);
        $registros = mysqli_fetch_array($resultado);
        $procesoSiguiente = $registros["proceso_siguiente"];


        //actualizar flujo
        $today = getdate();
	    $fecha_fin = $today["year"] . "-" . $today["mon"] . "-" . $today["mday"] . " " . $today["hours"] . ":" . $today["minutes"];
        
	    $sql = "UPDATE flujousuario SET fecha_fin='$fecha_fin' WHERE numerotramite='$tramite' and proceso='$proceso' AND fecha_fin IS NULL and flujo='$flujo' LIMIT 1";
	    $resultado = mysqli_query($con, $sql);
        //el ultimo
        if($procesoSiguiente == null && ($registros["proceso"]== "P12" && $flujo== "F1") || ($registros["proceso"]== "P8" && $flujo== "F2")){
            $procesoSiguiente=$registros["proceso"];
            header("Location: bandejaE.php");
            exit;
        }
        if(($procesoSiguiente=="P3") && $flujo=="F1"){
            $pro=$_GET["producto"];
            header("Location: mflujo.php?flujo=$flujo&proceso=$procesoSiguiente&producto=$pro");
            exit;
        }

    }
    //completar el flujo usuario
        $today = getdate();
        $fecha_fin = $today["year"] . "-" . $today["mon"] . "-" . $today["mday"] . " " . $today["hours"] . ":" . $today["minutes"];
        $sql = "UPDATE flujousuario SET fecha_fin='$fecha_fin' WHERE numerotramite='$tramite' and proceso='$proceso'";
        $resultado = mysqli_query($con, $sql);
    /* Cambios de roles */
    if ((($procesoSiguiente == "P5" || $procesoSiguiente == "P6" || $procesoSiguiente == "P7" || $procesoSiguiente == "P10" || $procesoSiguiente == "P12") && ($flujo == "F1")) || (($procesoSiguiente == "P4" || $procesoSiguiente == "P5" || $procesoSiguiente == "P8" ) && ($flujo == "F2")) && !(isset($_GET["Anterior"]))) {
        
        if(($procesoSiguiente == "P5") && ($flujo == "F1") && !(isset($_GET["Anterior"]))){
            //guardamos los datos del empleado y lo enviamos al admin
             if (isset($_GET["productos"]) && isset($_GET["cantidad"])) {
                $productosSeleccionados = $_GET["productos"];
                $cantidadProductos = $_GET["cantidad"];

                foreach ($productosSeleccionados as $producto) {
                    $productoDatos = explode("-", $producto);
                    $idProducto = $productoDatos[0];
                    $stockProducto = $productoDatos[1];

                    // Obtener la cantidad correspondiente al producto seleccionado
                    $cantidad = $cantidadProductos[$idProducto];

                    //guardamos en empleadoadministrador
                    $sql="INSERT INTO empleadoadministrador VALUES ('$tramite', '$idProducto', '$cantidad', '$uuu')";
                    $ejecuta = mysqli_query($con, $sql);
                }
            }
            //Aqui agregamos a la bandeja de entrada de admin
            $sql="SELECT username from tienda324.usuario where rol='administrador' LIMIT 1";
            $ejecuta = mysqli_query($con, $sql);
            $registro=mysqli_fetch_array($ejecuta);
            $usuario=$registro["username"];
            $today = getdate();
            $fecha_ini = $today["year"] . "-" . $today["mon"] . "-" . $today["mday"] . " " . $today["hours"] . ":" . $today["minutes"];
            $fecha_fin = "NULL";
            $proceso="P5";
            $flujo="F1";
            $sql = "INSERT INTO flujousuario VALUES ('" . $tramite . "','" . $flujo . "','$proceso','" . $fecha_ini . "', ";
            $sql .= $fecha_fin . ",'" . $usuario . "')";
            $resultado = mysqli_query($con, $sql);

            header("Location: bandejaE.php");
            exit;
        } 
        if(($procesoSiguiente == "P10") && ($flujo == "F1") && !(isset($_GET["Anterior"]))){
            //creamos el flujo del empleado
             //Aqui agregamos a la bandeja de entrada de admin
            $sql="SELECT empleado from empleadoadministrador where codTramite='$tramite' LIMIT 1";
            $ejecuta = mysqli_query($con, $sql);
            $registro=mysqli_fetch_array($ejecuta);
            $usuario=$registro["empleado"];
            $today = getdate();
            $fecha_ini = $today["year"] . "-" . $today["mon"] . "-" . $today["mday"] . " " . $today["hours"] . ":" . $today["minutes"];
            $fecha_fin = "NULL";
            $proceso="P10";
            $flujo="F1";
            $sql = "INSERT INTO flujousuario VALUES ('" . $tramite . "','" . $flujo . "','$proceso','" . $fecha_ini . "', ";
            $sql .= $fecha_fin . ",'" . $usuario . "')";
            $resultado = mysqli_query($con, $sql);
            header("Location: bandejaE.php");
            exit;
        }
        if(($procesoSiguiente == "P12") && ($flujo == "F1") && !(isset($_GET["Anterior"]))){
            //creamos el flujo del adminsitrador
             //Aqui agregamos a la bandeja de entrada de admin
            $sql="SELECT username from tienda324.usuario where rol='administrador' LIMIT 1";
            $ejecuta = mysqli_query($con, $sql);
            $registro=mysqli_fetch_array($ejecuta);
            $usuario=$registro["username"];
            $today = getdate();
            $fecha_ini = $today["year"] . "-" . $today["mon"] . "-" . $today["mday"] . " " . $today["hours"] . ":" . $today["minutes"];
            $fecha_fin = "NULL";
            $proceso="P12";
            $flujo="F1";
            $sql = "INSERT INTO flujousuario VALUES ('" . $tramite . "','" . $flujo . "','$proceso','" . $fecha_ini . "', ";
            $sql .= $fecha_fin . ",'" . $usuario . "')";
            $resultado = mysqli_query($con, $sql);
            header("Location: bandejaE.php");
            exit;
        }
        if(($procesoSiguiente == "P4") && ($flujo == "F2") && !(isset($_GET["Anterior"]))){
            //creamos entrada a empleado con menos carga y mandamos los productos
            //enviamos al proveedor con menos pedidos
            // Hallar proveedor conmenos tareas
            $sql = "SELECT username, contador FROM (
                        SELECT a.username, COUNT(a.username) AS contador
                        FROM workflowproyecto.flujousuario b
                        INNER JOIN tienda324.usuario a ON a.rol = 'empleado' AND a.username = b.usuario
                        GROUP BY usuario
                    ) AS subconsulta
                    ORDER BY contador ASC
                    LIMIT 1;";
            $resultado2 = mysqli_query($con, $sql);
            $registros2 = mysqli_fetch_array($resultado2);
            $usuario = $registros2["username"];

            $flujo = "F2";
            $proceso = "P4";
            
            $today = getdate();
            $fecha_ini = $today["year"] . "-" . $today["mon"] . "-" . $today["mday"] . " " . $today["hours"] . ":" . $today["minutes"];
            $fecha_fin = "NULL";

            $sql = "INSERT INTO flujousuario VALUES ('" . $tramite . "','" . $flujo . "','$proceso','" . $fecha_ini . "' ";
            $sql .= "," . $fecha_fin . ",'" . $usuario . "')";
            $resultado = mysqli_query($con, $sql);
            //ahora creado el flujo empleado debemos guardar los pedidos en la bd
            //guardamos los datos del empleado y lo enviamos al admin
             if (isset($_GET["productos"]) && isset($_GET["cantidad"])) {
                $productosSeleccionados = $_GET["productos"];
                $cantidadProductos = $_GET["cantidad"];

                foreach ($productosSeleccionados as $producto) {
                    $productoDatos = explode("-", $producto);
                    $idProducto = $productoDatos[0];
                    $stockProducto = $productoDatos[1];

                    // Obtener la cantidad correspondiente al producto seleccionado
                    $cantidad = $cantidadProductos[$idProducto];

                    //guardamos en empleadoadministrador
                    $sql="INSERT INTO empleadoadministrador VALUES ('$tramite', '$idProducto', '$cantidad', '$uuu')";
                    $ejecuta = mysqli_query($con, $sql);
                }
            }

            header("Location: carga.php?usuario='$usuario'");
            exit;
        }
        if(($procesoSiguiente == "P8") && ($flujo == "F2") && !(isset($_GET["Anterior"]))){
            //Creamos un nuevo flujo cliente 
            $sql="SELECT empleado from empleadoadministrador where codTramite='$tramite' LIMIT 1";
            $ejecuta = mysqli_query($con, $sql);
            $registro=mysqli_fetch_array($ejecuta);
            $usuario=$registro["empleado"];
            $today = getdate();
            $fecha_ini = $today["year"] . "-" . $today["mon"] . "-" . $today["mday"] . " " . $today["hours"] . ":" . $today["minutes"];
            $fecha_fin = "NULL";
            $proceso="P8";
            $flujo="F2";
            $sql = "INSERT INTO flujousuario VALUES ('" . $tramite . "','" . $flujo . "','$proceso','" . $fecha_ini . "', ";
            $sql .= $fecha_fin . ",'" . $usuario . "')";
            $resultado = mysqli_query($con, $sql);

            header("Location: bandejaE.php");
            exit;
        }

        
    }  

    header("Location: mflujo.php?flujo=$flujo&proceso=$procesoSiguiente");
    
}

?>
