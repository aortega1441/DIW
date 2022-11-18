<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="estilosEditar.css">
  <link rel="stylesheet" href="../../bootstrap-4.5.3-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../bootstrap-4.5.3-dist/js/bootstrap.min.js">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <title>EDITAR PERFIL</title>
  <script>
    function comprobarClave() {
      let comprobado = true;
      clave1 = document.formuContrasena.nuevaContrasena.value;
      clave2 = document.formuContrasena.nuevaContrasenaRep.value;

      if (clave1 != clave2) {
        document.getElementById("error").classList.add("mostrar");
        comprobado = false;

      }

      return comprobado;
    }
  </script>
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
        <a class="navbar-brand" href="../administrador/">Inicio</a>
        <div class="dropdown">
          <button type="button" class="btn btn-primary dropdown-toggle" style="color: black;background-color: #fff888;" data-toggle="dropdown">
            Opciones de Administrador
          </button>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="../administrador/agregar/index.php">Agregar Usuario</a>
            <a class="dropdown-item" href="../administrador/borrar/index.php">Borrar Usuario</a>
            <a class="dropdown-item" href="../administrador/buscar/index.php">Buscar Usuario</a>
          </div>
        </div>
      </div>


    <?php
    } else {
    ?>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <a class="navbar-brand" href="../cliente/">Inicio</a>
      </div>
    <?php
    }
    ?>

    <div id="login" class="dropdown">
      <button type="button" class="btn btn-primary dropdown-toggle" style="color: black;background-color: #fff888;" data-toggle="dropdown">
        <?php echo $_SESSION["correo"] ?>
      </button>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="./buscarDetalles.php">Editar Perfil</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="../borrado.php">Login Out</a>
      </div>
    </div>
    </div>
  </nav>

  <div class="text-center" style="margin: 2em">

  </div>

  <div class="container" style="width: 50%; margin-bottom: 3em;">

    <?php

    if (is_null($_SESSION["Usuario_fotografia"])) {
    ?>
      <div class="img-user imgRedonda" style="box-shadow: 0 0 30px 0 white, 0 0 5px 0 white;margin-bottom: 1em;">
        <img class="imgRedonda" src="imagenes/login.png">
      </div>

      <form action="actualizarFotografia.php" method="POST" enctype="multipart/form-data" style="width: 500px; margin: auto;">
        <label for="fotografia" class="form-label">Fotografia</label>
        <div id="divIMG"><input id="subidaArchivo" type="file" class="form-control alert" name="fotografia" /><img id="imagen" src="add.png" alt="" width="40px" height="40px"></div>
        <input class="btn btn-success text-align" style=" display: block; margin: auto;margin-top: 15px;" type="submit" value="Subir Imagen">
      </form>
    <?php
    } else {
    ?>
      <div class="img-user imgRedonda" style="box-shadow: 0 0 30px 0 white, 0 0 5px 0 white;margin-bottom: 1em;">
        <img class="imgRedonda" src="./imagenes/<?php echo $_SESSION['Usuario_fotografia'] ?>">
      </div>
      <form action="actualizarFotografia.php" method="POST" enctype="multipart/form-data" style="width: 500px; margin: auto;">
        <label for="fotografia" class="form-label"></label>
        <div id="divIMG"><input id="subidaArchivo" type="file" class="form-control alert" name="fotografia" /><img id="imagen" src="add.png" alt="" width="40px" height="40px"></div>
        <input class="btn btn-success text-align" style="margin-left: 9.5em;margin-top: 15px;" type="submit" value="Subir Imagen">
      </form>
    <?php
    }
    ?>
    <form action="actualizarDatos.php" method="POST" style="width: 500px; margin: auto;">
      <label for="nombre" class="form-label">Nombre</label>
      <input name="nombre" type="text" class="form-control" value="<?php echo $_SESSION['Usuario_nombre'] ?>"></input>
      <label for="apellido1" class="form-label">Primer apellido</label>
      <input name="apellido1" type="text" class="form-control" value="<?php echo $_SESSION['Usuario_apellido1'] ?>"></input>
      <label for="apellido2" class="form-label">Segundo apellido</label>
      <input name="apellido2" type="text" class="form-control" value="<?php echo $_SESSION['Usuario_apellido2'] ?>"></input>
      <label for="correo" class="form-label">E-mail</label>
      <input name="correo" type="email" class="form-control" value="<?php echo $_SESSION['Usuario_email'] ?>"></input>
      <label for="domicilio" class="form-label">Dirección</label>
      <input name="domicilio" type="text" class="form-control" value="<?php echo $_SESSION['Usuario_domicilio'] ?>"></input>
      <label for="poblacion" class="form-label">Localidad</label>
      <input name="poblacion" type="text" class="form-control" value="<?php echo $_SESSION['Usuario_poblacion'] ?>"></input>
      <label for="provincia" class="form-label">Provincia</label>
      <input name="provincia" type="text" class="form-control" value="<?php echo $_SESSION['Usuario_provincia'] ?>"></input>
      <label for="dni" class="form-label">DNI</label>
      <input name="dni" type="text" class="form-control" value="<?php echo $_SESSION['Usuario_dni'] ?>"></input>
      <label for="numeroTelefono" class="form-label">Número de Teléfono</label>
      <input name="numeroTelefono" type="number" class="form-control" value="<?php echo $_SESSION['Usuario_numeroTelefono'] ?>"></input>
      <input class="btn btn-success" style=" display: block; margin: auto;margin-top: 15px;" type="submit" value="Guardar Datos">
    </form>
    <hr>
    <h2 style="width: 500px; margin: auto; margin-bottom: 1em;">Cambiar Contraseña</h2>
    <form name="formuContrasena" action="actualizarContrasena.php" onsubmit="return comprobarClave()" method="POST" style="width: 500px; margin: auto;">
      <label for="contrasena" class="form-label">Contraseña actual</label>
      <input type="password" class="form-control" name="contrasena" />
      <label for="nuevaContrasena" class="form-label">Nueva contraseña</label>
      <input type="password" class="form-control" name="nuevaContrasena" />
      <label for="nuevaContrasenaRep" class="form-label">Repetir contrasena</label>
      <input type="password" class="form-control" name="nuevaContrasenaRep" />
      <input class="btn btn-success" style=" display: block; margin: auto;margin-top: 15px;" type="submit" value="Cambiar Contraseña">
    </form>
    <hr>




  </div>

</body>

</html>