<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $_SESSION['busquedaDni'] = $_POST['dni'];
  $_SESSION['busquedaProvincia'] = $_POST['provincia'];
  $_SESSION['busquedaEmail'] = $_POST['email'];
  $_SESSION["seleccion"] = $_POST["seleccion"];
}
echo $_SESSION['busquedaProvincia'];
$per_page_record = 4;

$conexion = mysqli_connect("localhost", "root", "", "usuarios") or
  die("Problemas con la conexion");

//AND Usuario_email LIKE '%" . $_SESSION['busquedaEmail'] . "%' AND Usuario_provincia LIKE '%" . $_SESSION['busquedaProvincia'] . "%'
if ($_SESSION["seleccion"] == "borrarUsuarios") {
  $consulta = mysqli_query($conexion, "SELECT * FROM usuarios WHERE Usuario_nif LIKE '%" . $_SESSION['busquedaDni'] . "%' OR Usuario_email LIKE '%" . $_SESSION['busquedaEmail'] . "%' OR Usuario_provincia LIKE '%" . $_SESSION['busquedaProvincia'] . "%'") or
    die("Problemas en el select:" . mysqli_error($conexion));
} else if ($_SESSION["seleccion"] == "desbloquear") {
  $consulta = mysqli_query($conexion, "SELECT * FROM usuarios WHERE Usuario_nif LIKE '%" . $_SESSION['busquedaDni'] . "%' OR Usuario_bloqueado= '1'  OR Usuario_email LIKE '%" . $_SESSION['busquedaEmail'] . "%' OR Usuario_provincia LIKE '%" . $_SESSION['busquedaProvincia'] . "%' ") or
    die("Problemas en el select:" . mysqli_error($conexion));
} else {
  $consulta = mysqli_query($conexion, "SELECT * FROM usuarios WHERE Usuario_nif LIKE '%" . $_SESSION['busquedaDni'] . "%'  OR Usuario_perfil= 'CLIENTE' OR Usuario_email LIKE '%" . $_SESSION['busquedaEmail'] . "%' OR Usuario_provincia LIKE '%" . $_SESSION['busquedaProvincia'] . "%' ") or
    die("Problemas en el select:" . mysqli_error($conexion));
}



$reg = mysqli_num_rows($consulta);

$total_pages = ceil($reg / $per_page_record);

if (!isset($_GET['page'])) {
  $page = 1;
} else {
  $page  = $_GET['page'];
}

// if (!isset($_SESSION["busquedaDni"])) {

//   $_SESSION["busquedaDni"]="";
//   $_SESSION["busquedaProvincia"]="";
//   $_SESSION["busquedaEmail"]="";

// }




$start_from = ($page - 1) * $per_page_record;

if ($_SESSION["seleccion"] == "borrarUsuarios") {
  $consulta = mysqli_query($conexion, "SELECT * FROM usuarios WHERE Usuario_nif LIKE '%" . $_SESSION['busquedaDni'] . "%' OR Usuario_email LIKE '%" . $_SESSION['busquedaEmail'] . "%' OR Usuario_provincia LIKE '%" . $_SESSION['busquedaProvincia'] . "%' LIMIT " . $start_from . ',' . $per_page_record) or
    die("Problemas en el select:" . mysqli_error($conexion));
} else if ($_SESSION["seleccion"] == "desbloquear") {
  $consulta = mysqli_query($conexion, "SELECT * FROM usuarios WHERE Usuario_nif LIKE '%" . $_SESSION['busquedaDni'] . "%' OR Usuario_bloqueado= '1'  OR Usuario_email LIKE '%" . $_SESSION['busquedaEmail'] . "%' OR Usuario_provincia LIKE '%" . $_SESSION['busquedaProvincia'] . "%' LIMIT " . $start_from . ',' . $per_page_record) or
    die("Problemas en el select:" . mysqli_error($conexion));
} else {
  $consulta = mysqli_query($conexion, "SELECT * FROM usuarios WHERE Usuario_nif LIKE '%" . $_SESSION['busquedaDni'] . "%' OR Usuario_perfil= 'CLIENTE'  OR Usuario_email LIKE '%" . $_SESSION['busquedaEmail'] . "%' OR Usuario_provincia LIKE '%" . $_SESSION['busquedaProvincia'] . "%'  LIMIT " . $start_from . ',' . $per_page_record) or
    die("Problemas en el select:" . mysqli_error($conexion));
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../estilosEditar.css">
  <link rel="stylesheet" href="../../../../bootstrap-4.5.3-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../bootstrap-4.5.3-dist/js/bootstrap.min.js">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <title>TABLA DE BUSQUEDA</title>
  <style>
    tr {
      text-align: center;
    }

    td {
      text-align: center;
    }

    #pasador {
      width: 100%;
      text-align: center;
      margin: 0 auto;
    }
  </style>

