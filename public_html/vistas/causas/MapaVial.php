<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>PHP/MySQL & Google Maps Example</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAOzh4rLj47hJ3lMvPhCd53jccc8g6Izbc"
            type="text/javascript"></script>
    <script type="text/javascript">
    //<![CDATA[

    var customIcons = {
      '1': {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_blue.png'
      },
      '2': {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_red.png'
      },
      '3': {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_red.png'
      }
    };

    function load() {
      var map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(-33.449857,  -70.6657249),
        zoom: 11,
        mapTypeId: 'roadmap'
      });
      var infoWindow = new google.maps.InfoWindow;

      // Change this depending on the name of your PHP file         
        <?php
        	foreach ($causas as $marker) : 
        		?>

        var nombre = "<?php echo $marker['nombre'];?>";
          var direccion = "<?php echo $marker['direccion'];?>";
          var tipo = '<?php echo $marker['tipo'];?>';
          var point = new google.maps.LatLng(
              <?php echo $marker['lat'];?>,
              <?php echo $marker['lng'];?>);
          var html = "<b>" + nombre + "</b> <br/>" + direccion;
          var icon = customIcons[tipo] || {};
          var marker = new google.maps.Marker({
            map: map,
            position: point,
            icon: icon.icon
          });
          bindInfoWindow(marker, map, infoWindow, html);

        <?php endforeach;
        ?>

    
    }

    function bindInfoWindow(marker, map, infoWindow, html) {
      google.maps.event.addListener(marker, 'click', function() {
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
      });
    }



    //]]>

  </script>

  </head>

  <body onload="load()">
    <div id="map"></div>
  </body>

</html>