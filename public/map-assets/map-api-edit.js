     var url;
      function getUrlEdit(link)
      {url = link;}

     var listMarkers = new Array();
      function nextStep(region,addresse){ 
		   document.getElementById("addresse_click").innerHTML="Région: "+region+", addresse: "+addresse;
		   $('#adrReg').val(region+", "+addresse);
		}
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(36.72147601457459, 3.088614445507801),
          zoom: 6,
          scaleControl: true,
          fullscreenControl: false
        });
        var infoWindow = new google.maps.InfoWindow({map: map});
          // Change this depending on the name of your PHP or XML file
          downloadUrl('dataMap/data.xml', function(data) {
              var xml = data.responseXML;
              var markers = xml.documentElement.getElementsByTagName('marker');
              Array.prototype.forEach.call(markers, function(markerElem) {
                  var id = markerElem.getAttribute('id');
                  var name = markerElem.getAttribute('name');
                  var adrReg = markerElem.getAttribute('adrReg');
                  var type = markerElem.getAttribute('type');
                  var point = new google.maps.LatLng(
                      parseFloat(markerElem.getAttribute('lat')),
                      parseFloat(markerElem.getAttribute('lng')));
                  var infowincontent = document.createElement('div');
                  var strong = document.createElement('strong');
                  var p = document.createElement('p');
                  var pp = document.createElement('p');
                  strong.textContent = name;
                  p.textContent= adrReg;
                  pp.appendChild(strong);
                  infowincontent.appendChild(pp);
                  //infowincontent.appendChild(document.createElement('br'));
                  infowincontent.appendChild(p);
                  var marker = new google.maps.Marker({
                    map: map,
                    position: point,
                    icon:'https://icons.iconarchive.com/icons/icons-land/vista-map-markers/48/Map-Marker-Marker-Outside-Azure-icon.png',
                    id: id,
                    name: name,
                    adrReg: adrReg
                  });
                  listMarkers.push(marker);
                  marker.addListener('click', function() {
                    infoWindow.setContent(infowincontent);
                    infoWindow.open(map, marker);
                  });
                  //supprimer marker
                  marker.addListener("dblclick", function() {
                    $('#delMark').val(marker.id);
                    verifEtat(marker);
                    /*var id = "#myModalsupp"+marker.id;
                    $(id).modal('show');*/
                  });
              });
          });
/*********************************************Add Marker******************************************/
    var geocoder = new google.maps.Geocoder();
    var image = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|00D900'
    //notez la présence de l'argument "event" entre les parenthèses de "function()"
    google.maps.event.addListener(map, 'click', function(event) {
      var newMarker = new google.maps.Marker({
        position: event.latLng,//coordonnée de la position du clic sur la carte
        map: map,//la carte sur laquelle le marqueur doit être affiché
        icon:'https://icons.iconarchive.com/icons/icons-land/vista-map-markers/48/Map-Marker-Marker-Outside-Chartreuse-icon.png',
      });
      var lat = event.latLng.lat();
      var lng = event.latLng.lng();
      newMarker.addListener("dblclick", function() {
        newMarker.setMap(null);
      });
      geocoder.geocode({
	    'latLng': event.latLng
	  }, function(results, status) {
	    if (status == google.maps.GeocoderStatus.OK) {
	      if (results[0]) {
	        nextStep(results[0].address_components[1].short_name , results[0].address_components[0].short_name);
	      }
	    }
	  });
      $(".tab").hide();
      currentTab = 0;
      showTab(currentTab); // Display the current tab
      document.getElementById("coordonees").innerHTML="Lat : "+lat+"&nbsp &nbsp &nbsp"+"Lng : "+lng;
      $('#lat').val(lat);
      $('#lng').val(lng);
      $('#nomM').val('');
      $('#myModal').modal('show');
    });
/*****************************************Fin Add Marker*******************************************/
// *****************************Geolocalisation********************************
       // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            infoWindow.setPosition(pos);
            infoWindow.setContent('Location found.');
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }  
// **************************FIN Geolocalisation********************************
        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });
        var markers1 = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();
          if (places.length == 0) {
            return;
          }
          // Clear out the old markers1.
          markers1.forEach(function(marker) {
            marker.setMap(null);
          });
          markers1 = [];
          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };
            // Create a marker for each place.
            markers1.push(new google.maps.Marker({
              map: map,
              icon: icon,
              title: place.name,
              position: place.geometry.location
            }));
            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
        });
      } //**************************** FIN INIT() *************************
      // Fct geolocalisation
      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
      }// fin fct geolocalisation
      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;
        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
      };
        request.open('GET', url, true);
        request.send(null);
      }
      function doNothing() {}
      function setNull(id)
      {
          listMarkers.forEach(function(markerE) {
            if (markerE.id == id) { markerE.setMap(null);}
          });
      }


function setIdFace(idF)
{
  var act = url+'/faces/'+idF;
  var formm = document.getElementById("formSuppFace");
  formm.setAttribute("action",act);
  /*'<form method="post" action="'+url+'/edit/'+idF+'">'+
    '{{ method_field('+'DELETE'+') }}'+
    '<div class="form-group">'+
    '<input type="hidden" name="_token" value="{{ csrf_token() }}">';
*/
}

function verifEtat(emp)
  {
    var btn = document.getElementById("btnModalSupp");
     btn.setAttribute("data-target","#myModalsupp"+emp.id);

    if(emp.etat == 2)
    {
      $('#ModalVerouiller').modal('show');
    }
    else{
    $.ajax({
        url: 'etat/'+emp.id,
        type: 'GET',
        success: function(response)
        {
          document.getElementById("ModalFacesBody").innerHTML="";
          document.getElementById("titreModalFace").innerHTML="Emplacement "+emp.name;
            
            response.forEach(function(face){
              var div = document.createElement("div");
              div.className = "well";
              if (face.etat == 0) {
                div.setAttribute("style","background-color: #ece7e7");
                div.innerHTML = "<b>Code: </b>"+face.codif+", <b>Support: </b>"+face.support+
              '     <button data-toggle="modal" href="#ModalFacesSupp" class="btn btn-success" style="float: right;" onclick="setIdFace('+face.id_face+')">Supprimer face</button>';
              }
              if (face.etat == 1) {
                div.setAttribute("style","background-color: #bfb8b8");
                div.innerHTML = "<b>Code: </b>"+face.codif+", <b>Support: </b>"+face.support;
              }
              
              document.getElementById("ModalFacesBody").append(div);
              
            });
            $('#ModalFaces').modal('show');
        },
        error: function()
        { 
            document.getElementById("ModalFacesBody").append("Auccune face");
            $('#ModalFaces').modal('show');
        }
    });//fin ajax
  }//fin else
}