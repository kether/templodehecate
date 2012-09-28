var map         = null;
var geocoder    = null;    

function tdhmap_load(latitud, longitud) {
  if (GBrowserIsCompatible()) {
    var map = new GMap2(document.getElementById("tdh_gmap"));
    point = new GLatLng(latitud, longitud);
    map.setCenter(point, 13);
          
    var marker = new GMarker(point);
    map.addOverlay(marker);
    map.addControl(new GSmallZoomControl());
  }
}
    
function tdhaddress_load(address) {
  if (GBrowserIsCompatible()) {
    var map = new GMap2(document.getElementById("tdh_gmap"));
    geocoder = new GClientGeocoder();
            
    geocoder.getLatLng(
      address,
      function(point) {
        if (!point) {
          point = new GLatLng(40.39601,-3.55102);
          map.setCenter(point, 4);
          var marker = new GMarker(point);
          map.addControl(new GSmallZoomControl());
        } else {
          map.setCenter(point, 13);
                        
          var marker = new GMarker(point);
          map.addOverlay(marker);
          map.addControl(new GSmallZoomControl());
        }
      }
    );
  }
}