<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Comprobacion Usuario</title>
</head>

<body>

  <?php

  $correo = $contrasena = "";
  $correoErr = $contrasenaErr = "";

  $detectarError = 0;
  $contrasenaNoValida = 0;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["correo"])) {
      $correoErr = "Usuario es requerido";
      $detectarError = 1;
    } else {
      $correo = test_input($_POST["correo"]);
    }

    if (empty($_POST["contrasena"])) {
      $contrasenaErr = "Contraseña es requerida";
      $detectarError = 1;
    } else {
      $contrasena = test_input($_POST["contrasena"]);
    }
  }

  function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  if ($detectarError == 1) {

    echo $correoErr;

    echo $contrasenaErr;
  } else {


    $conexion = mysqli_connect("localhost", "root", "", "usuarios") or
      die("Problemas con la conexion");

    $consulta = mysqli_query($conexion, "select *
                        from usuarios where Usuario_email='$correo'") or
      die("Problemas en el select:" . mysqli_error($conexion));

    if ($reg = mysqli_fetch_array($consulta)) {

      $claveComprobar = $reg['Usuario_clave'];

      $_SESSION["Usuario_bloqueado"] = $reg["Usuario_bloqueado"];
      $_SESSION["Usuario_fecha_bloqueo"] = $reg["Usuario_fecha_bloqueo"];
      $_SESSION["Usuario_numero_intentos"] = $reg["Usuario_numero_intentos"];

      if ($_SESSION["Usuario_bloqueado"] != 0) {

        $_SESSION["correo"] = $correo;
        $_SESSION["correo_valido"] = 0;
        $_SESSION["password_error"] = 0;
        $_SESSION["correoRegistrado"] = 0;
        $_SESSION["variableBandera"] = 0;
        $_SESSION["rangoNoPermitido"] = 0;
        $url = "./";
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: " . $url);
        exit();
      } else {



        if (password_verify($contrasena, $claveComprobar)) {

          $_SESSION["correo"] = $reg['Usuario_email'];
          $_SESSION["id"] = $reg['Usuario_id'];
          $_SESSION["Usuario_fotografia"] = $reg["Usuario_fotografia"];
          $_SESSION["Usuario_perfil"] = $reg["Usuario_perfil"];
          $_SESSION["correo_valido"] = 0;
          $_SESSION["password_error"] = 0;
          $_SESSION["correoRegistrado"] = 0;
          $_SESSION["variableBandera"] = 1;
          $_SESSION["rangoNoPermitido"] = 0;

          if ($_SESSION["Usuario_perfil"] == "ADMINISTRADOR") {

            $_SESSION["usuarioRegistrado"] = 0;
            $_SESSION["idRegistrado"] = 0;
            $_SESSION["idBorrado"] = 0;
            $url = "login/administrador/";

            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $url);
            exit();
          } else {

            $url = "login/cliente/";
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $url);
            exit();
          }
        } else {

          $_SESSION["correo"] = $reg['Usuario_email'];

          $_SESSION["correo_valido"] = 0;
          $_SESSION["password_error"] = 1;
          $_SESSION["correoRegistrado"] = 0;
          $_SESSION["variableBandera"] = 0;

          $url = "./bloqueoUsuario.php";
          header("HTTP/1.1 301 Moved Permanently");
          header("Location: " . $url);
          exit();
        }
      }
    } else {

      $_SESSION["correo"] = $correo;
      $_SESSION["correo_valido"] = 1;
      $_SESSION["password_error"] = 0;
      $_SESSION["correoRegistrado"] = 0;
      $_SESSION["variableBandera"] = 0;
      $_SESSION["rangoNoPermitido"] = 0;
      $url = "./";
      header("HTTP/1.1 301 Moved Permanently");
      header("Location: " . $url);
      exit();

      
    }


    mysqli_close($conexion);
  }

  ?>


</body>

</html>