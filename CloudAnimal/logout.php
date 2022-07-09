<?php
	@session_start();
	require "conexion.php";
	$estado = mysqli_query($mysqli, "UPDATE users SET status = '0' WHERE id = '".$_SESSION['id']."'");
	$mysqli->close();
	session_destroy();
	header("Location: index.php");
 
 ?>