</head>

<body id="bodytabla" style="color: white;">


<nav class="navbar navbar-expand-sm navbar-dark" style="background-color: #610027; border-bottom: 2px solid black;">

<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
  <span class="navbar-toggler-icon"></span>
</button>

<?php

if ($_SESSION["Usuario_perfil"] == "ADMINISTRADOR") {
?>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <a class="navbar-brand" href="../../../administrador/"><img src="../../../../imagenes/inicio.png" alt="imagen" width="30px" height="40px">&nbsp;&nbsp;Inicio</a>

    <a class="btn" href="../../agregar/" style="color: black;background-color: #fff888;"><img src="../../../../imagenes/agregar.png" alt="" width="30px" height="30px" r>&nbsp;&nbsp;Agregar Usuario</a>&nbsp;
    <a class="btn" href="../../borrar/" style="color: black;background-color: #fff888;"><img src="../../../../imagenes/borrar.png" alt="" width="30px" height="30px" r>&nbsp;&nbsp;Borrar Usuario</a>&nbsp;
    <a class="btn" href="../../buscar/" style="color: black;background-color: #fff888;"><img src="../../../../imagenes/buscar.png" alt="" width="30px" height="30px" r>&nbsp;&nbsp;Buscar Usuario</a>
  </div>
<?php
} else {
?>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <a class="navbar-brand" href="../../../cliente/"><img src="../../../../imagenes/inicio.png" alt="imagen" width="30px" height="40px">&nbsp;&nbsp;Inicio</a>
  </div>
<?php
}

?>

