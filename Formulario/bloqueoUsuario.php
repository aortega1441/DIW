<?php
session_start();

$correo = $_SESSION["correo"];
$intentos = $_SESSION["Usuario_numero_intentos"];
$_SESSION["correo_valido"] = 0;
if ($intentos < 3) {
    $_SESSION["password_error"] = 1;
} else {
    $_SESSION["password_error"] = 0;
}

$_SESSION["correoRegistrado"] = 0;
$_SESSION["variableBandera"] = 0;

$conexion = mysqli_connect("localhost", "root", "", "usuarios") or
    die("Problemas con la conexion");

$intentos++;

if ($intentos <= 3) {
    $consulta = mysqli_query($conexion, "UPDATE usuarios SET Usuario_numero_intentos='$intentos' WHERE Usuario_email= '$correo'") or
        die("Problemas en el select:" . mysqli_error($conexion));
    $_SESSION["Usuario_numero_intentos"] = $intentos;

    if ($intentos == 3) {
        if ($_SESSION["Usuario_bloqueado"] == 0) {
            $fechaActual = date('Y-m-d');
            $consulta = mysqli_query($conexion, "UPDATE usuarios SET Usuario_bloqueado='1', Usuario_fecha_bloqueo='$fechaActual' WHERE Usuario_email= '$correo'") or
                die("Problemas en el select:" . mysqli_error($conexion));
            $_SESSION["Usuario_numero_intentos"] = 0;
            $_SESSION["Usuario_bloqueado"] = 1;
        }
    }
}

$url = "./";
header("HTTP/1.1 301 Moved Permanently");
header("Location: " . $url);
exit();
