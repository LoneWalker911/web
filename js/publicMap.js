var map;
var activeInfoWindow;


function mainMap() {
var mapProp= {
  center: new google.maps.LatLng(7.85072,80.65716),
  zoom:8.3,
  zoomControl: true,
  mapTypeControl: false,
  scaleControl: false,
  streetViewControl: false,
  rotateControl: false,
  fullscreenControl: false
}
map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
}

function info(id)
{
  //php server-> SELECT INFO WHERE ID = id -> info[30];

  var output="<h1 class='title'>info[0].toString();</h1>";

  return output;
}

function marker(lat,lon,id)
{
  var mark=new google.maps.Marker({position: new google.maps.LatLng(lat, lon)});
  mark.setMap(map);

  google.maps.event.addListener(mark,'click',function() {
  map.setCenter(mark.getPosition());
  map.setZoom(9);

  var infowindow = new google.maps.InfoWindow({
  content:"<p class'loading-txt'>Loading...</p>",
  //maxWidth: 200
  }
  );
  if (activeInfoWindow) { activeInfoWindow.close();}
  infowindow.open(map,mark);
  activeInfoWindow = infowindow;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      infowindow.setContent(this.responseText);
    }
  };
  xmlhttp.open("GET", "//localhost/web/ajax/infowindow.php?id=" + id, true);
  xmlhttp.send();
});

google.maps.event.addListener(map,'click',function() {
activeInfoWindow.close();
});
}
