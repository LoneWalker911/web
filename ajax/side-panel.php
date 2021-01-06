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
  $img .= "<div class='mySlides1 fade1'>
    <div class='numbertext'>1 / 3</div>
    <img src='". $pic1 ."' style='width:100%''>
    <div class='text'>Caption Text</div>
  </div>";
  $span .= "<span class='dot' onclick='currentSlide($imgcount)'></span>";
  $imgcount++;
}
if($pic2!="")
{
  $img .= "<div class='mySlides1 fade1'>
    <div class='numbertext'>1 / 3</div>
    <img src='". $pic2 ."' style='width:100%''>
    <div class='text'>Caption Text</div>
  </div>";
  $span .= "<span class='dot' onclick='currentSlide($imgcount)'></span>";
  $imgcount++;
}
if($pic3!="")
{
  $img .= "<div class='mySlides1 fade1'>
    <div class='numbertext'>1 / 3</div>
    <img src='". $pic3 ."' style='width:100%''>
    <div class='text'>Caption Text</div>
  </div>";
  $span .= "<span class='dot' onclick='currentSlide($imgcount)'></span>";
  $imgcount++;
}
if($pic4!="")
{
  $img .= "<div class='mySlides1 fade1'>
    <div class='numbertext'>1 / 3</div>
    <img src='". $pic4 ."' style='width:100%''>
    <div class='text'>Caption Text</div>
  </div>";
  $span .= "<span class='dot' onclick='currentSlide($imgcount)'></span>";
  $imgcount++;
}
if($pic5!="")
{
  $img .= "<div class='mySlides1 fade1'>
    <div class='numbertext'>1 / 3</div>
    <img src='". $pic5 ."' style='width:100%''>
    <div class='text'>Caption Text</div>
  </div>";
  $span .= "<span class='dot' onclick='currentSlide($imgcount)'></span>";
  $imgcount++;
}

 ?>

  <?php echo $img; ?>

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
