       <?php
		   include('config.php');
		//    $a = mysql_query("SELECT max(iterasi) as maxi FROM iterasi");
			
			//	while($data = mysql_fetch_array($a)){
				//$max=$data['maxi'];
//}				
  //          $b = mysql_query("select * from iterasi where iterasi=$max ");
   //       while ($datab = mysql_fetch_array($b)) {
     //       $posisi = $datab['posisi'];
	//		$namab = $datab['nama'];
//$c = mysql_query("update data set posisi='$posisi' where nama='$namab' "); 				
  //        }
          ?>
<!DOCTYPE html>
<html>
  <head>
    <style>
      #map-canvas {
       width: 100%;
height: 600px;
border: 1px solid blue;
      }
    </style>

   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBP91rdqTlc6IePwqH3dEnVpnNKaXGQ50k&libraries=places&callback=initAutocomplete" ></script>

    <script>
    var marker;
      function initialize() {
        var mapCanvas = document.getElementById('map-canvas');
        var mapOptions = {
         zoom: 20,
			center: new google.maps.LatLng(-7.55611,110.83167), 
			mapTypeId: google.maps.MapTypeId.ROADMAP
        }     
        var map = new google.maps.Map(mapCanvas, mapOptions)
        var infoWindow = new google.maps.InfoWindow(), marker, i;     
        var bounds = new google.maps.LatLngBounds();
 
 
        function bindInfoWindow(marker, map, infoWindow, html) {
          google.maps.event.addListener(marker, 'click', function() {
            infoWindow.setContent(html);
            infoWindow.open(map, marker);
          });
        }
 var image1 = 'img/11.png';
  var image2 = 'img/22.png';
   var image3 = 'img/33.png';
   
          function addMarker(lat, lng, info) {
            var pt = new google.maps.LatLng(lat, lng);
            bounds.extend(pt);
            var marker = new google.maps.Marker({
                map: map,
				icon: image1,
                position: pt
            });       
            map.fitBounds(bounds);
            bindInfoWindow(marker, map, infoWindow, info);
          }
		     function addMarkerr(lat, lng, info) {
            var pt = new google.maps.LatLng(lat, lng);
            bounds.extend(pt);
            var marker = new google.maps.Marker({
                map: map,
				icon: image2,
                position: pt
            });       
            map.fitBounds(bounds);
            bindInfoWindow(marker, map, infoWindow, info);
          }
		  function addMarkerrr(lat, lng, info) {
            var pt = new google.maps.LatLng(lat, lng);
            bounds.extend(pt);
            var marker = new google.maps.Marker({
                map: map,
				icon: image3,
                position: pt
            });       
            map.fitBounds(bounds);
            bindInfoWindow(marker, map, infoWindow, info);
          }
 
          <?php
            $query = mysql_query("select * from tempat order by id ");
          while ($data = mysql_fetch_array($query)) {
            $lat = $data['lat'];
            $lon = $data['lng'];
            $nama = $data['tempat'];
			   $total = $data['total'];
			$posisiii = $data['posisi'];
		
			if($posisiii=='C1'){
            echo ("addMarker($lat, $lon, '<b>$nama</b>');\n");
			}
			if($posisiii=='C2'){
			echo ("addMarkerr($lat, $lon, '<b>$nama</b>');\n");		
			}
			if($posisiii=='C3'){
			echo ("addMarkerrr($lat, $lon, '<b>$nama</b>');\n");		
			}
          }
          ?>
        }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
  </head>
  <body>
    <div id="map-canvas"></div>
  </body>
</html>