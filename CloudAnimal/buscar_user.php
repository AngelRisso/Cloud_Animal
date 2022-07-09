<?php 
  session_start();
  require "conexion.php";
  if (!isset($_SESSION['logueado']) && $_SESSION['logueado'] == FALSE) {
	header("Location: index.php");
}
?>
<?php require "header.php"; ?>
<body>
<div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
          <?php 
            $sql = mysqli_query($mysqli, "SELECT * FROM users WHERE unique_id = '" . $_SESSION['unique_id'] . "'");
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
            }
          ?>
          
          <div class="details">
            <span><?php echo $row['username'] ?></span>
            <p><?php echo $row['status']; ?></p>
          </div>
        </div>
        
      </header>
      <div class="search">
        <span class="text">Seleccione un usuario para iniciar el chat</span>
        <input type="text" placeholder="Ingrese el nombre para buscar ..." class="active">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">
  
      </div>
    </section>
  </div>

  <script src="./js/usuarios.js"></script>

</body>
</html>