<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTRO DE CLIENTES</title>
    <link href="estilos.css" rel="stylesheet">
</head>
<body>

<?php

$correo = $fecha_nacimiento = $contrasena = $contrasenaRep = $contrasenaRepHash = $contrasenaHash = "";
$correoErr = $fechaNacimientoErr = $contrasenaErr = $contrasenaRepErr = "";

$detectarError=0;
$contrasenaNoValida=0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty($_POST["correo"])) {
    $correoErr = "Correo es requerido";
    $detectarError=1;
  } else {
    $correo = test_input($_POST["correo"]);
   
  }

  if (empty($_POST["fechaNacimiento"])) {
    $fechaNacimientoErr = "Fecha de Nacimiento es requerido";
    $detectarError=1;
  } else {
    $fecha_nacimiento = test_input($_POST["fechaNacimiento"]);
  }

  if (empty($_POST["contrasena"])) {
    $contrasenaErr = "Contraseña es requerida";
    $detectarError=1;
  } else {
    $contrasena = test_input($_POST["contrasena"]);
    $contrasenaHash = password_hash($contrasena,PASSWORD_DEFAULT);
  }

  if (empty($_POST["contrasenaRep"])) {
    $contrasenaRepErr = "Contraseña es requerida";
    $detectarError=1;
  } else {

    $contrasenaRep = test_input($_POST["contrasenaRep"]);
    $contrasenaRepHash = password_hash($contrasenaRep,PASSWORD_DEFAULT);
    
  }

  
  if ($contrasena!=$contrasenaRep) {
    $detectarError=1;
    $contrasenaNoValida=1;
  }
  
 
}

  function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($detectarError==1) {

  if ($detectarError==1 && $contrasenaNoValida==0) {
  echo $correoErr;
  echo $fechaNacimientoErr;
  echo $contrasenaErr;
  echo $contrasenaRepErr;

  }else if ($detectarError==1 && $contrasenaNoValida==1) {
    echo "Las contraseñas no son iguales, por favor intentalo de nuevo";
  }

 

}else {
  
  
  $conexion = mysqli_connect("localhost", "root", "", "usuarios") or
    die("Problemas con la conexion");

  $consulta = mysqli_query($conexion, "select Usuario_email
                        from usuarios where Usuario_email='$correo'") or
    die("Problemas en el select:" . mysqli_error($conexion));

  if ($reg = mysqli_fetch_array($consulta)) {
    $_SESSION["correoRegistrado"]=1;
    $_SESSION["correo"]=$correo;
    $_SESSION["fecha_nacimiento"]=$fecha_nacimiento;
    $_SESSION["correo_valido"]=0;
    $_SESSION["password_error"]=0;
    $_SESSION["registrado"]=0;
    $url = "../";
      header("HTTP/1.1 301 Moved Permanently");
      header("Location: ".$url);
      exit(); 
 
  }else {
    
    mysqli_query($conexion, "insert into usuarios(Usuario_email,Usuario_clave,Usuario_perfil) values 
                       ('$correo','$contrasenaHash','CLIENTE')")
    or die("Problemas en el select " . mysqli_error($conexion));

  mysqli_close($conexion);
  
   $to      = $correo;
   $subject = "Correo de Bienvenida";
   $message = "Bienvenido a la primera pagina de diseño de interfaces de Jose Antonio Marquez, va a ser usted hackeado hasta las trancas";

   mail($to,$subject,$message);
    $_SESSION["correoRegistrado"]=0;
      $url = "../";
      header("HTTP/1.1 301 Moved Permanently");
      header("Location: ".$url);

}
  
  }

  ?>

 
</body>
</html>