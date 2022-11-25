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
    <a id="inicio" class="navbar-brand" href="../administrador/"><img src="../../imagenes/inicio.png" alt="imagen" width="30px" height="40px">&nbsp;&nbsp;Inicio</a>



    <a class="btn" href="../administrador/agregar/" style="color: black;background-color: #fff888;"><img src="../../imagenes/agregar.png" alt="" width="30px" height="30px" r>&nbsp;&nbsp;Agregar Usuario</a>&nbsp;
    <a class="btn" href="../administrador/borrar/" style="color: black;background-color: #fff888;"><img src="../../imagenes/borrar.png" alt="" width="30px" height="30px" r>&nbsp;&nbsp;Borrar Usuario</a>&nbsp;
    <a class="btn" href="../administrador/buscar/" style="color: black;background-color: #fff888;"><img src="../../imagenes/buscar.png" alt="" width="30px" height="30px" r>&nbsp;&nbsp;Buscar Usuario</a>


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
      <select name="provincia" id="provincia" class="custom-select">
        <option value="Araba/Álava">Araba/Álava</option>
        <option value="Albacete">Albacete</option>
        <option value="Alicante/Alacant">Alicante/Alacant</option>
        <option value="Almería">Almería</option>
        <option value="Ávila">Ávila</option>
        <option value="Badajoz">Badajoz</option>
        <option value="Balears, Illes">Balears, Illes</option>
        <option value="Barcelona">Barcelona</option>
        <option value="Burgos">Burgos</option>
        <option value="Cáceres">Cáceres</option>
        <option value="Cádiz">Cádiz</option>
        <option value="Castellón/Castelló">Castellón/Castelló</option>
        <option value="Ciudad Real">Ciudad Real</option>
        <option value="Córdoba">Córdoba</option>
        <option value="Coruña, A">Coruña, A</option>
        <option value="Cuenca">Cuenca</option>
        <option value="Girona">Girona</option>
        <option value="Granada">Granada</option>
        <option value="Guadalajara">Guadalajara</option>
        <option value="Gipuzkoa">Gipuzkoa</option>
        <option value="Huelva">Huelva</option>
        <option value="Huesca">Huesca</option>
        <option value="Jaén">Jaén</option>
        <option value="León">León</option>
        <option value="Lleida">Lleida</option>
        <option value="Rioja, La">Rioja, La</option>
        <option value="Lugo">Lugo</option>
        <option value="Madrid">Madrid</option>
        <option value="Málaga">Málaga</option>
        <option value="Murcia">Murcia</option>
        <option value="Navarra">Navarra</option>
        <option value="Ourense">Ourense</option>
        <option value="Asturias">Asturias</option>
        <option value="Palencia">Palencia</option>
        <option value="Palmas, Las">Palmas, Las</option>
        <option value="Pontevedra">Pontevedra</option>
        <option value="Salamanca">Salamanca</option>
        <option value="Santa Cruz de Tenerife">Santa Cruz de Tenerife</option>
        <option value="Cantabria">Cantabria</option>
        <option value="Segovia">Segovia</option>
        <option value="Sevilla">Sevilla</option>
        <option value="Soria">Soria</option>
        <option value="Tarragona">Tarragona</option>
        <option value="Teruel">Teruel</option>
        <option value="Toledo">Toledo</option>
        <option value="Valencia/València">Valencia/València</option>
        <option value="Valladolid">Valladolid</option>
        <option value="Bizkaia">Bizkaia</option>
        <option value="Zamora">Zamora</option>
        <option value="Zaragoza">Zaragoza</option>
        <option value="Ceuta">Ceuta</option>
        <option value="Melilla">Melilla</option>
      </select><br>
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