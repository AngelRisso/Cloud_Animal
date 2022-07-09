<?php
session_start();
if (!isset($_SESSION['logueado']) && $_SESSION['logueado'] == FALSE) {
    header("Location: index.php");
}

include "functions.php";
require 'conexion.php';
include "header.php";
?><h1 class="hl-top">Perfiles</h1><?php
$sqlp = "SELECT * FROM users";
$result = mysqli_query($mysqli, $sqlp);
while ($rowA = mysqli_fetch_array($result)) {
?>
    <!DOCTYPE html>
    <html lang="es">
    <title>Cloud Animal</title>
        <meta charset="UTF-8">
        <meta name="title" content="Cloud Animal">
        <meta name="description" content="Cloud Animal">
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <link href="css/instagram.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="./images/icons/favicon.png" type="image/x-icon">
        <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
    <head>
        
        
        <table>
            
            <div class="hl-top">
                <div class="hl-profile">
                    <div class="hl-pic"><a href="perfil.php?username=<?php echo $rowA['username']; ?>"><img src="images/<?php echo $rowA['avatar']; ?>" width="50" height="50"></a></div>
                </div>
                <div class="hl-username">
                    <div class="hl-name"><a href="perfil.php?username=<?php echo $rowA['username']; ?>"><?php echo $rowA['username']; ?></a></div>
                    <div class="hl-location"></div>
                </div>
            <?php } ?>
        </table>
    </head>