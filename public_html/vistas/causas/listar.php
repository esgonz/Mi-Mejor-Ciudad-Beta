    <div class="row">
      <div class="col-md-12">
        <div class="thumbnail">
        <div class="row">
            <div class="avatar-listar">
                  <img class="img-responsive center-block"border="0" src="http://cupontu.com/tesis/proyecto-titulo/public_html/<?php echo $_SESSION['us_avatar'];?>" alt="<?php echo $causa->nombre;?>">
            </div>
            </div>
            <?php 
      /*$_SESSION['valid'] = true;
                          $_SESSION['timeout'] = time();
                          $_SESSION['us_usuario'] = $DBuser->usuario;
                          $_SESSION['us_email'] = $DBuser->email;    
                          $_SESSION['us_id'] = $DBuser->id;
                          $_SESSION['us_tipo'] = $DBuser->tipo;
                          $_SESSION['us_estado'] = $DBuser->estado;
                          $_SESSION['us_nombre'] = $DBuser->nombre;
                          $_SESSION['us_apellido'] = $DBuser->apellido;
                          $_SESSION['us_avatar'] = $DBuser->avatar;   */

            ?>
            <div class="caption">
            <h3>Usuario: <?php echo   $_SESSION['us_usuario'] ;?></h3>
              <h4>Nombre: <?php echo $_SESSION['us_nombre'].' '.$_SESSION['us_apellido']   ;?></h4>
              <h5>Email: <?php echo $_SESSION['us_email']   ;?></h5>
            </div>
        </div>
      </div>
    </div>
    <div class="row">

      <div class="col-md-12" >
          <hr>
          <h2>Mis Causas:</h2>
          
            <?php
            if($causas>0):
              foreach ($causas as $causa) : ?>
                <?php $seguidores= Causa::findSeguidores($causa->id);

                ?>
                <div class="thumbnail thumb-listar col-md-4 ">
                <form action="<?php echo $this->urlbase;?>index.php?controlador=causas&accion=validar" method="POST">
                  <input type="hidden" name="inputCausaID" value="<?php echo $causa->id;?>">
                  <div>
                    <img class="img-responsive center-block"border="0" src="https://maps.googleapis.com/maps/api/staticmap?center=<?php echo $causa->lat;?>,<?php echo $causa->lng;?>&zoom=20&size=400x400&markers=color:red%7Clabel:C%7C<?php echo $causa->lat;?>,<?php echo $causa->lng;?>&KEY=AIzaSyAOzh4rLj47hJ3lMvPhCd53jccc8g6Izbc" alt="<?php echo $causa->nombre;?>">
                  </div>
                  <?php 
                                switch ($causa->categoria) {
                                  case 1:
                                    $iconcat = '<span class="icon-single icon-via"></span>';
                                    break;
                                  case 2:
                                    $iconcat = '<span class="icon-single icon-semaforo"></span>';
                                   
                                    break;
                                  case 3:
                                    $iconcat = '<span class="icon-single icon-transito"></span>';
                                    
                                    break;
                                }
                 ?>
                  <div class="caption">
                  
                
                  <?php echo $iconcat;?>

                  <h4 class="text-center"><?php echo $causa->nombre;?> <span class="label label-success"><?php echo count($seguidores);?> Seguidor</span></h4>
                  <p class="text-center" ><?php echo $causa->direccion;?></p>

                    <?php
                        $creado=  strtotime(date($causa->creado));
                        $today = strtotime(date('Y-m-d H:i:s'));
                        $expireDay = strtotime( date('Y-m-d', $creado).' + 1 month');
                        $timeToEnd = $expireDay - $today;
                    ?>
                    <h5 class="text-center">Termina el <?php echo date('d-m-Y', $expireDay );?></h5>
                  <p class="text-center"> <strong> <?php echo date('d', $timeToEnd ); ?> </strong> Dias Restantes</p>
                  <p class="text-center">
                    <?php echo substr($causa->descripcion, 0,200)."..." ;?>
                  </p>
                  <p class="text-center"> 
                    <a href="<?php echo $this->urlbase;?>index.php?controlador=causas&accion=ver&id=<?php echo $causa->id;?>" class="btn btn-primary block-center" role="button">Ver Causa</a>
                     
                      
                      <?php 

                      if ($causa->estado ==0 && $_SESSION['us_tipo']==1) : ?>
                      <input type="submit" name="validarCausa" class="btn btn-success block-center" role="button" value="Validar">
                      <?php
                      elseif ($causa->estado ==0):?>
                        <h5 class="bg-alert">No validada Aún</h5>
                      <?php
                      endif;
                      ?>
                    
                    </form>
                    </p>
                </div>
              </div>
                

              <?php endforeach;
            endif;
            ?>
          
      </div>  

    </div>