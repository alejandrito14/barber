var map="";
var marker;
var watchID;
var latitud="";
var longitud="";
var geocoder = "";

  function initMap() {


 var promResuelta =  new Promise(resolve => {
 
      resolve(ColocarMapa());
  
  });

 promResuelta.then(
    // Registrar el valor de la promesa cumplida
       function() {
        //Marcar(longitud,latitud);
    }).catch(
    // Registrar la razón del rechazo
    function(reason) {


    });
  

     // console.log(map);
  
}

function initMap2() {

  

   var promResuelta =  new Promise(resolve => {
 
      resolve(ObtenerPosicionesSucursales());
  
  });

 promResuelta.then(
    // Registrar el valor de la promesa cumplida
       function() {



    }).catch(
    // Registrar la razón del rechazo
    function(reason) {

      Marcar()
    });
  
 
}

function ObtenerMapa(longitude,latitude) {
  PintarMapa(longitude,latitude);

 
}

function PintarMapa(longit,lat) {
  $(document).ready( function () {
      latitud=lat;
      longitud=longit;
       window.google = {};
        var script = document.createElement("script");
        script.type = "text/javascript";
        script.src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyAUQ4vbyeBnN5XbT-oGNX3_R0R72hJc9N8&callback=initMap";
        script.async = true;

        document.body.appendChild(script);

        
  });
}

function ColocarMapa() {
       var coordinates = {
        lat:parseFloat(latitud),
        lng:parseFloat(longitud)
      };
      var mapOptions = {
              // How zoomed in you want the map to start at (always required)
              zoom: 14,
              center: coordinates,
              scrollwheel: false,

       };
   map = new google.maps.Map(document.getElementById('map'),mapOptions);

   
      console.log(coordinates);
    var marker = new google.maps.Marker({
    position: coordinates,
    map: map,
   
  });



}

/*function ColocarMapa2() {
      var mapOptions = {
              // How zoomed in you want the map to start at (always required)
              zoom: 6,
            mapTypeControl: false,
              scrollwheel: false,
              // The latitude and longitude to center the map (always required)
              center: new google.maps.LatLng(20.8688, -100.2195),

          };
 
   map = new google.maps.Map(document.getElementById('map2'),mapOptions);

    

   geocoder = new google.maps.Geocoder();

}*/

var city,postal_code,state,country,sublocality,street_number,route;

/*function placeMarkerAndPanTo(latLng, map) {
    if(marker != null ) {
            marker.setMap(null);

          }

  

 

  geocoder.geocode(
        { location: latLng },
        (
          results = google.maps.GeocoderResult,
          status= google.maps.GeocoderStatus
        ) => {
          if(status === "OK") {
            if(results[0]) {
          console.log  (results[0].address_components);
           var address_components = results[0].address_components;
                    var components={};
                    jQuery.each(address_components,function(k,v1) {jQuery.each(v1.types,function(k2, v2){components[v2]=v1.long_name});});
                     
                    console.log(components);
                    if(components.locality) {
                        city = components.locality;
                    }
 
                    if(!city) {
                        city = components.administrative_area_level_1;
                    }
 
                    if(components.postal_code) {
                        postal_code = components.postal_code;

                       // alert(postal_code);
                    }
                  
 
                    if(components.administrative_area_level_1) {
                        state = components.administrative_area_level_1;
                    }
                     
                    if(components.route) {
                        route = components.route;
                    }
                    if(components.sublocality_level_1) {
                        sublocality = components.sublocality_level_1;
                    }
                    if(components.country) {
                        country = components.country;
                    }
                    if(components.street_number) {
                      street_number = components.street_number;
                    }

                    }else{
              console.log("No results found");
            }
          }else{
            console.log("Geocoder failed due to: " + status);
          }
        }
      );


    var codigodireccion=localStorage.getItem('codigodireccion');
   
        marker = new google.maps.Marker({
          position: latLng,
          map:map,
          icon:"",
      });
      map.panTo(latLng);

     
}*/



