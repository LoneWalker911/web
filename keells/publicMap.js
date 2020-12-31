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
  document.getElementById("side-panel").innerHTML=info(1);
});
var content="<div class='map_info_wrapper'><div class='img_wrapper'><img src='veg.jpg'></div>"+"<br>"+

       "<div class='property_content_wrap'>"+
       "<div class='property_title'>"+
       "<span>FARMER NAME</span>"+
       "</div>"+

       "<div class='property_type'>"+
       "<span>Beans</span> <span>100KG</span> <span>Rs:150.00/KG</span>"+
       "</div>"+

       "<br>"+

       "<div class='property_listed_date'>"+
       "<span>Listed on 2020/02/26</span>"+
       "</div>"+
       "</div></div";
var infowindow = new google.maps.InfoWindow({
content:content
});

google.maps.event.addListener(mark, 'click', function() {
  if (activeInfoWindow) { activeInfoWindow.close();}
  infowindow.open(map,mark);
  activeInfoWindow = infowindow;
});
}
