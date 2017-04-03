<!-- Heading Row -->
        <div class="row">
        	<h1></h1>
            <div class="col-md-7">
               	<img class="img-responsive center-block"border="0" src="https://maps.googleapis.com/maps/api/staticmap?center=<?php echo $causa->lat;?>,<?php echo $causa->lng;?>&zoom=17&size=640x640&markers=color:red%7Clabel:C%7C<?php echo $causa->lat;?>,<?php echo $causa->lng;?>&KEY=AIzaSyAOzh4rLj47hJ3lMvPhCd53jccc8g6Izbc" alt="<?php echo $causa->nombre;?>">
				<?php //
				//echo"<pre>";
				//	var_dump($causa);
				//echo"</pre>";

				?>
			</div>
            <!-- /.col-md-8 -->
          	<div class="col-md-5 row">
	            <div class="row jumbotron detalle-causa">
	            	<div class="col-md-12 col-sm-6 col-xs-12">
						<h2 class="text-center"><?php echo $causa->nombre; ?></h2>
			            <span class="icon-detalle icon-semaforo "></span>
			            <h3 class="text-center bg-primary"> Problemas de Señaletica <?php echo $causa->tipo; ?></h3>
			            <h3 class="text-center ">Dirigida a : <?php echo $autoridad['nombre'];?></h3>
			            <?php

				            $isfollow=false;
				            if ($seguidores>0) :
				            	foreach ($seguidores as $seguidor) {
									if ($seguidor['id']== intval($_SESSION['us_id'])) {
										$isfollow=true;
									}			            		
				            	}
				            endif; 
				            if (!$isfollow) :
				            	if ($causa->usuario != intval($_SESSION['us_id'])) :
						?>
				            		<button type="button" class="btn btn-primary  btn-lg center-block" data-toggle="modal" data-target="#SeguirModal" data-whatever="">Unirme Ahora</button>
				        <?php 	else:
				        			echo"<h5>Eres el Creador de Esta Causa</h5>";
				          		endif;
				          	endif;
				        ?>			            
					</div>

					<div class="col-md-12 col-sm-6 col-xs-12">
						<p><?php echo substr($causa->descripcion, 0,160)."..."; ?></p>
					</div>        
		          	<hr>

			        <div class="col-md-12 col-sm-6 col-xs-12">
			            <div class="row">
			            	<div class="col-md-12">
			            		<span class="icon-single icon-personas center-block"></span>
				        		<h3 class="text-center"><?php echo count($seguidores); ?> Personas Unidas</h3>
				        		<div class="row">
				        			
				        		
				        		<?php if ($seguidores>0) :?>
					        		<?php foreach ($seguidores as $seguidor):?>
					        			<div class="col-md-4 avatar">
											<a href="#" class="thumbnail">
												<img src="<?php echo $seguidor['avatar']; ?>" alt="<?php echo $seguidor['usuario']; ?>">
											</a>
										</div>
					        		<?php endforeach;?>

					        	<?php endif;?>
				        		</div>

			            	</div>
			            	<div class="col-md-12">
			            		<?php
			            			$creado=  strtotime(date($causa->creado));
			            			$today = strtotime(date('Y-m-d H:i:s'));
									$expireDay = strtotime( date('Y-m-d', $creado).' + 1 month');
									$timeToEnd = $expireDay - $today;
			            		?>
			            		<span class="icon-single icon-calendarfail center-block"></span>

				        		<h3 class="text-center"><?php echo date('d-m-Y', $expireDay );?></h3>
				        		<small class="text-center"> Restan <?php echo date('d', $timeToEnd ); ?> Días Para Enviar la peticion</small>
			            	</div>
			            </div>
				        
			        	            
				        
			        </div>
		        <hr>
	            	
	            </div>
				
	        </div>          
          <!-- /.col-md-4 -->
        </div>
        <!-- /.row -->

        <hr>

        <!-- Call to Action Well -->
        <div class="row">
            <div class="col-lg-12">
                <div class="well text-center">
                    Esta causa no ha sido Comunicada aún.
                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <!-- Content Row -->
        <div class="row thumbnail">
            <div class="col-md-8">
                <h2><?php echo $causa->nombre; ?></h2>
                <p><?php echo $causa->descripcion; ?></p>
            </div>
            <!-- /.col-md-4 -->
            <div class="col-md-4">
                <h3>Comentarios</h3>
                


                <?php 

                if (count($comentarios)>0):
                	foreach ($comentarios as $comentario) :?>
		                <div class="panel panel-default">
						  <div class="panel-heading">
						  <div class="row">
						  	<div class="col-md-12"><h4><?php echo $comentario['us_usuario'];?></h4></div>
						  </div>
						   
						  				
							
						  </div>
						  <div class="panel-body">
						  <div class="pull-right avatar-coment">
						  	<a href="#" class="thumbnail">
												<img src="<?php echo $comentario['us_avatar']; ?>" alt="<?php echo $comentario['us_usuario']; ?>">
							</a>
						  
						  </div>
						  	
						    <?php echo $comentario['cm_comentario'];?>
						  </div>
						</div>


		                <?php
                	endforeach; 
                endif;	
                ?>

				  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="">Comentar</button>

            </div>
        </div>
        <!-- /.row -->


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Nuevo Comentario</h4>
      </div>
      <div class="modal-body">
        <form method="post" action="index.php?controlador=causas&accion=comentar">
		  <div class="form-group">
            <label for="message-text" class="control-label" name="">Comentario:</label>
            <input type="hidden" name="InputComentCausa" value="<?php echo $causa->id; ?>">
            <textarea class="form-control" id="message-text" name="InputComentario"></textarea>
          </div>
        
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

	        <input type="hidden" id="hiddenComentar" name="hiddenComentar">
	        <input type="submit" class="btn btn-primary" value="Comentar">
	      </div>
      </form>
    </div>
  </div>
</div>


<div class="modal fade" id="SeguirModal" tabindex="-1" role="dialog" aria-labelledby="SeguirModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="SeguirModalLabel">Unirme a Esta Causa</h4>
        
      </div>
      <div class="modal-body">

      	<small> En Hora buena, decidiste unirte a esta causa;Nuestra comunidad te lo agradecera.</small>
        <form method="post" action="index.php?controlador=causas&accion=unirse">
		  <div class="form-group">
            
            <input type="hidden" name="InputSeguirCausa" value="<?php echo $causa->id; ?>">
          </div>
        
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

	        <input type="hidden" id="hiddenSeguir" name="hiddenSeguir">
	        <input type="submit" class="btn btn-primary" value="Unirme">
	      </div>
      </form>
    </div>
  </div>
</div>