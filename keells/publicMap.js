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
map = new google.maps.Map(document.getElementById("googleMap2"),mapProp);
}

var id;


function FetchSide(tid)
{
  id=tid;
  var xhttp;
  document.getElementById("side-list").innerHTML = "<p class'loading-txt'>Loading...</p>";
  if (id == 0) {
    document.getElementById("side-list").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("side-list").innerHTML = this.responseText;
    showDivs(slideIndex);
    }
  };
  xhttp.open("GET", "//localhost/web/newsidepanel.php?id="+tid, true);
  xhttp.send();
}

function FetchList()
{
  var xhttp;
  document.getElementById("side-list").innerHTML = "<p class'loading-txt'>Loading...</p>";
  if (id == 0) {
    document.getElementById("side-list").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("side-list").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "//localhost/web/navbar/sidelist.php", true);
  xhttp.send();
}

function ClearMarkers()
{
  markers.forEach((item, i) => {
    item.setMap(null);
  });
  markers.length=0;
}

function FetchMarkers()
{
  ClearMarkers();
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    var json = JSON.parse(this.responseText);
    console.log(json);
    for (var i = 0; i < json.length; i++) {
      marker (json[i]["lat"],json[i]["lng"],json[i]["nic"],json[i]["flag"]);
    }
    }
  };
  xhttp.open("GET", "//localhost/web/ajax/markers.php", true);
  xhttp.send();
}

var markers=[];

function marker(lat,lon,id,flag)
{
  var flagico;
  switch (flag) {
    case "1":flagico="greenflag.png";break;
    case "2":flagico="yellowflag.png";break;
    case "3":flagico="redflag.png";break;
  }
  var icon={url:"//localhost/web/images/"+flagico,scaledSize:new google.maps.Size(40, 40)};

  var mark=new google.maps.Marker({position: new google.maps.LatLng(lat, lon)});

  if(flag!="") mark.setIcon(icon);


  mark.setMap(map);

  google.maps.event.addListener(mark,'click',function() {
  map.setCenter(new google.maps.LatLng(mark.getPosition().lat()+0.7,mark.getPosition().lng()));
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
FetchMarkers();
FetchList();
});
markers.push(mark);
}


function emptyfunc(pp){
switch (pp) {
case 1:document.getElementById('ff').innerHTML="<p style=\"display:inline\" class='text-success'>Updated</p>";FetchMarkers();break;
case 0:document.getElementById('ff').innerHTML="<p style=\"display:inline\" class='text-danger'>Update Failed. Try Again.</p>";break;
}
}

function updateFlag(code)
{
document.getElementById('ff').innerHTML="<p style=\"display:inline\" class='text-info'>Updating...</p>";
var xhttp;
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (this.readyState == 4 && this.status == 200) {
  document.getElementsByClassName('greenflag')[0].id="";
  document.getElementsByClassName('yellflag')[0].id="";
  document.getElementsByClassName('redflag')[0].id="";
  switch (this.responseText) {
    case '1':document.getElementsByClassName('greenflag')[0].id="greenflag";emptyfunc(1);break;
    case '2':document.getElementsByClassName('yellflag')[0].id="yellflag";emptyfunc(1);break;
    case '3':document.getElementsByClassName('redflag')[0].id="redflag";emptyfunc(1);break;

    default:emptyfunc(0);
  }
}
};
xmlhttp.open("GET", "//localhost/web/ajax/panel-update.php?func=flagUpdate&id=" + id + "&code=" + code, true);
xmlhttp.send();
}

function reject()
{
document.getElementById('stat').innerHTML="<p style=\"display:inline\" class='text-info'>Updating...</p>";
var xhttp;
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (this.readyState == 4 && this.status == 200) {
  switch (this.responseText) {
    case '1':document.getElementById('stat').innerHTML="<p style=\"display:inline\" class='text-danger'>Rejected</p>";emptyfunc(1);break;
    case '0':document.getElementById('stat').innerHTML="<p style=\"display:inline\" class='text-danger'>Failed.</p>";emptyfunc(0);break;


    default:document.getElementById('stat').innerHTML="<p style=\"display:inline\" class='text-danger'>Rejection Process Failed.</p>";
  }
}
};
xmlhttp.open("GET", "//localhost/web/ajax/panel-update.php?func=reject&id=" + id, true);
xmlhttp.send();
}

function openMsg()
{
var xhttp;
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (this.readyState == 4 && this.status == 200) {
  window.open("//localhost/web/messages/keells?nic="+this.responseText);
  }

};
xmlhttp.open("GET", "//localhost/web/ajax/panel-update.php?func=findNic&id=" + id, true);
xmlhttp.send();
}

function Buy()
{
document.getElementById("edit").style.display = "block";
document.getElementById('details').innerHTML="<label for='qty'>Quantity</label> "+
    "<input type='text' value='Loading...'> <span>kg (Min. 1kg)</span> <br>"+
    "<label>Price</label> "+
    "<span>Rs.</span> <input type='text' value='Loading...' > <span>(per kg)</span><br><div id='noti'></div><br>"+
    "<button type='button' class='btn btn-primary btnbuy'>BUY</button> "+
    "<button type='button' class='btn btn-danger btncls' >CLOSE</button>";
var xhttp;
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (this.readyState == 4 && this.status == 200) {
  document.getElementById('details').innerHTML=this.responseText;
}
};
xmlhttp.open("GET", "//localhost/web/ajax/panel-update.php?func=buy&id=" + id, true);
xmlhttp.send();
}

function CnfBuy()
{
var qty = document.getElementById('qty').value;
var price = document.getElementById('price').value;
document.getElementById('noti').innerHTML="<p class='text-info'>Purchase Processing...</p>";
var xhttp;
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (this.readyState == 4 && this.status == 200) {
    if(this.responseText=="1"){
     document.getElementById('noti').innerHTML="<p class='text-success'>Purchase Complete</p>";
     document.getElementById('stat').innerHTML="<p style=\"display:inline\" class=\"text-success\">Purchased</p>"
     setTimeout(() => {  document.getElementById('edit').style.display='none'; document.getElementById('details').innerHTML=""; }, 2000);
    }

    else {
      document.getElementById('noti').innerHTML="<p class='text-danger'>Purchase Failed. Try Again.</p>";
      setTimeout(() => {  document.getElementById('edit').style.display='none'; document.getElementById('details').innerHTML=""; }, 2000);
    }
}
};
xmlhttp.open("GET", "//localhost/web/ajax/panel-update.php?func=cnfbuy&id=" + id + "&qty=" + qty + "&price=" + price, true);
xmlhttp.send();
}
var slideIndex = 1;

function plusDivs(n) {
showDivs(slideIndex += n);
}

function showDivs(n) {
var i;
var x = document.getElementsByClassName("mySlides");
if (n > x.length) {slideIndex = 1}
if (n < 1) {slideIndex = x.length}
for (i = 0; i < x.length; i++) {
 x[i].style.display = "none";
}
x[slideIndex-1].style.display = "block";
}
