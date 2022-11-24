<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>


<div class="col-md-12">
	<div class="row">

		{{-- bloc1 --}}
		<div class="col-md-12 mb-2">
			<div class="col-md-12">
				<div class="card text-center">
					
					<div class="card-body">

						{{-- {{ var_dump(json_encode($initialMarkers)) }} --}}
					
						<div id="map" style="width: 100%; height: 550px;"></div>
						
					</div>
				</div>
			</div>
		</div>
		{{-- bloc1 --}}

		{{-- bloc1 --}}
		<div class="col-md-12 mb-2" style="margin-top: 10px;">
			<div class="col-md-12">
				<div class="card text-center">
					
					<div class="card-body">


					
						
						
					</div>
				</div>
			</div>
		</div>
		{{-- bloc1 --}}


		
		

	</div>
</div>


<script>

	 let map, markers = [];
        /* ----------------------------- Initialize Map ----------------------------- */
        function initMap() {
            map = L.map('map', {
                center: {
                    lat: -1.676783610993345,
                    lng: 29.230394626807147,



                },
                zoom: 13
            });

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap'
            }).addTo(map);

            map.on('click', mapClicked);
            initMarkers();
        }
        initMap();

        /* --------------------------- Initialize Markers --------------------------- */
        function initMarkers() {
            const initialMarkers = <?php echo json_encode($initialMarkers); ?>;

            for (let index = 0; index < initialMarkers.length; index++) {

                const data = initialMarkers[index];
                const marker = generateMarker(data, index);
                marker.addTo(map).bindPopup(`
                    <div align="center" class="text-center">
                        <img src="${data.infos.image}" width="40" height="40">

                        <h5>${data.infos.nom} ${data.infos.prenom}</h5>  <b><h5><a href="tel:${data.infos.telephone}">${data.infos.telephone}</a></h5></b><br>
                    </div>`);
                map.panTo(data.position);
                markers.push(marker)
            }
        }

        function generateMarker(data, index) {
            return L.marker(data.position, {
                    draggable: data.draggable
                })
                .on('click', (event) => markerClicked(event, index))
                .on('dragend', (event) => markerDragEnd(event, index));
        }

        /* ------------------------- Handle Map Click Event ------------------------- */
        function mapClicked($event) {
            console.log(map);
            console.log($event.latlng.lat, $event.latlng.lng);
        }

        /* ------------------------ Handle Marker Click Event ----------------------- */
        function markerClicked($event, index) {
            console.log(map);
            console.log($event.latlng.lat, $event.latlng.lng);
        }

        /* ----------------------- Handle Marker DragEnd Event ---------------------- */
        function markerDragEnd($event, index) {
            console.log(map);
            console.log($event.target.getLatLng());
        }




		

</script>

