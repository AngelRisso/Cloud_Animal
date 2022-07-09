<?php
ob_start();
session_start();
if (!isset($_SESSION['logueado']) && $_SESSION['logueado'] == FALSE) {
  header("Location: index.php");
}
error_reporting(0);
include "functions.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <title>Cloud Animal</title>
  <meta charset="UTF-8">
  <meta name="title" content="Cloud Animal">
  <meta name="description" content="Cloud Animal">
  <link href="css/style.css" rel="stylesheet" type="text/css" />
  <link href="css/instagram.css" rel="stylesheet" type="text/css" />
  <link rel="shortcut icon" href="./images/icons/favicon.png" type="image/x-icon">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

  <script type="text/javascript">
    $(window).load(function() {
      $(function() {
        $('#file-input').change(function(e) {
          addImage(e);
        });

        function addImage(e) {
          var file = e.target.files[0],
            imageType = /image.*/;

          if (!file.type.match(imageType))
            return;

          var reader = new FileReader();
          reader.onload = fileOnload;
          reader.readAsDataURL(file);
        }

        function fileOnload(e) {
          var result = e.target.result;
          $('#imgSalida').attr("src", result);
        }
      });
    });
  </script>

  <script>
    function capturar() {
      var resultado = "";

      var porNombre = document.getElementsByName("filter");
      for (var i = 0; i < porNombre.length; i++) {
        if (porNombre[i].checked)
          resultado = porNombre[i].value;
      }

      var elemento = document.getElementById("resultado");
      if (elemento.className == "") {
        elemento.className = resultado;
        elemento.width = "600";
      } else {
        elemento.className = resultado;
        elemento.width = "600";
      }
    }
  </script>
</head>

<?php include "header.php"; ?>

<form action="#" method="post" enctype="multipart/form-data">

  <div class="hl-icon" style="margin-left: 49%;">
    <div class="image-upload">
      <label for="file-input">
        <img src="images/icons/mas.png" width="50" title="Sube una foto ó video">
      </label>
      <input id="file-input" type="file" name="file-input" hidden="" />
    </div>
  </div>

  <body onload="capturar()">

    <div style="float: left; margin-left: 3%;">
      <div class="imgcheck">
        <label>
          <input type="radio" name="filter" value="" onclick="capturar()">
          <img src="images/filtro.jpg" class="" width="150">
        </label>
      </div>
      <div class="imgcheck">
        <label>
          <input type="radio" name="filter" value="reyes" onclick="capturar()">
          <img src="images/filtro.jpg" class="reyes" width="150">
        </label>
      </div>
      <div class="imgcheck">
        <label>
          <input type="radio" name="filter" value="sierra" onclick="capturar()">
          <img src="images/filtro.jpg" class="sierra" width="150">
        </label>
      </div>
      <div class="imgcheck">
        <label>
          <input type="radio" name="filter" value="gingham" onclick="capturar()">
          <img src="images/filtro.jpg" class="gingham" width="150">
        </label>
      </div>
      <div class="imgcheck">
        <label>
          <input type="radio" name="filter" value="stinson" onclick="capturar()">
          <img src="images/filtro.jpg" class="stinson" width="150">
        </label>
      </div>
      <div class="imgcheck">
        <label>
          <input type="radio" name="filter" value="maven" onclick="capturar()">
          <img src="images/filtro.jpg" class="maven" width="150">
        </label>
      </div>
      <div class="imgcheck">
        <label>
          <input type="radio" name="filter" value="kelvin" onclick="capturar()">
          <img src="images/filtro.jpg" class="kelvin" width="150">
        </label>
      </div>
      <div class="imgcheck">
        <label>
          <input type="radio" name="filter" value="Lo-Fi" onclick="capturar()">
          <img src="images/filtro.jpg" class="Lo-Fi" width="150">
        </label>
      </div>
      <div class="imgcheck">
        <label>
          <input type="radio" name="filter" value="moon" onclick="capturar()">
          <img src="images/filtro.jpg" class="moon" width="150">
        </label>
      </div>
    </div>


    <div style="float: left; clear: both; width: 600px; margin-left: 30%;">
      <div id="resultado" class=""><input type="file" name="img" id="imgSalida" width="600" /></div>
    </div>

    <div style="float: left; clear: both; margin-top: 30px; margin-bottom: 30px; margin-left: 24%;">
      <textarea rows="6" cols="100%" name="descripcion" placeholder="Descripción de tu publicación"></textarea>
    </div>

    <div style="float: left; clear: both; margin-left: 45%;">
      <input name="btncom" type="submit" class="myButton" value="Compartir">
    </div>
    <a href="home.php">volver</a>

</form>

<?php


if (isset($_POST['btncom'])) {

  require "conexion.php";

  $imagen = $_FILES['img']['tmp_name'];
  $imagen_tipo = exif_imagetype($_FILES['img']['tmp_name']);

  if ($imagen_tipo == IMAGETYPE_PNG or $imagen_tipo == IMAGETYPE_JPEG or $imagen_tipo == IMAGETYPE_BMP) {

    $filtro = $mysqli->real_escape_string($_POST['filter']);
    $Imagen = addslashes(file_get_contents($_FILES['img']['tmp_name']));
    $descripcion = $mysqli->real_escape_string($_POST['descripcion']);

    $next_id = $data['Auto_increment'];

    if ($_FILES['img']['tmp_name']) {

      $queryp = $mysqli->query("INSERT INTO publicaciones (user,descripcion,fecha) VALUES ('" . $_SESSION['id'] . "',
          '" . $descripcion . "',now())");

      $ultpub = $mysqli->query("SELECT id FROM publicaciones WHERE user = '" . $_SESSION['id'] . "' ORDER BY id DESC LIMIT 1");
      $ultp = $ultpub->fetch_array();

      $query = "INSERT INTO archivos (user,imagen,publicacion,filtro,fecha) VALUES ('" . $_SESSION['id'] . "','" . $Imagen . "','" . $ultp['id'] . "','" . $filtro . "',now())";

      $mysqli->query($query);
      if ($query) {

        header("refresh: 0; url = home.php");
      }
    }
  } else {
    echo "<script type='text/javascript'>alert('Solo puedes subir imágenes');</script>";
  }
}
?>
</body>

</html>