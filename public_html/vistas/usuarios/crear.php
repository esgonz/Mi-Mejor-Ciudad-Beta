
	<html>
	<head>
		<title>Registrar Usuario</title>
	</head>
	<body>

	<?php 
		if ($error!=null) :
	?>
			<p class="bg-warning">
				<?php
				foreach ($error as $key => $value) {
					echo "$key: $value .-<br>";
				}
				?>
			</p>
		<?php 
		endif;
		
		if ($mensaje["validar_email"]) :
		?>
			<h1>Has Creado tu usuario !</h1>
			<strong><?php $mensaje["validar_email"] ?></strong>
			<h3>Sigue los siguientes Pasos para validar tu usuario:</h3>
			<strong>Te enviamos un Email para validar tu cuenta,</strong>
			<p>Debes pulsar el enlace que tiene este correo para validar tu cuenta.</p>


		<?php 
		endif;
		?>

		 <?php 
		 if ($_SESSION['valid']) :
		 ?>
      		<p class="bg-success">
		        <?php
		        var_dump($_SESSION);
		        ?>
      		</p>
	    <?php 
	    endif;
	    ?>

      <div class="thumbnail col-md-7 col-md-offset-2">
		<form action="http://cupontu.com/tesis/proyecto-titulo/public_html/index.php?controlador=usuarios&accion=registrar" method="post" class="registro" enctype="multipart/form-data">
			<h2 class="form-signin-heading">Registrar Nuevo Usuario</h2>
			<div class="form-group">
				<label for="dd" >Nombre de Usuario:</label> 
				<input class="form-control" type="text" name="usuario" required="true" placeholder="Misuperuser">
			</div> 
			<div class="form-group">
				<label for="dd">Clave:</label> 
				<input class="form-control" type="password" name="password" required="true" placeholder="Contraseña">
			</div> 
			<div class="form-group">
				<label for="dd">Repetir Clave:</label> 
				<input class="form-control" type="password" name="password2" required="true" placeholder="Contraseña">
			</div>

			<div class="form-group">
				<label for="dd">Email:</label> 
				<input class="form-control" type="email" name="email" required="true" placeholder="mi@email.com">
			</div> 

			<div class="form-group">
				<label for="dd">Nombres:</label> 
				<input class="form-control" type="text" name="nombre" required="true" placeholder="Jhon Snow">
			</div> 
			<div class="form-group">
				<label for="dd">Apellidos:</label> 
				<input class="form-control" type="text" name="apellido" required="true" placeholder="Stark Targarean">
			</div> 
			<div class="form-group">
				<label for="dd">Avatar:</label> 
				<input class="form-control" type="file" name="avatar" id="avatar" required="true" placeholder=".jpg .jpeg">
			</div> 

			<div class="form-group"> 
				<input class="btn btn-lg btn-primary btn-block" type="submit" name="enviar" value="Registrar">
			</div> 
		</form>
      </form>
      </div>
	</body>
	</html>





