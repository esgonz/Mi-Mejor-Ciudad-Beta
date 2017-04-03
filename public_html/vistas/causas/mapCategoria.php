<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>PHP/MySQL & Google Maps Example</title>
  
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAOzh4rLj47hJ3lMvPhCd53jccc8g6Izbc" >

    </script>


  </head>

    <body onload="load()">
    
    <div class="row">

      <div class="col-lg-10">
      <h4>Dirección</h4>
        <div class="input-group">          
          <input type="text" class="form-control" id="inputDireccion"  name="inputDireccion" placeholder="Abdon cifuentes Santiago, Chile">
          <span class="input-group-btn">
            <button id="submit" class="btn btn-default" type="button">Ubicar</button>
          </span>
        </div><!-- /input-group -->
      </div><!-- /.col-lg-6 -->

    </div>
    <div class="row"><div id="map" class="col-md-12"></div></div>
    
    <div class="row"id="causasBar" >
      <div class="col-md-12" >
        <h2>Lista de Causas:</h2>
        <div class="list-group">
          <?php
          foreach ($causas as $causa) : ?>

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
            <div class="list-group-item" onclick="myClick(<?php echo $causa->id;?>);">
              <?php echo $iconcat;?>
              <h4 class="text-center"><?php echo $causa->nombre;?></h4>
              <p class="text-center" ><?php echo $causa->direccion;?></p>

                <?php
                    $creado=  strtotime(date($causa->creado));
                    $today = strtotime(date('Y-m-d H:i:s'));
                    $expireDay = strtotime( date('Y-m-d', $creado).' + 1 month');
                    $timeToEnd = $expireDay - $today;
                ?>
                <h5 class="text-center">Termina el <?php echo date('d-m-Y', $expireDay );?></h5>
              <p class="text-center"> <strong> <?php echo date('d', $timeToEnd ); ?> </strong> Dias Restantes</p>
              <hr>
              <a href="<?php echo $this->urlbase;?>index.php?controlador=causas&accion=ver&id=<?php echo $causa->id;?>">Ver Causa</a>
            </div>

          <?php endforeach;
          ?>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6" >
        
          <h2>Ultimas Causas:</h2>
          
            <?php
            foreach ($ultimasCausas as $causa) : ?>
              <div class="thumbnail">
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
                <h3 class="text-center"><?php echo $causa->nombre;?> <span class="label label-success"><?php echo count($seguidores);?> Seguidor</span></h3>
                <p class="text-center" ><?php echo $causa->direccion;?></p>

                  <?php
                      $creado=  strtotime(date($causa->creado));
                      $today = strtotime(date('Y-m-d H:i:s'));
                      $expireDay = strtotime( date('Y-m-d', $creado).' + 1 month');
                      $timeToEnd = $expireDay - $today;
                  ?>
                  <h4 class="text-center">Termina el <?php echo date('d-m-Y', $expireDay );?></h4>
                <h4 class="text-center"> <span class="label label-primary"><strong> <?php echo date('d', $timeToEnd ); ?> </strong> Dias Restantes</span></h4>
                <p class="text-center">
                  <?php echo substr($causa->descripcion, 0,200)."..." ;?>
                </p>
                <p class="text-center"> <a href="<?php echo $this->urlbase;?>index.php?controlador=causas&accion=ver&id=<?php echo $causa->id;?>" class="btn btn-primary block-center" role="button">Ver Causa</a></p>
              </div>
            </div>
              

            <?php endforeach;
            ?>
          
      </div>

      <div class="col-md-6" >
        
          <h2>Causas Populares:</h2>
          
            <?php
            foreach ($masSeguidasCausas as $causa) : ?>
              <?php $seguidores= Causa::findSeguidores($causa->id);

              ?>
              <div class="thumbnail">
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
                <p class="text-center"> <a href="<?php echo $this->urlbase;?>index.php?controlador=causas&accion=ver&id=<?php echo $causa->id;?>" class="btn btn-primary block-center" role="button">Ver Causa</a></p>
              </div>
            </div>
              

            <?php endforeach;
            ?>
          
      </div>  
      </div>
      
    </div>
  </body>


      

    <script type="text/javascript">
      //<![CDATA[

      var markers = [];
      var mainMap;
     
      var mainGeocoder;

      function load(){
      var customIcons = {
        "1": {
          icon: '<?php echo $this->urlbase;?>css/img/geoA_sm.png'
        },
        "2": {
          icon: '<?php echo $this->urlbase;?>css/img/geoB_sm.png'
        },
        "3": {
          icon: '<?php echo $this->urlbase;?>css/img/geoC_sm.png'
        }
      };

      
        var map = new google.maps.Map(document.getElementById("map"), {
          center: new google.maps.LatLng(-33.449857,  -70.6657249),
          zoom: 11,
          mapTypeId: 'roadmap'
        });
        var infoWindow = new google.maps.InfoWindow;
        var geocoder = new google.maps.Geocoder();
        mainGeocoder= geocoder;
        
        document.getElementById('submit').addEventListener('click', function() {
          geocodeAddress(geocoder, map);
        });
        // Change this depending on the name of your PHP file         
          <?php
            foreach ($causas as $causa) : 
              ?>
            var id = "<?php echo $causa->id;?>";  
            var nombre = "<?php echo $causa->nombre;?>";
            var descripcion = "<?php echo substr($causa->descripcion, 0, 30).'...';?>";
            var direccion = "<?php echo $causa->direccion;?>";
            var tipo = "<?php echo $causa->categoria;?>";
            var iconcat ="";
              <?php 
                    switch ($causa->categoria) {
                      case 1:
                        echo 'iconcat= \'<span class="icon-single icon-via"></span>\'';
                        break;
                      case 2:
                        echo 'iconcat= \'<span class="icon-single icon-semaforo"></span>\'';
                        break;
                      case 3:
                        echo 'iconcat= \'<span class="icon-single icon-transito"></span>\'';
                        break;
                    }
                    ?>


            var point = new google.maps.LatLng(
                <?php echo $causa->lat;?>,
                <?php echo $causa->lng;?>);

                  <?php
                      $creado=  strtotime(date($causa->creado));
                      $today = strtotime(date('Y-m-d H:i:s'));
                      $expireDay = strtotime( date('Y-m-d', $creado).' + 1 month');
                      $timeToEnd = $expireDay - $today;
                  ?>
            var html = '<div class="row"> <div class="col-md-12">'
                      + iconcat  
                      +'<h4>'
                      +nombre
                      +'</h4> <p>'
                      +direccion
                      +'</p> <p> <strong><?php echo date("d", $timeToEnd ); ?></strong> Dias Restantes</p> <a href="<?php echo $this->urlbase;?>index.php?controlador=causas&accion=ver&id='
                      +id
                      +'">Ver Causa</a> </div> </div>';
            var icon = customIcons[tipo] || {};
            var marker = new google.maps.Marker({
              map: map,
              position: point,
              icon: icon.icon
            });
            markers['<?php echo $causa->id;?>']=marker;
            bindInfoWindow(marker, map, infoWindow, html);


          <?php endforeach;
          ?>
      }

      
      

      function bindInfoWindow(marker, map, infoWindow, html) {
        google.maps.event.addListener(marker, 'click', function() {
          infoWindow.setContent(html);
          infoWindow.open(map, marker);
          map.panTo(marker.getPosition());
        });
      }

      function myClick(id){
            google.maps.event.trigger(markers[id], 'click');
        } 


    function geocodeAddress(geocoder, resultsMap) {
    var address = document.getElementById('inputDireccion').value;
    geocoder.geocode({'address': address}, function(results, status) {
      if (status === google.maps.GeocoderStatus.OK) {
        resultsMap.setCenter(results[0].geometry.location);
        resultsMap.setZoom(14);

      } else {
        alert('Geocode was not successful for the following reason: ' + status);
      }
    });
  }  
      //]]>

    </script>
</html>