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

$id = "";
$idErr = "";

$detectarError=0;
$contrasenaNoValida=0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty($_POST["id"])) {
    $idErr = "ID es requerido";
    $detectarError=1;
  } else {
    $id = test_input($_POST["id"]);
   
  }

}

  function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($detectarError==1) {

  echo $idErr;
 
}else {
  
  
  $conexion = mysqli_connect("localhost", "root", "", "usuarios") or
    die("Problemas con la conexion");

  $consulta = mysqli_query($conexion, "select Usuario_id
                        from usuarios where Usuario_id='$id'") or
    die("Problemas en el select:" . mysqli_error($conexion));

  if ($reg = mysqli_fetch_array($consulta)) {

    mysqli_query($conexion, "delete from `usuarios` WHERE Usuario_id='$id'" )
    or die("Problemas en el select " . mysqli_error($conexion));

    mysqli_close($conexion);

    $_SESSION["idRegistrado"]=0;
    $_SESSION["idBorrado"]=1;
    $url = "./";
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: ".$url);

  }else {
    
    $_SESSION["idRegistrado"]=1;
    $url = "./";
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: ".$url);
    exit(); 

}
  
  }

  ?>

 
</body>
</html>