function initMap() {
  const myLatlng = { lat: 7.85072, lng: 80.65716 };
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 8,
    center: myLatlng,
  });

  var marker=null;
  // Configure the click listener.
  map.addListener("click", (mapsMouseEvent) => {
    // Close the current Marker.
    if(marker!=null)marker.setMap(null);
    // Create a new Marker.
    marker = new google.maps.Marker({position: mapsMouseEvent.latLng,});
    marker.setMap(map);

    document.getElementById('lat').value=mapsMouseEvent.latLng.lat();
    document.getElementById('lng').value=mapsMouseEvent.latLng.lng();

  });
}
