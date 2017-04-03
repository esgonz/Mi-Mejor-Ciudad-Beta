


<div class="col-md-12 thumbnail">
	<!-- Content Row -->
	<div class="row">
		<?php 
		if ($error!=null) :?>
			<p class="bg-warning">
				<?php
				foreach ($error as $key => $value) {
					echo "$key: $value .-<br>";
				}
				?>
			</p>
		<?php endif;
		?>
		<div class="col-md-12 center-block">
		<h1>Crear una nueva Causa</h1>
			<form method="post" action="index.php?controlador=causas&accion=crear">
				<div class="form-group">
					<label for="inputNombre">Nombre</label>
					<input type="text" required="true" class="form-control" id="inputNombre" name="inputNombre" placeholder="Nombre" value="<?php echo $nombre;?>">
				</div>
				<div class="form-group">
					<label for="inputCategoria">Categoria</label>
					<select class="form-control"   id="inputCategoria" name="inputCategoria">

						<?php 
						//var_dump($categoriasObj);
						foreach($categoriasObj as $cat) :?>
							<option value="<?php echo $cat['id']; ?>"><?php echo $cat['nombre'];  ?></option>
					<?php endforeach;?>
						
					</select>

				</div>

				<div class="form-group">
					<label for="inputRespuesta">Autoridad</label>
					<small>A Quien va dirigida la Causa, ¿ a cuales autoridades deseeas hacer visible tu Problema ?</small>
					<select class="form-control"  id="inputAutoridad" name="inputRespuesta">

						<?php 
						//var_dump($categoriasObj);
						foreach($autoridadesObj as $aut) :?>
							<option value="<?php echo $aut['id']; ?>"><?php echo $aut['nombre'];  ?></option>
					<?php endforeach;?>
						
					</select>

				</div>
				<div class="form-group">
					<label for="textBoxDescripcion">Descripción</label>
					<textarea cols="20" required="true"  class="form-control" id="textBoxDescripcion" name="textBoxDescripcion"><?php echo $descripcion;?></textarea>
				</div>


				<h4>Ubicar Punto en el mapa</h4>


				<div class="form-group">
					<label for="inputDireccion">Dirección</label>
					<input id="inputDireccion" required="true"  name="inputDireccion" class="form-control"  type="textbox" placeholder="Abdon cifuentes Santiago, Chile" value="<?php echo $direccion;?>">
								      
				</div>
				<input id="lat" name="lat" type="hidden" value="<?php echo $lat;?>"/>
				<input id="lng" name="lng" type="hidden" value="<?php echo $lng;?>"/>
				<div class="form-group">
					<input id="submit" class="btn btn-success form-control" type="button" value="Ubicar en el Mapa" />
				</div>
				


				<div id="map" class="form-control" >
						
				</div>
				<input type="hidden" id="hiddenCrear" name="hiddenCrear">
				<div class="form-group">
					<button type="submit" id="botonCrear" class="form-control btn btn-lg btn-primary"  name="botonCrear" >Crear Causa</button>
				</div>
				
				
			</form>
		</div>
	</div>
</div>
<!-- /.row -->


<script>

var mainMap;
var mainInfowindow;
var mainMarker;
var mainGeocoder;

	function initMap() {
		var map = new google.maps.Map(document.getElementById('map'), {
			zoom: 8,
			center: {lat:-33.449857, lng: -70.6657249},
		});
		var geocoder = new google.maps.Geocoder();
		var infowindow = new google.maps.InfoWindow;
		mainGeocoder= geocoder;
		mainInfowindow=infowindow;

		document.getElementById('submit').addEventListener('click', function() {
			geocodeAddress(geocoder, map);
		});
	}

	function geocodeAddress(geocoder, resultsMap) {
		var address = document.getElementById('inputDireccion').value;
		geocoder.geocode({'address': address}, function(results, status) {
			if (status === google.maps.GeocoderStatus.OK) {
				resultsMap.setCenter(results[0].geometry.location);
				var marker = new google.maps.Marker({
					map: resultsMap,
					draggable: true,
					position: results[0].geometry.location
				});
				var mainMarker=marker;

				

					    marker.addListener('drag',function(event) {
				        document.getElementById('lat').value = event.latLng.lat();
				        document.getElementById('lng').value = event.latLng.lng();
				    });

				    marker.addListener('dragend',function(event) {
				        document.getElementById('lat').value = event.latLng.lat();
				        document.getElementById('lng').value = event.latLng.lng();
				        geocodeLatLng(mainGeocoder);


				    });


				var mposition=marker.getPosition();
				document.getElementById('lat').value=mposition.lat().toString();
				document.getElementById('lng').value=mposition.lng().toString();
			} else {
				alert('Error Ubicando el punto en el mapa: ' + status);
			}
		});
	}


	function geocodeLatLng(geocoder) {
	  var latlng = {lat: parseFloat( document.getElementById('lat').value), lng: parseFloat( document.getElementById('lng').value)};
	  geocoder.geocode({'location': latlng}, function(results, status) {
	    if (status === google.maps.GeocoderStatus.OK) {
	      if (results[1]) {
	        document.getElementById('inputDireccion').value=results[1].formatted_address;

	      } else {
	        window.alert('No encontramos esa direccioón :(');
	      }
	    } else {
	      window.alert('Error Ubicando el punto en el mapa: ' + status);
	    }
	  });
	}




</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAOzh4rLj47hJ3lMvPhCd53jccc8g6Izbc&signed_in=true&callback=initMap"
async defer></script>
