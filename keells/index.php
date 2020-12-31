<?php
  require 'dbcon.php';
  include 'window/sidelist.php';
?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="publicMap.css">
<script src="publicMap.js"></script>

<body>

<div id="side-panel"></div>

<div id="googleMap" style="left:25%;top:0;height:100%;width:75%;position:absolute;"></div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAI6bwkbJkNfAXK0kqSVi21V7Ll0CnUzOM&callback=mainMap">
</script>

<script>
marker(7.85072,81.65716,5);




marker(7.95072,81.55716,"","<ul>HH<li>Huuu/ul>");
</script>



</body>
</html>
