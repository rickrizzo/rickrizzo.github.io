//Variables
var initialLocation = new google.maps.LatLng(40.69847032728747, -73.9514422416687);
var browserSupportFlag;
var map;

//Initialize Map
function initialize() {
	var options = {
		zoom: 20
	}
	map = new google.maps.Map(document.getElementById("map-canvas"), options);

	// Try W3C Geolocation (Preferred)
  if(navigator.geolocation) {
    browserSupportFlag = true;
    navigator.geolocation.getCurrentPosition(function (position) {
      initialLocation = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
      map.setCenter(initialLocation);
    }, function() {
      handleNoGeolocation(browserSupportFlag);
    });
  } else {
    browserSupportFlag = false;
    handleNoGeolocation(browserSupportFlag);
  }

  //Handle Errors
  function handleNoGeolocation(errorFlag) {
    if (errorFlag == true) {
      window.alert("Geolocation service failed.");
      //initialLocation = newyork;
    } else {
      window.alert("Your browser doesn't support geolocation. We've placed you in Siberia.");
      //initialLocation = siberia;
    }
    map.setCenter(initialLocation);
  }
}

//Add Markers
function getLocation() {
	if (browserSupportFlag) {
		var pos;
		//alert("hello");
		navigator.getLocation.getCurrentPosition(
			function (position){
				pos = new new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
				alert(pos);
			}
		);

		var marker = new google.maps.Marker({position: pos, title: "Marker"});
		marker.setMap(map);
	}
}

//On Page Load
google.maps.event.addDomListener(window, 'load', initialize);