/*  function ObtenerPosicion(position) {
        
        var coordenada = 'Latitude: '  + position.coords.latitude      + '<br />' +
                        'Longitude: ' + position.coords.longitude     + '<br />' ;
    
         var latylon = position.coords.latitude+','+position.coords.longitude;

         alert('aq '+latylon);
    
        localStorage.setItem("latylon", latylon);    //Longitud y latitud.   
         Marcar2(position.coords.longitude,position.coords.latitude);
      TerminarSeguimientoGeo();
    }*/


  /*  var geo_options = {
  enableHighAccuracy: true,
  maximumAge        : 30000,
  timeout           : 27000
};*/

    /*function IniciarGeo()
     {    //si se requiere un cierto tiempo agregar un timeout a la funcion whatchposition
      
      watchID = navigator.geolocation.watchPosition(ObtenerPosicion, ErrorGeoSeguimiento,geo_options);
   
       
   }*/



   /* function ErrorGeoSeguimiento(error) {
        var error = 'code: '    + error.code    + '\n' +
              'message: ' + error.message + '\n';
          alerta('','No se puedo geolocalizar, intente de nuevo');
      }*/


  /*function TerminarSeguimientoGeo()
    {
        navigator.geolocation.clearWatch(watchID);
  }*/
/*function Marcar(longitude,latitude) {
      //alert('aqui3'+longitude);

  if(localStorage.getItem('latlong')!=undefined && localStorage.getItem('latlong')!='') {
            lonlat= localStorage.getItem('latlong');

            var cadena=lonlat.replace('(','').replace(')','');
            latitude=cadena.split(',')[0];
            longitude=cadena.split(',')[1];
           latLng=latitude+","+longitude;

        }else{

          latitude="16.7468307";
          longitude="-93.1366118";
          latLng=latitude+","+longitude;

        }
     // alert('aqui4'+latLng);
          localStorage.setItem('latlong',latLng);

        var location = new google.maps.LatLng(latitude,longitude);
      var markerLocation = new google.maps.LatLng(latitude, longitude);

      var mapCanvas = document.getElementById('map');
      var mapOptions = {
        center: location,
        zoom: 16,
        panControl: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      }
      var map = new google.maps.Map(mapCanvas, mapOptions);
    //  var markerImage = 'img/marker.png';
      var marker = new google.maps.Marker({
        position: markerLocation,
        map: map,
      //  icon: markerImage
      });
      var contentString = '<div class="info-window">' +
                    '<h3>Información Google Maps</h3>' +
                    '<div class="info-content">' +
                    '<p>Mensaje de prueba</p>' +
                    '</div>' +
                    '</div>';
      var infowindow = new google.maps.InfoWindow({
        content: contentString,
        maxWidth: 400
      });
     /* marker.addListener('click', function () {
        infowindow.open(map, marker);
      

      });

       map.addListener("click",(e) => {
         marker.setMap(null);
              
         placeMarkerAndPanTo(e.latLng, map);

         
             var latLng = e.latLng;
           
            localStorage.setItem('latlong',latLng);
        });


      var styles = [{"featureType": "landscape", "stylers": [{"saturation": -100}, {"lightness": 65}, {"visibility": "on"}]}, {"featureType": "poi", "stylers": [{"saturation": -100}, {"lightness": 51}, {"visibility": "simplified"}]}, {"featureType": "road.highway", "stylers": [{"saturation": -100}, {"visibility": "simplified"}]}, {"featureType": "road.arterial", "stylers": [{"saturation": -100}, {"lightness": 30}, {"visibility": "on"}]}, {"featureType": "road.local", "stylers": [{"saturation": -100}, {"lightness": 40}, {"visibility": "on"}]}, {"featureType": "transit", "stylers": [{"saturation": -100}, {"visibility": "simplified"}]}, {"featureType": "administrative.province", "stylers": [{"visibility": "off"}]}, {"featureType": "water", "elementType": "labels", "stylers": [{"visibility": "on"}, {"lightness": -25}, {"saturation": -100}]}, {"featureType": "water", "elementType": "geometry", "stylers": [{"hue": "#ffff00"}, {"lightness": -25}, {"saturation": -97}]}];
      map.set('styles', styles);
    

}*/

/**/


/*function PintarMapa2() {
  $(document).ready( function () {

    
        var script = document.createElement("script");
        script.type = "text/javascript";
        script.src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyAUQ4vbyeBnN5XbT-oGNX3_R0R72hJc9N8&callback=initMap";
        script.async = true;

        document.body.appendChild(script);

        
  });
}*/


