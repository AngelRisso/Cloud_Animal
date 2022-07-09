<?php
ob_start();
session_start();
if (!isset($_SESSION['logueado']) && $_SESSION['logueado'] == FALSE) {
    header("Location: index.php");
}
error_reporting(0);

include "functions.php";
require "conexion.php";
 include "header.php"; 
$consultaA = "SELECT confirmed FROM users WHERE username = '" . $_SESSION['username'] . "'";
$resultadoA = $mysqli->query($consultaA);
$row = $resultadoA->fetch_array();

if ($row['confirmed'] == 0) {
    echo "<div class='topbarc'><a href='codigo.php'>Confirma tu email aquí </a></div>";
}



$idpublicacion = $_POST['idcom']
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet" type="text/css" />
	<link href="css/instagram.css" rel="stylesheet" type="text/css" />
	<link rel="shortcut icon" href="./images/icons/favicon.png" type="image/x-icon">
    <title>comentario</title>
</head>
<a href="home.php">volver</a>
<body>
    <div class="zn-visualizacion">
    <?php
    $sqlA = $mysqli->query("SELECT * FROM comentario where id_publicacion = '$idpublicacion' ORDER BY id ");
			while ($rowA = $sqlA->fetch_array()) {
                $sqlB = $mysqli->query("SELECT username FROM users WHERE id = '" . $rowA['user'] . "'");
				$rowB = $sqlB->fetch_array();
            ?>
            <div>
            <strong style="color: #262626;"><?php echo $rowB['username']; ?> :<?php echo $rowA['comentario']; ?></strong>
            </div>
            <?php    
            }
    ?>
    </div>
    <div class="zn-comentario">
            <form action="insertar_comentario.php" method="POST">
                <textarea name="texto" rows="10" cols="50"> </textarea>
                <input type="text" hidden name="idpubli" value="<?php echo $idpublicacion?>">
                <input type="text" hidden name="iduser" value="<?php echo $_SESSION['id'] ?>">
                <input type="submit" name="insertar" value="comentar">
            </form>
    </div>
</body>
</html>