<a class="btn" style="color: black;background-color: #fff888;" href="../../../modificarPerfil/buscarDetalles.php"><img src="../../../../imagenes/editar.png" alt="" width="30px" height="30px" r>&nbsp;&nbsp;Editar Perfil</a>&nbsp;
<a class="btn" style="color: black;background-color: #fff888;" href="../../../borrado.php"><img src="../../../../imagenes/salir.png" alt="" width="30px" height="30px" r>&nbsp;&nbsp;Login Out</a>
</div>
</nav>

  <div class="jumbotron text-center" style="color: white; background: transparent;">
    <h1>TABLA DE USUARIOS</h1>
  </div>

  <?php

  if ($_SESSION["seleccion"] == "borrarUsuarios") {


  ?>

    <form action="./borrado.php" method="POST">

      <table class="table table-bordered">
        <thead style="background-color: #fff888;">
          <tr>
            <th>Marcar</th>
            <th>Id</th>
            <th>Nombre</th>
            <th>Primer Apellido</th>
            <th>Segundo Apellido</th>
            <th>Fecha de alta</th>
            <th>Usuario_email</th>
            <th>Usuario_domicilio</th>
            <th>Provincia</th>
            <th>Usuario_nif</th>
            <th>Usuario_numero_telefono</th>
            <th>Usuario_fecha_nacimiento</th>
            <th>Usuario_perfil</th>
            <th>Bloqueo</th>

            <th>??ltima conexi??n</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while ($reg = mysqli_fetch_array($consulta)) {
            echo "<tr class='lineas' style='color: white;'>";
            echo "<td><input type='checkbox' name='seleccion[]' value='" . $reg['Usuario_id'] . "'></input></td>";
            echo "<td>" . $reg['Usuario_id'] . "</td>";
            echo "<td>" . $reg['Usuario_nombre'] . "</td>";
            echo "<td>" . $reg['Usuario_apellido1'] . "</td>";
            echo "<td>" . $reg['Usuario_apellido2'] . "</td>";
            echo "<td>" . $reg['Usuario_fecha_alta'] . "</td>";
            echo "<td>" . $reg['Usuario_email'] . "</td>";
            echo "<td>" . $reg['Usuario_domicilio'] . "</td>";
            echo "<td>" . $reg['Usuario_provincia'] . "</td>";
            echo "<td>" . $reg['Usuario_nif'] . "</td>";
            echo "<td>" . $reg['Usuario_numero_telefono'] . "</td>";
            echo "<td>" . $reg['Usuario_fecha_nacimiento'] . "</td>";
            echo "<td>" . $reg['Usuario_perfil'] . "</td>";
            if ($reg['Usuario_bloqueado'] == 0) {
              echo "<td style='background-color: lightgreen; color: black '>Desbloqueado</td>";
            } else {
              echo "<td style='background-color: crimson;'>Bloqueado</td>";
            }

            echo "<td>" . $reg['Usuario_fecha_ultima_conexion'] . "</td>";
            echo "</tr>";
          }
          ?>
        </tbody>



      </table>

    <?php
  } else if ($_SESSION["seleccion"] == "desbloquear") {

    ?>

      <form action="./desbloquear.php" method="POST">

        <table class="table table-bordered">
          <thead style="background-color: #fff888;">
            <tr>
              <th>Marcar</th>
              <th>Id</th>
              <th>Nombre</th>
              <th>Primer Apellido</th>
              <th>Segundo Apellido</th>
              <th>Fecha de alta</th>
              <th>Usuario_email</th>
              <th>Usuario_domicilio</th>
              <th>Provincia</th>
              <th>Usuario_nif</th>
              <th>Usuario_numero_telefono</th>
              <th>Usuario_fecha_nacimiento</th>
              <th>Usuario_perfil</th>
              <th>Bloqueo</th>

              <th>??ltima conexi??n</th>
            </tr>
          </thead>
          <tbody>
            <?php
            while ($reg = mysqli_fetch_array($consulta)) {
              echo "<tr class='lineas' style='color: white;'>";
              echo "<td><input type='checkbox' name='seleccion[]' value='" . $reg['Usuario_id'] . "'></input></td>";
              echo "<td>" . $reg['Usuario_id'] . "</td>";
              echo "<td>" . $reg['Usuario_nombre'] . "</td>";
              echo "<td>" . $reg['Usuario_apellido1'] . "</td>";
              echo "<td>" . $reg['Usuario_apellido2'] . "</td>";
              echo "<td>" . $reg['Usuario_fecha_alta'] . "</td>";
              echo "<td>" . $reg['Usuario_email'] . "</td>";
              echo "<td>" . $reg['Usuario_domicilio'] . "</td>";
              echo "<td>" . $reg['Usuario_provincia'] . "</td>";
              echo "<td>" . $reg['Usuario_nif'] . "</td>";
              echo "<td>" . $reg['Usuario_numero_telefono'] . "</td>";
              echo "<td>" . $reg['Usuario_fecha_nacimiento'] . "</td>";
              echo "<td>" . $reg['Usuario_perfil'] . "</td>";
              if ($reg['Usuario_bloqueado'] == 0) {
                echo "<td style='background-color: lightgreen; color: black '>Desbloqueado</td>";
              } else {
                echo "<td style='background-color: crimson;'>Bloqueado</td>";
              }

              echo "<td>" . $reg['Usuario_fecha_ultima_conexion'] . "</td>";
              echo "</tr>";
            }
            ?>
          </tbody>



        </table>

      <?php
    } else if ($_SESSION["seleccion"] == "editarUsuarios") {

      ?>

        <form action="./editar.php" method="POST">

          <table class="table table-bordered">
            <thead style="background-color: #fff888;">
              <tr>
                <th>Marcar</th>
                <th>Id</th>
                <th>Nombre</th>
                <th>Primer Apellido</th>
                <th>Segundo Apellido</th>
                <th>Fecha de alta</th>
                <th>Usuario_email</th>
                <th>Usuario_domicilio</th>
                <th>Provincia</th>
                <th>Usuario_nif</th>
                <th>Usuario_numero_telefono</th>
                <th>Usuario_fecha_nacimiento</th>
                <th>Usuario_perfil</th>
                <th>Bloqueo</th>

                <th>??ltima conexi??n</th>
              </tr>
            </thead>
            <tbody>
              <?php
              while ($reg = mysqli_fetch_array($consulta)) {
                echo "<tr class='lineas' style='color: white;'>";
                echo "<td><input type='checkbox' name='seleccion[]' value='" . $reg['Usuario_id'] . "'></input></td>";
                echo "<td>" . $reg['Usuario_id'] . "</td>";
                echo "<td>" . $reg['Usuario_nombre'] . "</td>";
                echo "<td>" . $reg['Usuario_apellido1'] . "</td>";
                echo "<td>" . $reg['Usuario_apellido2'] . "</td>";
                echo "<td>" . $reg['Usuario_fecha_alta'] . "</td>";
                echo "<td>" . $reg['Usuario_email'] . "</td>";
                echo "<td>" . $reg['Usuario_domicilio'] . "</td>";
                echo "<td>" . $reg['Usuario_provincia'] . "</td>";
                echo "<td>" . $reg['Usuario_nif'] . "</td>";
                echo "<td>" . $reg['Usuario_numero_telefono'] . "</td>";
                echo "<td>" . $reg['Usuario_fecha_nacimiento'] . "</td>";
                echo "<td>" . $reg['Usuario_perfil'] . "</td>";
                if ($reg['Usuario_bloqueado'] == 0) {
                  echo "<td style='background-color: lightgreen; color: black '>Desbloqueado</td>";
                } else {
                  echo "<td style='background-color: crimson;'>Bloqueado</td>";
                }
                echo "<td>" . $reg['Usuario_fecha_ultima_conexion'] . "</td>";
                echo "</tr>";
              }
              ?>
            </tbody>



          </table>

        <?php
      }
        ?>

        <nav aria-label="...">
          <ul class="pagination justify-content-center">
            <li class="page-item">
              <a class="btn btn-success" href="./?page=1" tabindex="-1">Anterior</a>
            </li>&nbsp;

            <?php
            for ($page = 1; $page <= $total_pages; $page++) {
              echo "<li class='page-item'><a class='btn btn-success' href='./?page=" . $page . "'>" . $page . "</a></li>";
            }
            ?>
            &nbsp;
            <li class="page-item">
              <a class="btn btn-success" href="./?page=<?php echo $total_pages ?>">??ltimo</a>
            </li>

          </ul>



          <div style="margin-left: 1%;">

            <?php

            if ($_SESSION["seleccion"] == "borrarUsuarios") {

            ?>

              <input class="btn btn-danger" type="submit" value="Borrar Registros" />

            <?php
            } else if ($_SESSION["seleccion"] == "desbloquear") {

            ?>
              <input class="btn btn-danger" type="submit" value="Desbloquear Usuarios" />
            <?php
            } else if ($_SESSION["seleccion"] == "editarUsuarios") {
            ?>
              <input class="btn btn-danger" type="submit" value="Editar Usuarios" />
            <?php
            }
            ?>

          </div>

        </nav>

        </form>

        </div>
</body>

</html>