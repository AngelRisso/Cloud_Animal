<div class="h-header">
	<?php //Colocar logo ?><h3>CloudAnimal</h3>
	<div class="h-search"><a href="perfiles.php"><button class="btn">Perfiles</button></a></div>
	
	<div class="h-account">
		<a href="buscar_user.php"><img src="images/icons/explorar.png" class="i-icon"></a>
		<a href="perfil.php?username=<?php echo $_SESSION['username'];?>">
			<img src="images/icons/perfil.png" class="i-icon">
		</a>
		<a href="logout.php">
			<img src="images/icons/close.png" class="i-icon" width="24px">
		</a>
	</div>
</div>