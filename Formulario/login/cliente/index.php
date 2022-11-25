<?php
session_start();
if (!is_null($_SESSION["correo"])) {

  $correo = $_SESSION["correo"];
  $conexion = mysqli_connect("localhost", "root", "", "usuarios") or
    die("Problemas con la conexión");

  $consulta = mysqli_query($conexion, "select Usuario_email,Usuario_nombre,Usuario_apellido1,Usuario_apellido2,Usuario_domicilio,Usuario_poblacion,Usuario_provincia,Usuario_nif,Usuario_fotografia,Usuario_numero_telefono,Usuario_perfil
    from usuarios where Usuario_email='$correo'");

  if ($reg = mysqli_fetch_array($consulta)) {

    $_SESSION["Usuario_nombre"] = $reg['Usuario_nombre'];
    $_SESSION["Usuario_apellido1"] = $reg['Usuario_apellido1'];
    $_SESSION["Usuario_apellido2"] = $reg['Usuario_apellido2'];
    $_SESSION["Usuario_email"] = $reg['Usuario_email'];
    $_SESSION["Usuario_domicilio"] = $reg['Usuario_domicilio'];
    $_SESSION["Usuario_poblacion"] = $reg['Usuario_poblacion'];
    $_SESSION["Usuario_provincia"] = $reg['Usuario_provincia'];
    $_SESSION["Usuario_dni"] = $reg['Usuario_nif'];
    $_SESSION["Usuario_numeroTelefono"] = $reg['Usuario_numero_telefono'];
    $_SESSION["Usuario_fotografia"] = $reg['Usuario_fotografia'];
    $_SESSION["Usuario_perfil"] = $reg['Usuario_perfil'];
  } else {
    echo "No registro con este mail";
  }

?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <title>MI PAGINA DE DISEÑO DE INTERFACES</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../bootstrap-4.5.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../bootstrap-4.5.3-dist/js/bootstrap.min.js">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
      .fakeimg {
        height: 200px;
        width: 200px;
        background: #aaa;
      }
    </style>
  </head>

  <body style="background-color: #154c79; color: white; background-image: url(../../fondo3.png);">

  <nav class="navbar navbar-expand-sm navbar-dark" style="background-color: #610027; border-bottom: 2px solid black;">

<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
  <span class="navbar-toggler-icon"></span>
</button>

<?php

if ($_SESSION["Usuario_perfil"] == "ADMINISTRADOR") {
?>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <a id="inicio" class="navbar-brand" href="../administrador/"><img src="../../imagenes/inicio.png" alt="imagen" width="30px" height="40px">&nbsp;&nbsp;Inicio</a>



    <a class="btn" href="./agregar/" style="color: black;background-color: #fff888;"><img src="../../imagenes/agregar.png" alt="" width="30px" height="30px" r>&nbsp;&nbsp;Agregar Usuario</a>&nbsp;
    <a class="btn" href="./borrar/" style="color: black;background-color: #fff888;"><img src="../../imagenes/borrar.png" alt="" width="30px" height="30px" r>&nbsp;&nbsp;Borrar Usuario</a>&nbsp;
    <a class="btn" href="./buscar/" style="color: black;background-color: #fff888;"><img src="../../imagenes/buscar.png" alt="" width="30px" height="30px" r>&nbsp;&nbsp;Buscar Usuario</a>


  </div>


<?php
} else {
?>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <a class="navbar-brand" href="../cliente/"><img src="../../inicio.png" alt="imagen" width="20px" height="30px">&nbsp;&nbsp;Inicio</a>
  </div>
<?php
}
?>
<a class="btn" style="color: black;background-color: #fff888;" href="../modificarPerfil/buscarDetalles.php"><img src="../../imagenes/editar.png" alt="" width="30px" height="30px" r>&nbsp;&nbsp;Editar Perfil</a>&nbsp;
<a class="btn" style="color: black;background-color: #fff888;" href="../borrado.php"><img src="../../imagenes/salir.png" alt="" width="30px" height="30px" r>&nbsp;&nbsp;Login Out</a>


</nav>

    <div class="text-center" style="margin: 2em">
      <h1>Página principal del cliente: "<?php echo $_SESSION['Usuario_nombre'] ?> <?php echo $_SESSION["Usuario_apellido1"] ?> <?php echo $_SESSION["Usuario_apellido2"] ?>"</h1>
    </div>
    <br><br><br>

    <div class="text-center" style="border: 2px solid white; box-shadow: 0 0 40px 0 white, 0 0 5px 0 white;padding: 2em; color: black; background-color: #610027; border-radius: 30px; max-width: 500px; margin: auto">
      <br>

      <h2 style="color: white">Foto de perfil:</h2>

      <?php

      if (isset($_SESSION["Usuario_fotografia"])) {

      ?>
        <div class="fakeimg" style="background-color: #352f4f; border-radius: 50%; margin: auto ;margin-top: 3em;"><img style="border: 2px solid white; border-radius: 50%;" class="fakeimg" src="../modificarPerfil/imagenes/<?php echo $_SESSION['Usuario_fotografia'] ?>" /></div>
      <?php
      } else {
      ?>
        <div class="fakeimg"><img class="fakeimg" src="../modificarPerfil/imagenes/login.png" /></div>
      <?php
      }
      ?>
    </div>
    <div class="col-8">

      <div id="map"></div>

      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAaKdY_hkr3T1gjgR4weiIZrlJJ4a7kqr0&callback=initMap&v=weekly" async></script>

    </div>

  </body>

  </html>

<?php
} else {

  $url = "../../";
  header("HTTP/1.1 301 Moved Permanently");
  header("Location: " . $url);
  exit();
}
?>