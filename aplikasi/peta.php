
    <style>
        #map {
            height: 100%;
        }

        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .controls {
            margin-top: 10px;
        }

        .delik {
            display: none;
        }

        .gm-style-iw {
            width: 300px; 
            min-height: 150px;
        }
    </style>
	<?php include "config.php";
	$totalgaris='';
	$a = mysql_query("SELECT * FROM rute order by id desc");
			 while($data = mysql_fetch_array($a)){
				$dari=$data['dari'];
				$ke=$data['ke'];
				
				$b = mysql_query("SELECT lat,lng,nama FROM node where node='$dari'");
			 while($datab = mysql_fetch_array($b)){
				 $namadari=$datab['nama'];
				  $latdari=$datab['lat'];
				 $lngdari=$datab['lng'];
				 $titikdari='{lat:'.$latdari.',lng:'.$lngdari.'}';
			 }
			 
			 
			 	$c = mysql_query("SELECT lat,lng,nama FROM node where node='$ke'");
			 while($datac = mysql_fetch_array($c)){
				 $namake=$datac['nama'];
				  $latke=$datac['lat'];
				 $lngke=$datac['lng'];
				 $titikke='{lat:'.$latke.',lng:'.$lngke.'}';
			 }
			
				$garis=$titikdari.','.$titikke;
				$totalgaris=$garis.','.$totalgaris;
			 }
			 ?>
			 <?php 
			 //echo '['.$totalgaris.']'; 
			
			 ?>
			 
	 <div id="map"></div>
    <script>
        var map;
        var isTambah = false;
        var listMarker   = [];
	
        function initAutocomplete() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: -7.5630718, lng: 110.8269462},
                zoom: 13,
                mapTypeId: 'roadmap'
	
            });

            var input = document.getElementById('pac-input');
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

            google.maps.event.addListener(map, 'click', function(e) {
                if(isTambah == true) placeMarker(e.latLng, map, null);
            });
		
			
			path2= <?php echo '['.$totalgaris.']'; ?>

        flightPath2 = new google.maps.Polyline({
          //path: flightPathCoordinates,
	path: path2,
          strokeColor: 'green',
          strokeOpacity: 1.0,
          strokeWeight: 4
        });
		flightPath2.setMap(map);

		path3=  [{lat: -7.553936338237467, lng:110.83921089304522},{lat: -7.545466168128636 , lng:110.84171939344344}];
								 flightPath3 = new google.maps.Polyline({
          //path: flightPathCoordinates,
	path: path3,
          strokeColor: 'green',
          strokeOpacity: 1.0,
          strokeWeight: 4
        });
		flightPath3.setMap(map);
		
            refreshTps()
  
        }

        function refreshTps(){
            clearMarker();

            $.ajax({
                url : 'index.php?page=antar&action=show',
                type: "GET",
                cache:false,
                dataType: "json",
                success: function(respon){
                    for(var i=0; i<respon.data.length; i++){

                        var tmp = respon.data[i];
                        var latlng = {lat: tmp.lat, lng: tmp.lng};
						var dlatlng = {lat: tmp.dlat, lng: tmp.dlng};

                        var store = {
                            id: tmp.id,
                            nama: tmp.nama,
                            lat: tmp.lat,
                            lng: tmp.lng,
							dlat: tmp.dlat,
                            dlng: tmp.dlng,
							kk: tmp.kk,
							node: tmp.node,
                        };

                       placeMarker(latlng, map, store);
					 
                    }

                }
				,error: function (jqXHR, textStatus, errorThroswn){
                    alert(errorThrown);
                }
            });
        }

	
	  
        function setMapOnAll(map) {
            for (var i = 0; i < listMarker.length; i++) {
                listMarker[i].setMap(map);
            }
			
			
        }

        function clearMarker(){
            setMapOnAll();
            listMarker = [];
        }

        function placeMarker(position, map, store) {
            var image = 'public/img/tps.png';

            var marker = new google.maps.Marker({
                position: position,
                map: map,
                icon: image
            });
			

            infoWindow(marker, store);

            map.panTo(position);

            setBtnTambah(false);

            listMarker.push(marker);

        }

        function tambah(){
            if(isTambah == false){
                $('#tambah').html('Batal');

                isTambah = true;
            }else{
                $('#tambah').html('Tambah');

                isTambah = false;
            }
        }

        function setBtnTambah(b){
            isTambah = b;

            if(isTambah){
                $('#tambah').html('Batal');
            }else{
                $('#tambah').html('Tambah');
            }
        }

        function infoWindow(marker, store){
            // var form =	$("#save-form").clone().show();
            var infowindow_content = '';
			var flightPath ='';
			var flightPath2 ='';

            if(store != null){
				infowindow_content = 
           
            '<div id="bodyContent">'+
            '<b>'+store.node+'</b>' +
            '</div>'+
			  '<form role="form">'+
                    '<input type="hidden" name="id" id="id" value="'+ store.id +'">'+
                    '<input type="hidden" name="lat" id="lat" value="'+ store.lat +'">'+
                    '<input type="hidden" name="lng" id="lng" value="'+ store.lng+'">'+
                    '<div class="box-body">'+
                        '<div class="form-group">'+
                            '<label for="exampleInputEmail1">Nama Tps:</label>'+
                            '<input type="email" value="'+ store.nama +'" class="form-control" readonly>'+
                        '</div>'+
                    '</div>'+
                    '<hr/>'+
                    '<div class="box-footer">'+
                        '<button type="button" onClick="hapus('+store.id+')" class="btn btn-danger">Hapus</button>'+
                    '</div>'+
                    '</form>';
				var kunci=store.id;
				 var flightPathCoordinates = '';
				 var flightPathCoordinates2 = '';
				if(store.id==13){
					flightPathCoordinates = [{lat: -7.553936338237467 , lng: 110.83921089304522}
					,{lat: -7.545466168128636 , lng: 110.84171939344344},{lat: -7.544531089953763 , lng: 110.83940137551963}
					,{lat: -7.542713086061323 , lng: 110.8354114628304},{lat: -7.54177812131097 , lng: 110.833015765486},{lat: -7.539809 , lng: 110.833928}];
					
					
				}
				if(store.id==14){
					flightPathCoordinates = [{lat: -7.553936338237467 , lng: 110.83921089304522}
					,{lat: -7.545466168128636 , lng: 110.84171939344344},{lat: -7.544531089953763 , lng: 110.83940137551963}
					,{lat: -7.542713086061323 , lng: 110.8354114628304},{lat: -7.54177812131097 , lng: 110.833015765486},{lat: -7.539809 , lng: 110.833928}];
					
					
				}
				if(store.id==15){
					flightPathCoordinates = [{lat: -7.55402605673069 , lng: 110.799403287096},{lat: -7.5556784112558, lng: 110.797600547489},
					{lat: -7.55755028749458 , lng: 110.795429029499},{lat: -7.5590818165642 , lng: 110.7929571041},
					{lat: -7.56067399725476 , lng: 110.79028675283},{lat: -7.55886910451826 , lng: 110.785721575489},
					{lat: -7.55853725595855 , lng: 110.783949600574},{lat: -7.560815 , lng: 110.783108}];
				}
				if(store.id==16){
					flightPathCoordinates = [{lat: -7.560815 , lng: 110.783108},{lat: -7.56269442891473 , lng: 110.782070318044},{lat: -7.564149 , lng: 110.785222}];
				}
				if(store.id==17){
					flightPathCoordinates = [{lat: -7.560815 , lng: 110.783108},{lat: -7.56269442891473 , lng: 110.782070318044},{lat: -7.564149 , lng: 110.785222}];
				}
				// [
         //{lat: store.dlat, lng: store.dlng},
        // {lat: store.lat , lng: store.lng}
         
       // ];
	<?php
	$kunci= "13";
	//$kunci= "<script>document.write(store.id)</script>";
		$sqle="select * from node where id='".$kunci."'";
		$e = mysql_query($sqle);
			 while($datae = mysql_fetch_array($e)){
				$latj=$datae['lat'];
				$lngj=$datae['lng'];
				$dlatj=$datae['dlat'];
				$dlngj=$datae['dlng'];
				 $titikkee='{lat:'.$latj.',lng:'.$lngj.'}';
				  $titikdarii='{lat:'.$dlatj.',lng:'.$dlngj.'}';
				  $gariss=$titikdarii.','.$titikkee;
			 }
?>			 
path1= <?php echo '['.$gariss.']'; ?>
//path1=[
 //         {lat: store.dlat, lng: store.dlng},
 //         {lat: store.lat , lng: store.lng}
         
 //       ];

        flightPath = new google.maps.Polyline({
          path: flightPathCoordinates,
	//path: path1,
          strokeColor: '#FF0000',
          strokeOpacity: 1.0,
          strokeWeight: 4
        });
		
		    flightPath2 = new google.maps.Polyline({
          path: flightPathCoordinates2,
	//path: path1,
          strokeColor: 'yellow',
          strokeOpacity: 1.0,
          strokeWeight: 4
        });

		
				 
            }else{
                var seq = listMarker.length + 1;
                infowindow_content = '<div class="box box-primary gm-style-iw" id="save-form">'+
                    '<div class="box-header with-border">'+
                        '<h3 class="box-title">Form Tambah</h3>'+
                    '</div>'+
                    '<hr/>'+
                    '<form role="form">'+
                    '<input type="hidden" name="seq" id="seq" value="'+ seq +'">'+
                    '<input type="hidden" name="lat" id="lat" value="'+ marker.getPosition().lat() +'">'+
                    '<input type="hidden" name="lng" id="lng" value="'+ marker.getPosition().lng() +'">'+
                    '<div class="box-body">'+
                        '<div class="form-group">'+
                            '<label for="exampleInputEmail1">Nama Tps:</label>'+
                            '<input type="text" id="nama" class="form-control" id="exampleInputEmail1" placeholder="Nama TPSs">'+
                        '</div>'+
                    '</div>'+
                    '<hr/>'+
                    '<div class="box-footer">'+
                        '<button type="button" onClick="save()" class="btn btn-primary">Simpan</button>'+
                        '<button type="button" onClick="refreshTps()" class="btn btn-default">Batal</button>'+
                    '</div>'+
                    '</form>'+
                '</div>';
            }

				function addLine() {
        flightPath.setMap(map);
      }

	  		function addAlternatif() {
        flightPath2.setMap(map);
      }
      function removeLine() {
        flightPath.setMap(null);
      }
	  
	  function removeAlternatif() {
        flightPath2.setMap(null);
      }
            var iw = new google.maps.InfoWindow({
				
                content: infowindow_content,
                maxWidth: 300
            });    
			

            marker.addListener('click', function() {
               iw.open(map, marker);
				addLine();
				addAlternatif();
	
            });

            map.addListener('click', function() {
                iw.close();
					removeLine();	
					removeAlternatif();
            });

            if(store == null) iw.open(map, marker);
        }

        function save(){
            var idx = parseInt($('#seq').val());

            $.ajax({
                url : 'index.php?page=tempat&action=save',
                type: "POST",
                data: 'nama='+$('#nama').val()+'&lat='+$('#lat').val()+'&lng='+$('#lng').val(),
                cache:false,
                dataType: "json",
                success: function(respon){
                
                    refreshTps();

                },error: function (jqXHR, textStatus, errorThrown){
                    alert(errorThrown);
                }
            });
        }

        function hapus(id){

            $.ajax({
                url : 'index.php?page=tempat&action=hapus&id='+id,
                type: "GET",
                cache:false,
                dataType: "json",
                success: function(respon){
                
                    refreshTps();

                },error: function (jqXHR, textStatus, errorThrown){
                    alert(errorThrown);
                }
            });
        }
		
		
	
    </script>


 
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBP91rdqTlc6IePwqH3dEnVpnNKaXGQ50k&libraries=places&callback=initAutocomplete" async defer></script>