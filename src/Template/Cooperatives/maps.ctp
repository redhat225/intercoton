
<div class="columns" ng-controller="MapsController as mapsctrl">

  <div class="column is-8" style="position:relative;">
     <div id="map" style="width:100%; height:100%;"></div>
      <div id="preloader" style="position: absolute; top:40%;left:40%;">
       <img src="/img/assets/preloaders/map_preloader.gif" width="130px" alt="">
     </div>
  </div>
  <div class="column is-4">
        <div class="card hvr-float-shadow">
            <div class="card-image has-text-centered" id="card-image">
                  <img src="/img/assets/preloaders/cooperative.png" class="is-pad-top-30" width="350px"  alt="">
            </div>
            <div class="card-content">
              <div class="media">
                <div class="media-left">
              <span class="icon is-medium">
                <i class="fa fa-bank fa-2x has-text-intercoton-green"></i>
              </span>
                </div>
                <div class="media-content">
                  <p class="title is-4 is-mar-top-0" id="cooperative_denomination">
                  </p>
                  <p class="subtitle is-6" id="cooperative_sigle"></p>
                  <p class="subtitle is-6 is-mar-bot-3">
                <span class="icon"><i class="fa fa-globe"></i></span>
                    <span class="has-text-weight-bold">Zone:</span> 
                    <span id="cooperative_zone"></span>  
                  </p>
                  <p class="subtitle is-6 is-mar-bot-3">
                    <span class="icon">
                      <i class="fa fa-location-arrow"></i>
                    </span>
                    <span class="has-text-weight-bold">Sous-préfecture:</span>
                    <span id="cooperative_sub_prefecture"></span> 
                  </p>
              <p class="subtitle is-6 is-mar-bot-3">
                <span class="icon"><i class="fa fa-map-marker"></i></span>
                <span class="has-text-weight-bold">Localisation:</span>  
                <span id="cooperative_localisation"></span>
              </p>
                  <p class="subtitle is-6 is-mar-bot-3">
                    <span class="icon"><i class="fa fa-users"></i></span>
                    <span class="has-text-weight-bold">Estimation personnel:</span>  
                    <span id="cooperative_estimation"></span>
                  </p>
                </div>
              </div>
              <div class="content">
                <time> <span class="has-text-weight-bold">Création: </span> <span id="cooperative_created"></span></time>
              </div>
            </div>
              <div class="notification has-text-white" style="background: #0b0032 !important;">
                Veuillez sélectionner un point sur la carte afin d'avoir plus d'informations sur la coopérative associée
              </div>

          </div>
  </div>
      <script>
          function loadContent(){
            $.ajax({
              url:'/cooperatives/maps',
              type:'get',
              data:{action: 'get-geodata'},
              dataType:'json',
              success: function(resp){
                  var cooperatives = resp.cooperatives;
                  initMap(cooperatives);
               },  
              error: function(){
                  toastr.error('Une erreur est survenue lors du chargement de la carte, veuillez réessayer');
              },
              beforeSend: function(){
                $('#preloader').removeClass('is-invisible');
                $('#map').addClass('is-invisible');
              },
              complete: function(){
                $('#preloader').addClass('is-invisible');
                $('#map').removeClass('is-invisible');
              }
            });
          }

         function initMap(cooperatives){
                  var civ_loc = {lat: 7.924958, lng: -5.449805};
                  map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 7,
                    center: civ_loc,
                    gestureHandling: 'cooperative',
                   styles:[
                          {
                            "elementType": "geometry",
                            "stylers": [
                              {
                                "color": "#ebe3cd"
                              }
                            ]
                          },
                          {
                            "elementType": "labels.text.fill",
                            "stylers": [
                              {
                                "color": "#523735"
                              }
                            ]
                          },
                          {
                            "elementType": "labels.text.stroke",
                            "stylers": [
                              {
                                "color": "#f5f1e6"
                              }
                            ]
                          },
                          {
                            "featureType": "administrative",
                            "elementType": "geometry.stroke",
                            "stylers": [
                              {
                                "color": "#c9b2a6"
                              }
                            ]
                          },
                          {
                            "featureType": "administrative.land_parcel",
                            "elementType": "geometry.stroke",
                            "stylers": [
                              {
                                "color": "#dcd2be"
                              }
                            ]
                          },
                          {
                            "featureType": "administrative.land_parcel",
                            "elementType": "labels.text.fill",
                            "stylers": [
                              {
                                "color": "#ae9e90"
                              }
                            ]
                          },
                          {
                            "featureType": "landscape.natural",
                            "elementType": "geometry",
                            "stylers": [
                              {
                                "color": "#dfd2ae"
                              }
                            ]
                          },
                          {
                            "featureType": "poi",
                            "elementType": "geometry",
                            "stylers": [
                              {
                                "color": "#dfd2ae"
                              }
                            ]
                          },
                          {
                            "featureType": "poi",
                            "elementType": "labels.text.fill",
                            "stylers": [
                              {
                                "color": "#93817c"
                              }
                            ]
                          },
                          {
                            "featureType": "poi.park",
                            "elementType": "geometry.fill",
                            "stylers": [
                              {
                                "color": "#a5b076"
                              }
                            ]
                          },
                          {
                            "featureType": "poi.park",
                            "elementType": "labels.text.fill",
                            "stylers": [
                              {
                                "color": "#447530"
                              }
                            ]
                          },
                          {
                            "featureType": "road",
                            "elementType": "geometry",
                            "stylers": [
                              {
                                "color": "#f5f1e6"
                              }
                            ]
                          },
                          {
                            "featureType": "road.arterial",
                            "elementType": "geometry",
                            "stylers": [
                              {
                                "color": "#fdfcf8"
                              }
                            ]
                          },
                          {
                            "featureType": "road.highway",
                            "elementType": "geometry",
                            "stylers": [
                              {
                                "color": "#f8c967"
                              }
                            ]
                          },
                          {
                            "featureType": "road.highway",
                            "elementType": "geometry.stroke",
                            "stylers": [
                              {
                                "color": "#e9bc62"
                              }
                            ]
                          },
                          {
                            "featureType": "road.highway.controlled_access",
                            "elementType": "geometry",
                            "stylers": [
                              {
                                "color": "#e98d58"
                              }
                            ]
                          },
                          {
                            "featureType": "road.highway.controlled_access",
                            "elementType": "geometry.stroke",
                            "stylers": [
                              {
                                "color": "#db8555"
                              }
                            ]
                          },
                          {
                            "featureType": "road.local",
                            "elementType": "labels.text.fill",
                            "stylers": [
                              {
                                "color": "#806b63"
                              }
                            ]
                          },
                          {
                            "featureType": "transit.line",
                            "elementType": "geometry",
                            "stylers": [
                              {
                                "color": "#dfd2ae"
                              }
                            ]
                          },
                          {
                            "featureType": "transit.line",
                            "elementType": "labels.text.fill",
                            "stylers": [
                              {
                                "color": "#8f7d77"
                              }
                            ]
                          },
                          {
                            "featureType": "transit.line",
                            "elementType": "labels.text.stroke",
                            "stylers": [
                              {
                                "color": "#ebe3cd"
                              }
                            ]
                          },
                          {
                            "featureType": "transit.station",
                            "elementType": "geometry",
                            "stylers": [
                              {
                                "color": "#dfd2ae"
                              }
                            ]
                          },
                          {
                            "featureType": "water",
                            "elementType": "geometry.fill",
                            "stylers": [
                              {
                                "color": "#b9d3c2"
                              }
                            ]
                          },
                          {
                            "featureType": "water",
                            "elementType": "labels.text.fill",
                            "stylers": [
                              {
                                "color": "#92998d"
                              }
                            ]
                          }
                        ]
                  });
                 cooperatives.forEach(function(value,ind){
                    var cooperative_position = {lat: parseInt(value.lat), lng: parseInt(value.lon)};
                    var marker = new google.maps.Marker({
                        position: cooperative_position,
                        map: map,
                        info: value,
                        title: value.cooperative_denomination
                    });

                    marker.addListener('click', function(){
                      $('#cooperative_denomination').empty().append(this.info.cooperative_denomination);
                      $('#cooperative_zone').empty().append(this.info.zone.zone_denomination);
                      $('#cooperative_sub_prefecture').empty().append(this.info.cooperative_sub_prefecture);
                      $('#cooperative_localisation').empty().append(this.info.cooperative_localisation);
                      $('#cooperative_estimation').empty().append(this.info.cooperative_nbre_personnel);
                      $('#cooperative_created').empty().append(this.info.created);

                      var image = $("<figure class='image is-4by3'><img src="+this.info.cooperative_assets+" alt='Placeholder image'></figure>");

                      $('#card-image').empty().append(image);
                    }); 

                 });
                }
      </script>

  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgWlWwOPUTYAslG6noU9Tj19TcJJG6pVU&callback=loadContent">
    
  </script>  
</div>
