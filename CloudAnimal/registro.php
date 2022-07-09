<?php
ob_start();
?>
<?php
session_start();
if(isset($_SESSION['logueado']) && $_SESSION['logueado'] == TRUE) {
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

<div id="wrapper">

  <?php
  if(isset($_POST['registro'])) {

    require("conexion.php");

    $email = $mysqli->real_escape_string($_POST['mail']);
    $nombre = $mysqli->real_escape_string($_POST['nombre']);
    $usuario = $mysqli->real_escape_string($_POST['usuario']);
    $password = md5($_POST['password']);
    $ip = $_SERVER['REMOTE_ADDR'];
    
    $consultausuario = "SELECT username FROM users WHERE username = '$usuario'";
    $consultaemail = "SELECT email FROM users WHERE email = '$email'";
    if($resultadousuario = $mysqli->query($consultausuario));
    $numerousuario = $resultadousuario->num_rows;

    if($resultadoemail = $mysqli->query($consultaemail));
    $numeroemail = $resultadoemail->num_rows;

    if($numeroemail>0) {
      echo "Este correo ya esta registrado, intenta con otro";
    }

    elseif($numerousuario>0) {
      echo "Este usuario ya existe";
    }

    else {

      $aleatorio = uniqid();
      $ran_id = rand(time(), 100000000);
      $query = "INSERT INTO users (email,unique_id,name,username,password,signup_date,last_ip,code) VALUES ('$email','$ran_id','$nombre','$usuario','$password',now(),'$ip','$aleatorio')";

      if($registro = $mysqli->query($query)) {

        Header("Refresh: 2; URL=index.php");

        echo "Felicidades $usuario se ha registrado correctamente, te hemos enviado un correo de confirmacion.";

        // Debes editar las próximas dos líneas de código de acuerdo con tus preferencias
        $email_to = $email;
        $email_subject = "Confirma tu email Photogram";
        $email_from = "cloudanimal02@gmail.com";

        $email_message = "Hola " . $usuario . ", para poder disfrutar de nuestro sitio web, debes confirmar tu email\n\n";
        $email_message .= "Ingresa el siguiente codigo para confirmar tu email\n\n";
        $email_message .= "Codigo: " . $aleatorio . "\n";


        // Ahora se envía el e-mail usando la función mail() de PHP
        $headers = 'From: '.$email_from."\r\n".
        'Reply-To: '.$email_from."\r\n" .
        'X-Mailer: PHP/' . phpversion();
        @mail($email_to, $email_subject, $email_message, $headers);


      }

      else {

        echo "Ha ocurrido un error en el registro, intentelo de nuevo";
        header("Refresh: 2; URL=registro.php");

      }


    }

    $mysqli->close();

  }
  ?>
  
  <div class="main-content">
    <div class="header">
      <?php //insertar logo ce cloud animal ?><center><h3>CloudAnimal</h3></center>
    </div>
    <form action="" method="post">
      <div class="l-part">
        <input type="email" placeholder="Correo electrónico" class="input" name="mail" required />
        <div class="overlap-text">
          <input type="text" placeholder="Nombre completo" class="input" name="nombre" required />
        </div>
        <div class="overlap-text">
          <input type="text" placeholder="Usuario" class="input" name="usuario" required />
        </div>
        <div class="overlap-text">
          <input type="password" placeholder="Contraseña" class="input" name="password" required />
        </div>
        <input type="submit" value="Registrarte" class="btn" name="registro" />
      </div>
    </form>
  </div>
  <div class="sub-content">
    <div class="s-part">
      ¿Tienes una cuenta? <a href="index.php">Entrar</a>
    </div>
  </div>

</div>

</body>
</html>
<?php
ob_end_flush();
?>