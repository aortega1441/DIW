
<?php
session_start();
$target_dir = "imagenes/";
$target_file = $target_dir . basename($_FILES["fotografia"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$extension = end(explode(".", $target_file));

$nuevaUrl=$_SESSION["id"].".".$extension;

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fotografia"]["tmp_name"]);
  if($check !== false) {
    echo "El archivo es una imagen -" . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "El archivo no es una imagen";
    $uploadOk = 0;
  }
}

// Check file size
if ($_FILES["fotografia"]["size"] > 1024000000) {
  echo "Lo siento, tu archivo es demasiado grande";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Lo siento, solo JPG, JPEG, PNG & GIF son aceptados";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Lo siento, tu imagen no fue subida correctamente";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fotografia"]["tmp_name"], $target_dir.$nuevaUrl)) {
    echo "El archivo ". htmlspecialchars( basename( $_FILES["fotografia"]["name"])). " ha sido subido correctamente.";

    $conexion = mysqli_connect("localhost", "root", "", "usuarios") or
    die("Problemas con la conexión");

    mysqli_query($conexion, "update usuarios
                set Usuario_fotografia='$nuevaUrl'
                 where Usuario_email='".$_SESSION['correo']."'") or
                die("Problemas en el select:" . mysqli_error($conexion));

    
    $url = "./buscarDetalles.php";
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: ".$url);
    exit(); 

  } else {
    echo "Lo siento, ha ocurrido un error al subir la imagen.";
  }
}

?>
