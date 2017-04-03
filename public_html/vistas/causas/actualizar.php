<div class="col-md-12">
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
			<form method="post" action="index.php?controlador=causas&accion=crear">
				<div class="form-group">
					<label for="inputNombre">Nombre</label>
					<input type="text" class="form-control" id="inputNombre" name="inputNombre" placeholder="Nombre">
				</div>
				<div class="form-group">
					<label for="inputCategoria">Categoria</label>
					<select class="form-control" id="inputCategoria" name="inputCategoria">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
					</select>

				</div>
				<div class="form-group">
					<label for="textBoxDescripcion">Decsripcion</label>
					<textarea class="form-control" id="textBoxDescripcion" name="textBoxDescripcion">
					</textarea>

				</div>


				<h4>Ubicar Punto en el mapa</h4>


				<div class="form-group">
					<label for="inputDireccion">Dirección</label>
					<input id="inputDireccion"  name="inputDireccion" type="textbox" value="Abdon cifuentes Santiago, Chile">
								      
				</div>
				<input id="lat" name="lat" type="text" value=""/>
				<input id="lng" name="lng" type="text" value=""/>

				<input id="submit" type="button" value="Ubicar" class="btn btn-success"/>


				<div id="map">
						
				</div>
				<input type="hidden" id="hiddenCrear" name="hiddenCrear">
				<button type="submit" id="botonCrear" name="botonCrear" class="btn btn-lg btn-primary">Crear Causa</button>
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
				alert('Geocode was not successful for the following reason: ' + status);
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
	        window.alert('No results found');
	      }
	    } else {
	      window.alert('Geocoder failed due to: ' + status);
	    }
	  });
	}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAOzh4rLj47hJ3lMvPhCd53jccc8g6Izbc&signed_in=true&callback=initMap"
async defer></script>
<p>This is the requested causa:</p>

<h1><?php echo $causa->titulo; ?></h1>
<p><?php echo $causa->descripcion; ?></p>