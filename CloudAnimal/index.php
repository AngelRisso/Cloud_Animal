<?php
ob_start();
?>
<?php
session_start();
if (isset($_SESSION['logueado']) && $_SESSION['logueado'] == TRUE) {
  header("Location: home.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <title>Cloud Animal</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css" type="text/css">
  <link rel="shortcut icon" href="./images/icons/favicon.png" type="image/x-icon">
</head>

<body>


  <div class="con">
    <div class="centro">

      <?php
      if (isset($_GET['error'])) {
        echo "<center>Error el usuario o contraseña no coinciden</center>";
      }
      ?>

      <?php
      if (isset($_POST['entrar'])) {

        require("conexion.php");

        $username = $mysqli->real_escape_string($_POST['usuario']);
        $password = md5($_POST['password']);

        $consulta = "SELECT username,unique_id,password,id FROM users WHERE username = '$username' AND password = '$password'";

        if ($resultado = $mysqli->query($consulta)) {
          while ($row = $resultado->fetch_array()) {

            $userok = $row['username'];
            $passok = $row['password'];
            $id = $row['id'];
            $unicid = $row['unique_id'];
          }
          $resultado->close();
        }
        $mysqli->close();


        if (isset($username) && isset($password)) {

          if ($username == $userok && $password == $passok) {

            session_start();
            $_SESSION['logueado'] = TRUE;
            $_SESSION['username'] = $userok;
            $_SESSION['id'] = $id;
            $_SESSION['unique_id'] = $unicid;
            header("Location: home.php");
          } else {

            Header("Location: index.php?error=login");
          }
        }
      }
      ?>

      <div class="main-content">
        <div class="header">
          <?php //colocar logo?><center><h3>CloudAnimal</h3></center>
        </div>
        <div class="l-part">
          <form action="" method="post">
            <input type="text" placeholder="Usuario" class="input" name="usuario" autocomplete="off" />
            <div class="overlap-text">
              <input type="password" placeholder="Contraseña" class="input" name="password" />
              <a href="olvidocontrasena.php">Olvidaste?</a>
            </div>
            <input type="submit" value="Entrar" class="btn" name="entrar" />
          </form>
        </div>
      </div>

      <div class="sub-content">
        <div class="s-part">
          ¿No tienes una cuenta? <a href="registro.php">Regístrate</a>
        </div>
      </div>



    </div>
  </div>


</body>

</html>
<?php
ob_end_flush();
?>