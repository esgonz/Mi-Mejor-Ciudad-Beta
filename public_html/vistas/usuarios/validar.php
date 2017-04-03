


<div class="col-md-12">
	<!-- Content Row -->
	<div class="row">
		<?php 
		if ($error!=null) :?>
			
			
		<?php endif;
		?>
		<div class="col-md-12 center-block">
			<div class="jumbotron">
				<?php 
					if ($error!=null) :?>
						<h1>Ocurrio algún problema...</h1>
						<p class="bg-warning">
						<?php
							foreach ($error as $key => $value) {
								echo "$key: $value .-<br>";
							}
						?>
						</p>
				<?php 
					endif;


				?>


				<?php 
					if ($mensaje["verificar_usuario"]) :?>
					<h1>Bienvenido!</h1>
					<strong><?php $mensaje["verificar_usuario"] ?></strong>
					<h3>Has verificado tu usuario !</h3>
					<strong>ya puedes compartir e interactuar en nuestra plataforma. </strong>

					<?php endif;
				?>
			</div>
			
		</div>
	</div>
</div>
<!-- /.row -->


