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

function FetchSide(id)
{
  var xhttp;
  document.getElementById("side").innerHTML = "<p class'loading-txt'>Loading...</p>";
  if (id == 0) {
    document.getElementById("side").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("side").innerHTML = this.responseText;
    showSlides1(slideIndex);
    }
  };
  xhttp.open("GET", "//localhost/web/ajax/side-panel.php?id="+id, true);
  xhttp.send();
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
  maxWidth: 200
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
}
