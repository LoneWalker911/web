var map;
var activeInfoWindow;

function mainMap() {
var mapProp= {
  center: new google.maps.LatLng(7.85072,80.65716),
  zoom:8,
}
map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
}

function info(id)
{
  //php server-> SELECT INFO WHERE ID = id -> info[30];

  var output="<h1 class='title'>info[0].toString();</h1>";

  return output;
}

function marker(lat,lon,content,text)
{
  var mark=new google.maps.Marker({position: new google.maps.LatLng(lat, lon)});
  mark.setMap(map);

  google.maps.event.addListener(mark,'click',function() {
  map.setCenter(mark.getPosition());
  map.setZoom(9);
  document.getElementById("side-panel").innerHTML=info(id);
});

var infowindow = new google.maps.InfoWindow({
content:content
});

google.maps.event.addListener(mark, 'click', function() {
  if (activeInfoWindow) { activeInfoWindow.close();}
  infowindow.open(map,mark);
  activeInfoWindow = infowindow;
});
}
