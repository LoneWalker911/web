<?php
require '../dbcon.php';
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
$conn = mysqli_connect($servername, $username, $password, $dbname);
$id = $_GET['id'];

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT harvest.id,crop.crop_type,qty_kg,price,picture_1,date FROM harvest, crop WHERE harvest.crop_type_id=crop.id AND harvest.farmer_id='$id' AND harvest.expiry_timestamp > NOW() ORDER BY farmer_id,date desc";

$result = mysqli_query($conn, $sql);
$temp_id="";
if (mysqli_num_rows($result) > 0){
  $row = mysqli_fetch_assoc($result);
  $pic = $row['picture_1'];
  $date = date("d.m.y", strtotime($row["date"]));
    echo "<div class='item'>";
      echo "<div class='testimony-wrap text-center py-4 pb-5 infopadding'>";
        echo "<div class='user-img'style='background-image:url($pic)'>";
      echo "</div>";
      echo "<div class='text px-4 pb-5'>";
      echo "<p class='mb-4' onClick='FetchSide(".$row['id'].");'><span>".$row['crop_type']."</span> <span>".$row["qty_kg"]."kg</span> <span>Rs:".$row['price']."/KG</span></p>";
    while($row = mysqli_fetch_assoc($result)){
      echo "<p class='mb-4' onClick='FetchSide(".$row['id'].");'><span >".$row['crop_type']."</span> <span>".$row["qty_kg"]."kg</span> <span>Rs:".$row['price']."/KG</span></p>";
    }
          echo "<span class='position'>Listed-On :$date</span>";
        echo "</div>";
      echo "</div>";
    echo "</div>";

  }
  else {
    echo "<h3>INVALID</h3>";
  }

mysqli_close($conn);

 ?>
