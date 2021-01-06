<?php
require '../dbcon.php';
$conn = mysqli_connect($servername, $username, $password, $dbname);
$id = $_GET['id'];

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT harvest.id,crop.crop_type,qty_kg,price,picture_1,date FROM harvest, crop WHERE harvest.crop_type_id=crop.id AND harvest.farmer_id=$id AND harvest.expiry_timestamp > NOW() ORDER BY farmer_id,date desc";

$result = mysqli_query($conn, $sql);
$temp_id="";
if (mysqli_num_rows($result) > 0){
  $row = mysqli_fetch_assoc($result);
  $pic = $row['picture_1'];
  $date = date("d.m.y", strtotime($row["date"]));
    echo "<div class='map_info_wrapper'>";
      echo "<div class='img_wrapper'>";
        echo "<img src='$pic'>";
      echo "</div>";
      echo "<br>";
      echo "<div class='property_content_wrap'>";
        echo "<div class='property_type'>";
          echo "<div onClick='FetchSide(".$row['id'].");'><span>".$row['crop_type']."</span> <span>".date("d.m.y", strtotime($row["qty_kg"]))."kg</span> <span>Rs:".$row['price']."/KG</span></div>";
    while($row = mysqli_fetch_assoc($result)){
      echo "<div onClick='FetchSide(".$row['id'].");'><span>".$row['crop_type']."</span> <span>".date("d.m.y", strtotime($row["qty_kg"]))."</span> <span>Rs:".$row['price']."/KG</span></div>";
    }
        echo "</div>";
        echo "<br>";
        echo "<div class='property_listed_date'>";
          echo "<span>Listed on $date</span>";
        echo "</div>";
      echo "</div>";
    echo "</div>";

  }
  else {
    echo "<h3>INVALID</h3>";
  }

mysqli_close($conn);

 ?>
