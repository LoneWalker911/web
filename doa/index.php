<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <script type="text/javascript" src="publicMap.js">
    </script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" >
    <link rel="stylesheet" type="text/css" href="test.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style media="screen">
    .map_info_wrapper{
        box-shadow:none;
        color:#515151;
        font-family: "Georgia", "Open Sans", Sans-serif;
        text-align: center;
        width: 100% !important;
        border-radius: 0;
        left: 0 !important;
        top: 20px !important;
    }

     #propertymap .gm-style-iw > div > div{
        background: #FFF!important;
    }

    .img_wrapper {
        height: 150px;
        overflow: hidden;
        width: 100%;
        text-align: center;
        margin: 0px auto;
    }

    .img_wrapper > img {
        width: 100%;
        height:auto;
    }

    .property_content_wrap {
        padding: 0px 0px;
    }

    .property_title{
        min-height: auto;
        font-weight: bold;
    }
    .property_listed_date{
      font-style: italic;
      font-size: 12px;
    }
    .property_type{
      word-spacing: 10px;
      font-weight: bold;
    }
    </style>
    <link rel="stylesheet" type="text/css" href="/navbar/footer.css">
    <link rel="stylesheet" type="text/css" href="/navbar/nav.css">
    <title></title>
  </head>
  <body>
    <?php include 'sidelist.php'; ?>
    <div class="navigation">
      <ul class="nav1">

        <li class="a"><a class="nav" href="#">About</a></li>
        <li class="a"><a class="nav" href="#">Portfolio</a></li>
        <img src="https://essstr.blob.core.windows.net/uiimg/keellslogo.png" width="50%">
        <li class="a"><a class="nav" href="#">Blog</a></li>
        <li class="a"><a class="nav" href="#">Contact</a></li>

    </ul>
    </div>
<div id="side" class="infolist"></div>

<div class="slideshow-container">

<div class="mySlides fade">
  <div class="numbertext">1 / 3</div>
  <img src="veg.jpg" style="width:100%;height:350px">
  <div class="text">Caption Text</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">2 / 3</div>
  <img src="veg2.jpg" style="width:100%;height:350px">
  <div class="text">Caption Two</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">3 / 3</div>
  <img src="veg3.jpg" style="width:100%;height:350px">
  <div class="text">Caption Three</div>
</div>
</div>
<br>

<p id='test'></p>

<div class="responsive">
  <div id="googleMap"></div>
</div>



<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAI6bwkbJkNfAXK0kqSVi21V7Ll0CnUzOM&callback=mainMap">
</script>
<script>
<?php
require '../dbcon.php';
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT DISTINCT farmer.nic,lat,lng FROM harvest, farmer WHERE harvest.farmer_id=farmer.nic AND harvest.expiry_timestamp > NOW() ORDER BY harvest.date DESC,farmer_id";

$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0){
  while($row = mysqli_fetch_assoc($result)) {
    echo "marker(".$row['lat'].", ".$row['lng']." , ".$row['nic']." );";
  }
}
mysqli_close($conn);

 ?>
</script>
<div class="rownews">
  <div class="column1" style="background-color:#aaa;">
    <h2>Column 1</h2>
    <p>Some text..</p>
  </div>
  <div class="column1" style="background-color:#bbb;">
    <h2>Column 2</h2>
    <p>Some text..</p>
  </div>
  <div class="column1" style="background-color:#ccc;">
    <h2>Column 3</h2>
    <p>Some text..</p>
  </div>
  <div class="column1" style="background-color:#ddd;">
    <h2>Column 4</h2>
    <p>Some text..</p>
  </div>
</div>


<?php include 'footer.php'; ?>

<script type="text/javascript">
var slideIndex = 0;
var slideIndex1 = 1;

showSlides(slideIndex);

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}
  slides[slideIndex-1].style.display = "block";
  setTimeout(showSlides, 2000); // Change image every 2 seconds
}


// Next/previous controls
function plusSlides(n) {
  showSlides1(slideIndex1 += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides1(slideIndex1 = n);
}

function showSlides1(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides1");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex1 = 1}
  if (n < 1) {slideIndex1 = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex1-1].style.display = "block";
  dots[slideIndex1-1].className += " active";
}
</script>

  </body>
</html>
