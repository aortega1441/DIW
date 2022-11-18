<?php
session_start();

$correo=$_SESSION["correo"];


?>

<html>

<head>
  <title>buscar detalles</title>
</head>

<body>
  <?php
  $conexion = mysqli_connect("localhost", "root", "", "usuarios") or
    die("Problemas con la conexión");

$consulta = mysqli_query($conexion, "select Usuario_email,Usuario_nombre,Usuario_apellido1,Usuario_apellido2,Usuario_domicilio,Usuario_poblacion,Usuario_provincia,Usuario_nif,Usuario_fotografia,Usuario_numero_telefono,Usuario_perfil
    from usuarios where Usuario_email='$correo'") or
die("Problemas en el select:" . mysqli_error($conexion));

  if ($reg = mysqli_fetch_array($consulta)) {
    
    $_SESSION["Usuario_nombre"]=$reg['Usuario_nombre'];
    $_SESSION["Usuario_apellido1"]=$reg['Usuario_apellido1'];
    $_SESSION["Usuario_apellido2"]=$reg['Usuario_apellido2'];
    $_SESSION["Usuario_email"]=$reg['Usuario_email'];
    $_SESSION["Usuario_domicilio"]=$reg['Usuario_domicilio'];
    $_SESSION["Usuario_poblacion"]=$reg['Usuario_poblacion'];
    $_SESSION["Usuario_provincia"]=$reg['Usuario_provincia'];
    $_SESSION["Usuario_dni"]=$reg['Usuario_nif'];
    $_SESSION["Usuario_numeroTelefono"]=$reg['Usuario_numero_telefono'];
    $_SESSION["Usuario_fotografia"]=$reg['Usuario_fotografia'];
    $_SESSION["Usuario_perfil"]=$reg['Usuario_perfil'];
    
    $url = "./";
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: ".$url);
    exit(); 

    
  } else {
    echo "No registro con este mail";
  }
  mysqli_close($conexion);
  ?>
</body>

</html>