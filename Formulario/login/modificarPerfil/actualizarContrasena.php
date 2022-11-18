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

    $nuevaContrasena=$_POST["nuevaContrasena"];
    $nuevaContrasenaRep=$_POST["nuevaContrasenaRep"];

    if ($nuevaContrasena!=$nuevaContrasenaRep) {
      echo "LAS CONTRASEÑAS SON DISTINTAS";
    }else{
    
    $contrasena= $_POST["contrasena"];
    
    $correo=$_SESSION["correo"];
    
    

    $conexion = mysqli_connect("localhost", "root", "", "usuarios") or
        die("Problemas con la conexión");

        $consulta = mysqli_query($conexion, "select Usuario_clave
        from usuarios where Usuario_email='$correo'") or
        die("Problemas en el select:" . mysqli_error($conexion));

        if ($reg = mysqli_fetch_array($consulta)) {
            
            $claveComprobar=$reg['Usuario_clave'];
            
        
            if (password_verify($contrasena,$claveComprobar)) {

                $contrasenaNueva= password_hash($_POST["nuevaContrasena"],PASSWORD_DEFAULT);
                $contrasenaNueva=trim($contrasenaNueva);
                
                mysqli_query($conexion, "update usuarios
                set Usuario_clave='$contrasenaNueva'
                 where Usuario_email='".$_SESSION['Usuario_email']."'") or
                die("Problemas en el select:" . mysqli_error($conexion));
       
              $url = "./";
              header("HTTP/1.1 301 Moved Permanently");
              header("Location: ".$url);
              exit(); 

            }
            
        $url = "./buscarDetalles.php";
      header("HTTP/1.1 301 Moved Permanently");
      header("Location: ".$url);
      exit(); 
      
    }else {
        echo "ERROR EN LA CONEXION";
    }
}
}
    ?>
</body>

</html>