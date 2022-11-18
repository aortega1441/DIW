<!-- <?php

    function gps2Num($coordPart){
        $parts = explode('/', $coordPart);
        if(count($parts) <= 0)
        return 0;
        if(count($parts) == 1)
        return $parts[0];
        return floatval($parts[0]) / floatval($parts[1]);
    }
   function get_image_location($image = ''){
       $exif = exif_read_data($image, 0, true);
       if($exif && isset($exif['GPS'])){
           $GPSLatitudeRef = $exif['GPS']['GPSLatitudeRef'];
           $GPSLatitude    = $exif['GPS']['GPSLatitude'];
           $GPSLongitudeRef= $exif['GPS']['GPSLongitudeRef'];
           $GPSLongitude   = $exif['GPS']['GPSLongitude'];

           $lat_degrees = count($GPSLatitude) > 0 ? gps2Num($GPSLatitude[0]) : 0;
           $lat_minutes = count($GPSLatitude) > 1 ? gps2Num($GPSLatitude[1]) : 0;
           $lat_seconds = count($GPSLatitude) > 2 ? gps2Num($GPSLatitude[2]) : 0;

           $lon_degrees = count($GPSLongitude) > 0 ? gps2Num($GPSLongitude[0]) : 0;
           $lon_minutes = count($GPSLongitude) > 1 ? gps2Num($GPSLongitude[1]) : 0;
           $lon_seconds = count($GPSLongitude) > 2 ? gps2Num($GPSLongitude[2]) : 0;

           $lat_direction = ($GPSLatitudeRef == 'W' or $GPSLatitudeRef == 'S') ? -1 : 1;
           $lon_direction = ($GPSLongitudeRef == 'W' or $GPSLongitudeRef == 'S') ? -1 : 1;

           $latitude = $lat_direction * ($lat_degrees + ($lat_minutes / 60) + ($lat_seconds / (60*60)));
           $longitude = $lon_direction * ($lon_degrees + ($lon_minutes / 60) + ($lon_seconds / (60*60)));


           return array('latitude'=>$latitude, 'longitude'=>$longitude);
       }else{
           return false;
       }
   }

   $image = "../modificarPerfil/imagenes/".$_SESSION['Usuario_fotografia']."";
   $arr = get_image_location($image);
  ?>
  <script type="text/javascript">
    let lat = <?php echo $arr['latitude'] ?>;
    let long = <?php echo $arr['longitude'] ?>;
    let map, infoWindow;
   /*
    let imagen= "<?php echo $_SESSION["Usuario_fotografia"]?>";
    
   let urlIcono="../modificarPerfil/imagenes/"+imagen+"";
   */

    function initMap() {
      const pos ={ lat: lat, lng: long };
      map = new google.maps.Map(document.getElementById("map"), {
        center: pos,
        zoom: 15,
        mapId:'1cac0884531dcf94',
        disableDefaultUI: true,
      });

      

      const marker = new google.maps.Marker({
        position: pos,
        map: map,
       
        //icon: urlIcono
        icon: "https://maps.google.com/mapfiles/kml/shapes/parking_lot_maps.png"
        
      });
      

      infoWindow = new google.maps.InfoWindow();

      const locationButton = document.createElement("button");

      locationButton.textContent = "Mi ubicacion";
      locationButton.classList.add("custom-map-control-button");
      map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);
      locationButton.addEventListener("click", () => {
        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(
            (position) => {
              const pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude,
              };

              infoWindow.setPosition(pos);
              infoWindow.setContent("Estas aqui.");
              infoWindow.open(map);
              map.setCenter(pos);
            },
            () => {
              handleLocationError(true, infoWindow, map.getCenter());
            }
          );
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
      });
    }

    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
      infoWindow.setPosition(pos);
      infoWindow.setContent(
        browserHasGeolocation
          ? "Error: The Geolocation service failed."
          : "Error: Your browser doesn't support geolocation."
      );
      infoWindow.open(map);
    }
  </script> -->