/*function ObtenerLatitudlongitud(asenta,codigo,c_municipio,c_estado) {
 return new Promise(function(resolve, reject) {
  var datos=asenta+','+codigo+','+c_municipio+','+c_estado;

  $.ajax({
    type: 'POST',
    dataType: 'json',
    url: 'https://maps.googleapis.com/maps/api/geocode/json?address='+datos+'&region=MX&sensor=false&key=AIzaSyAUQ4vbyeBnN5XbT-oGNX3_R0R72hJc9N8',
    data:datos,
    async:false,
    success: function(datos){
      
    var jsondatos=JSON.stringify(datos);

        var estatus=JSON.stringify(datos,['status']);
        var estado=JSON.parse(estatus);
                console.log(estado);

      
        if(estado.status=="OK") {  
          
          var addres=datos.results;
          var localizacion=addres[0].geometry.location;
          latitud=localizacion.lat;
           longitud=localizacion.lng;

            resolve(addres);
      
        }else{
             app.preloader.hide();


          alerta('','No se ha podido geolocalizar su ubicación');
        }

    },error: function(XMLHttpRequest, textStatus, errorThrown){ 
      var error;
        if(XMLHttpRequest.status === 404) error = "Pagina no existe "+pagina+" "+XMLHttpRequest.status;// display some page not found error 
        if(XMLHttpRequest.status === 500) error = "Error del Servidor"+XMLHttpRequest.status; // display some server error 
        //alerta("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR"); 
        console.log("Error leyendo fichero jsonP "+d_json+pagina+" "+ error,"ERROR");
    }

  });

  });
}*/
/*


function Marcar2(longitude,latitude) {

          var latLng="("+latitude+","+longitude+")";
      
          localStorage.setItem('latlong',latLng);

        var location = new google.maps.LatLng(latitude,longitude);
      var markerLocation = new google.maps.LatLng(latitude, longitude);

      var mapCanvas = document.getElementById('map2');
      var mapOptions = {
        center: location,
        zoom: 16,
      zoomControl: false,
        mapTypeControl: false,
        panControl: false,
        streetViewControl: false,
        fullscreenControl: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      }
      var map = new google.maps.Map(mapCanvas, mapOptions);
    //  var markerImage = 'img/marker.png';
      var marker = new google.maps.Marker({
        position: markerLocation,
        map: map,
      //  icon: markerImage
      });
      var contentString = '<div class="info-window">' +
                    '<h3>Información Google Maps</h3>' +
                    '<div class="info-content">' +
                    '<p>Mensaje de prueba</p>' +
                    '</div>' +
                    '</div>';
      var infowindow = new google.maps.InfoWindow({
        content: contentString,
        maxWidth: 400
      });
      marker.addListener('click', function () {
        infowindow.open(map, marker);
      

      });

       map.addListener("click",(e) => {
         marker.setMap(null);
              
         placeMarkerAndPanTo(e.latLng, map);

         
             var latLng = e.latLng;
           
            localStorage.setItem('latlong',latLng);
        });


      var styles = [{"featureType": "landscape", "stylers": [{"saturation": -100}, {"lightness": 65}, {"visibility": "on"}]}, {"featureType": "poi", "stylers": [{"saturation": -100}, {"lightness": 51}, {"visibility": "simplified"}]}, {"featureType": "road.highway", "stylers": [{"saturation": -100}, {"visibility": "simplified"}]}, {"featureType": "road.arterial", "stylers": [{"saturation": -100}, {"lightness": 30}, {"visibility": "on"}]}, {"featureType": "road.local", "stylers": [{"saturation": -100}, {"lightness": 40}, {"visibility": "on"}]}, {"featureType": "transit", "stylers": [{"saturation": -100}, {"visibility": "simplified"}]}, {"featureType": "administrative.province", "stylers": [{"visibility": "off"}]}, {"featureType": "water", "elementType": "labels", "stylers": [{"visibility": "on"}, {"lightness": -25}, {"saturation": -100}]}, {"featureType": "water", "elementType": "geometry", "stylers": [{"hue": "#ffff00"}, {"lightness": -25}, {"saturation": -97}]}];
      map.set('styles', styles);
    

}*/