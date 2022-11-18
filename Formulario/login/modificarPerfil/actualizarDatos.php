<?php
session_start();

?>

<html>

<head>
    <title>Problema</title>
</head>

<body>
    <?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    

    $conexion = mysqli_connect("localhost", "root", "", "usuarios") or
        die("Problemas con la conexión");

        

    mysqli_query($conexion, "update usuarios
                           set Usuario_email='".$_REQUEST['correo']."', Usuario_nombre='".$_REQUEST['nombre']."', Usuario_apellido1='".$_REQUEST['apellido1']."', Usuario_apellido2='".$_REQUEST['apellido2']."', Usuario_domicilio='".$_REQUEST['domicilio']."', Usuario_poblacion='".$_REQUEST['poblacion']."', Usuario_numero_telefono='".$_REQUEST['numeroTelefono']."', Usuario_nif='".$_REQUEST['dni']."',Usuario_provincia='".$_REQUEST['provincia']."'
                        where Usuario_email='".$_SESSION['Usuario_email']."'") or
        die("Problemas en el select:" . mysqli_error($conexion));

        $_SESSION["correo"]=$_REQUEST['correo'];
        $url = "./buscarDetalles.php";
      header("HTTP/1.1 301 Moved Permanently");
      header("Location: ".$url);
      exit(); 
    }else {
        echo "ERROR EN LA CONEXION";
    }
    ?>
</body>

</html>

