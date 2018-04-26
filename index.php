<?php include 'header.php'; 
$radius=(@$_GET['radius'])?$_GET['radius']:'';
$marker='';   
$apotikDB=$system->db->getAll("select * from apotek where 1");
#adodb_pr($apotikDB);
foreach($apotikDB as $r){
	
	if($r['jam_operasional']==1){
		$icon='asset/icon/24.png';
	}else{
		$icon='asset/icon/12.png';
	}
	
	$marker.='
		{
		"title": \''.html_entity_decode($r['nama_apotek']).'\',
		"lat": \''.$r['latitude'].'\',
		"lng": \''.$r['longitude'].'\',
		"icon": \''.$icon.'\',
		"gambar": \''.$r['foto_apotek'].'\',
		"description": \''.html_entity_decode($r['alamat_apotek']).'\'
		},';
} 
$marker=substr($marker,0,-1);
?>
<!-- Content Wrapper. Contains page content -->
<div id="location"class="content-wrapper">
	<div class="container">
		<!-- Content Header (Page header) -->
	  <!-- Main content -->
	  <section class="content">
		<div class="row">
			<div class="col-md-4 col-sm-4 col-xs-12">
				<div class="box box-primary">
					<div class="radius">
						<form  role="form" method="GET" enctype="multipart/form-data" action="">
							<div class="form-group">
							
							  <select name="jop" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
								<option>Radius</option>
								<option value="1">1km</option>
								<option value="2">2KM</option>
								<option value="3">3KM</option>
								<option value="4">4KM</option>
							  </select>
							</div>
							<div class="form-group">
								<button type="submit" name="simpan" class="btn btn-primary cari">Cari Radius</button>
							</div>
						
						</form>
					</div>
				  </div>
				</div>
				<div class="col-md-8 col-xs-12 col-sm-8">
					<div class="box box-primary">
						<div class="content-box">
							<div class="map"  id="map-canvass" >
							
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	  </section>
	  <!-- /.content -->
	</div>
<!-- /.container -->
</div>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD4xJjwX5seUaG1BKxcnhz-jDUWXg8k8Ds&callback=initMap" async defer></script>
<?php include 'footer.php'; ?>

<script type="text/javascript">
	var markers = [<?=$marker?>];
	window.onload = function () {
		LoadMap();
	}
    function LoadMap() {
		
		 var image = 'img/pin.png'; 
		
        var mapOptions = {
            center: new google.maps.LatLng(markers[0].lat, markers[0].lng),
            zoom: 12,
			scrollwheel: false,
            mapTypeId: google.maps.MapTypeId.hybrid
			
			
        };
        var map = new google.maps.Map(document.getElementById("map-canvass"), mapOptions);
 
        //Create and open InfoWindow.
        var infoWindow = new google.maps.InfoWindow();
		console.log(marker);
        for (var i = 0; i < markers.length; i++) {
            var data = markers[i];
            var myLatlng = new google.maps.LatLng(data.lat, data.lng);
            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                title: data.title,
				icon: data.icon
            });
 
            //Attach click event to the marker.
            (function (marker, data) {
                google.maps.event.addListener(marker, "click", function (e) {
                    //Wrap the content inside an HTML DIV in order to set height and width of InfoWindow.
                    /* infoWindow.setContent("<div style = 'width:100%;min-height:40px'> <h3 style='margin-bottom:10px;' class='section-title text-center' >"+data.title+"</h3>" + data.description + "</div>");
                    infoWindow.open(map, marker); */
					
					 infoWindow.setContent('<div class="media" style="width:300px;" ><div class="pull-left"><img src="admin/upload/' + data.gambar + '" class="media-object" style="width:60px; height:100%;"></div><div class="media-body"><h4 class="media-heading">' + data.title +'</h4><p>' + data.description + '</p></div></div>');
                    infoWindow.open(map, marker);
					
					
					
					
					/* if (marker.getAnimation() != null) {
					marker.setAnimation(null);
					} else {
						marker.setAnimation(google.maps.Animation.BOUNCE);
					} */
					
                });
            })(marker, data);		
		}
	}
	
	
	
	
	/* geo location */
	
	$(document).ready(function(){
		if(navigator.geolocation){
			navigator.geolocation.getCurrentPosition(showLocation);
		}else{ 
			$('#location').html('Geolocation is not supported by this browser.');
		}
	});

	function showLocation(position){
		var latitude = position.coords.latitude;
		var longitude = position.coords.longitude;
		
		
		/* $.ajax({
			type:'POST',
			url:'getLocation.php',
			data:'latitude='+latitude+'&longitude='+longitude,
			success:function(msg){
				if(msg){
				   $("#location").html(msg);
				}else{
					$("#location").html('Not Available');
				}
			}
		}); */
		return latitude+','+longitude;
	}
	
</script>
