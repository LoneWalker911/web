<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" >
<script type="text/javascript">
var slideIndex=1;

// Next/previous controls
function plusSlides(n) {
showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
showSlides(slideIndex = n);
}

function showSlides(n) {
var i;
var slides = document.getElementsByClassName("mySlides");
var dots = document.getElementsByClassName("dot");
if (n > slides.length) {slideIndex = 1}
if (n < 1) {slideIndex = slides.length}
for (i = 0; i < slides.length; i++) {
slides[i].style.display = "none";
}
for (i = 0; i < dots.length; i++) {
dots[i].className = dots[i].className.replace(" active", "");
}
slides[slideIndex-1].style.display = "block";
dots[slideIndex-1].className += " active";
}
</script>
<style media="screen">
* {box-sizing:border-box}

/* Slideshow container */
.slideshow-container {
  max-width: 1000px;
  position: relative;
  margin: auto;
}

/* Hide the images by default */
.mySlides {
  display: block;
}

/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  margin-top: -22px;
  padding: 16px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
}

/* Caption text */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active, .dot:hover {
  background-color: #717171;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4}
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4}
  to {opacity: 1}
}
}
</style>
<table style="width:25%">
  <tr>
    <td><div class="slideshow-container" style="max-width:800px">
<?php
require '../dbcon.php';
$conn = mysqli_connect($servername, $username, $password, $dbname);
$id = htmlspecialchars($_GET['id']);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT farmer.name,address1,address2,mobile,crop.crop_type,qty_kg,price,picture_1,picture_2,picture_3,picture_4,picture_5,date FROM harvest, crop, farmer WHERE harvest.crop_type_id=crop.id AND harvest.farmer_id=farmer.nic AND harvest.expiry_timestamp > NOW() AND harvest.id=$id";

$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0){
  while($row = mysqli_fetch_assoc($result))
  {
    $name = $row['name'];
    $mobile = $row['mobile'];
    $address = $row['address1'].$row['address2'];
    $crop = $row['crop_type'];
    $qty = $row['qty_kg'];
    $price = $row['price'];
    $pic1 = $row['picture_1'];
    $pic2 = $row['picture_2'];
    $pic3 = $row['picture_3'];
    $pic4 = $row['picture_4'];
    $pic5 = $row['picture_5'];
    $date = date("d/m/y", strtotime($row["date"]));
  }
}
$img="";
$span="";
$imgcount=1;
if($pic1!="")
{
  $img .= "<div class='mySlides fade'>
    <div class='numbertext'>1 / 3</div>
    <img src='". $pic1 ."' style='width:100%''>
    <div class='text'>Caption Text</div>
  </div>";
  $span .= "<span class='dot' onclick='currentSlide($imgcount)'></span>";
  $imgcount++;
}
if($pic2!="")
{
  $img .= "<div class='mySlides fade'>
    <div class='numbertext'>1 / 3</div>
    <img src='". $pic2 ."' style='width:100%''>
    <div class='text'>Caption Text</div>
  </div>";
  $span .= "<span class='dot' onclick='currentSlide($imgcount)'></span>";
  $imgcount++;
}
if($pic3!="")
{
  $img .= "<div class='mySlides fade'>
    <div class='numbertext'>1 / 3</div>
    <img src='". $pic3 ."' style='width:100%''>
    <div class='text'>Caption Text</div>
  </div>";
  $span .= "<span class='dot' onclick='currentSlide($imgcount)'></span>";
  $imgcount++;
}
if($pic4!="")
{
  $img .= "<div class='mySlides fade'>
    <div class='numbertext'>1 / 3</div>
    <img src='". $pic4 ."' style='width:100%''>
    <div class='text'>Caption Text</div>
  </div>";
  $span .= "<span class='dot' onclick='currentSlide($imgcount)'></span>";
  $imgcount++;
}
if($pic5!="")
{
  $img .= "<div class='mySlides fade'>
    <div class='numbertext'>1 / 3</div>
    <img src='". $pic5 ."' style='width:100%''>
    <div class='text'>Caption Text</div>
  </div>";
  $span .= "<span class='dot' onclick='currentSlide($imgcount)'></span>";
  $imgcount++;
}

 echo $img; ?>

  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
  <a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>
<br>
<div style="text-align:center">
    <?php echo $span; ?>
</div>
</td>
        </tr>
        <tr>
          <td><div class="FName"><?php echo $name; ?></td>
        </tr>
        <tr>
          <td><div class="listdate">Listed on <?php echo $date; ?></td>
        </tr>
        <tr><td><div class="aaaa">
            <br>
        </div></td>
        </tr>
        <tr>
          <td><div class="Harvesttype"><li><?php echo "$crop $qty Rs:$price/kg" ?></li></div></td>
        </tr>
        <tr><td><div class="aaaa">
            <br>
        </div></td>
        </tr>
        <tr>
          <td><div class="Address"><i class="material-icons">&#xe55f;</i><?php echo $address ?></div></td>
        </tr>
        <tr>
          <td><div class="phone"><i class="material-icons">&#xe551;</i><?php echo $mobile; ?></div></td>
        </tr>
        <tr>

          <td><div class="message"><br><br><button class="messagebtn">MESSAGE</button></td>
        </tr>
      </table>
    </div>
    <script type="text/javascript">
    var slideIndex = 1;
    showSlides(slideIndex);
    </script>
