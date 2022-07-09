<?php
include "functions.php";
require "conexion.php";

$texto = $_POST['texto'];
$idpubli = $_POST['idpubli'];
$iduser = $_POST['iduser'];

$querycom = $mysqli->query("INSERT INTO comentario (user,id_publicacion,comentario,fecha) VALUES ('$iduser','$idpubli','$texto',now())");
if ($querycom) {
    header("Location: home.php");
}else{
    echo ("error");
}
?>

