<!-- IE Fixie -->
if (typeof window.console == 'undefined') {
    window.console = { log: function() {} };
}


var map;
var directionsDisplay;
var directionsService = null; // = new google.maps.DirectionsService();
var stepDisplay;
var markerArray = [];

var currentLocation;
var currentLocationMarker;


var chart = null; // elevation chart
var elevationService = null;
var SAMPLES = 256; // elevationのsample point数
var polyline = null;
var mousemarker = null;


// Load the Visualization API and the piechart package.
google.load("visualization", "1", {packages: ["columnchart"]});

// Set a callback to run when the Google Visualization API is loaded.
google.setOnLoadCallback(initialize);


var infowindow;

(function () {

  google.maps.Map.prototype.markers = new Array();
    
  google.maps.Map.prototype.addMarker = function(marker) {
    this.markers[this.markers.length] = marker;
  };
    
  google.maps.Map.prototype.getMarkers = function() {
    return this.markers
  };
    
  google.maps.Map.prototype.clearMarkers = function() {
    if(infowindow) {
      infowindow.close();
    }
    
    for(var i=0; i<this.markers.length; i++){
      this.markers[i].set_map(null);
    }
  };
})();


function initialize() {

    directionsService = new google.maps.DirectionsService();
    elevationService = new google.maps.ElevationService();


    // Create a map and center 
    var initialLocation = new google.maps.LatLng(35.33699895700634, 139.48775);
    var mapOptions = {
        zoom: 13,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        center: initialLocation
    }
    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);



    chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
    
    google.visualization.events.addListener(chart, 'onmouseover', function(e) {
        if (mousemarker == null) {
            mousemarker = new google.maps.Marker({
                position: elevations[e.row].location,
                map: map,
                icon: "http://maps.google.com/mapfiles/ms/icons/green-dot.png"
            });
        } else {
            mousemarker.setPosition(elevations[e.row].location);
        }
    });


    // Create a renderer for directions and bind it to the map.
    var rendererOptions = {
        map: map
    }
    directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions)

    // Instantiate an info window to hold step text.
    stepDisplay = new google.maps.InfoWindow();

    // disable button
    document.getElementById("btnGetCurrentLocation").disabled = true; 


    getCurrentLocation();

}

function showSteps(directionResult) {
  // For each step, place a marker, and add the text to the marker's
  // info window. Also attach the marker to an array so we
  // can keep track of it and remove it when calculating new
  // routes.
  var myRoute = directionResult.routes[0].legs[0];

  for (var i = 0; i < myRoute.steps.length; i++) {
    var marker = new google.maps.Marker({
      position: myRoute.steps[i].start_point,
      map: map
    });
    attachInstructionText(marker, i +'. ' + myRoute.steps[i].instructions);
    markerArray[i] = marker;
  }
}

function attachInstructionText(marker, text) {
    google.maps.event.addListener(marker, 'click', function() {


        // Open an info window when the marker is clicked on,
        // containing the text of the step.
        stepDisplay.setContent(text);
        stepDisplay.open(map, marker);
    });
}


function getCurrentLocation(){
    if (document.readyState !== "complete") { 
        return;
    }

    // disable button
//    document.getElementById("btnGetCurrentLocation").disabled = true; 

    if( currentLocationMarker != undefined ){
        currentLocationMarker.setMap(null);
    }
    if(navigator.geolocation) {
        browserSupportFlag = true;
        navigator.geolocation.getCurrentPosition(function(position) {    
            currentLocation = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);        
            // set marker 
            setCurrentLocationMarker( currentLocation );

        }, function() {
//            handleNoGeolocation(browserSupportFlag);
        });
        if( currentLocation == undefined )
            currentLocation = map.getCenter();
        
    }
    // Browser doesn't support Geolocation
    else {
        browserSupportFlag = false;
//        handleNoGeolocation(browserSupportFlag);
        currentLocation = new google.maps.LatLng(35.33699895700634, 139.48775);
        // set marker 
        setCurrentLocationMarker( currentLocation );
    }
  
    if( currentLocation ){  
        // set center
//        setCurrentLocationMarker( currentLocation );


    }
    
    
    
}


function setCurrentLocationMarker(  ){

    // disable button
//    document.getElementById("btnGetCurrentLocation").disabled = true; 

        map.setCenter( currentLocation );
        var image = './assets/you-are-here.png';

        // marker
        currentLocationMarker = new google.maps.Marker({
            position: currentLocation,
            title: 'You are here',
            map: map,
            icon: image,
            zIndex:10,
            draggable: true
        });

        // Add dragging event listeners.
        google.maps.event.addListener(currentLocationMarker, 'dragstart', function() {
        });

        google.maps.event.addListener(currentLocationMarker, 'drag', function() {
            currentLocation = currentLocationMarker.getPosition();
        });

        google.maps.event.addListener(currentLocationMarker, 'dragend', function() {
            currentLocation = currentLocationMarker.getPosition();
        });

        // re-enable button
        document.getElementById("btnGetCurrentLocation").disabled = false; 

}