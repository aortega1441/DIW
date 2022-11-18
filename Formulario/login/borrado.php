<?php
session_start();

$correo = $_SESSION["correo"];

$fechaActual = date('Y-m-d');
$conexion = mysqli_connect("localhost", "root", "", "usuarios") or
    die("Problemas con la conexion");
    $consulta = mysqli_query($conexion, "UPDATE usuarios SET Usuario_numero_intentos='0',Usuario_fecha_ultima_conexion='$fechaActual' WHERE Usuario_email= '$correo'") or
    die("Problemas en el select:" . mysqli_error($conexion));
session_unset();
session_destroy();

$url = "../";
header("HTTP/1.1 301 Moved Permanently");
header("Location: ".$url);
exit(); 
?>