<?php

require '../dbcon.php';
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT DISTINCT farmer.nic,lat,lng,flag_code FROM harvest, farmer WHERE harvest.farmer_id=farmer.nic AND harvest.expiry_timestamp > NOW() ORDER BY harvest.date DESC,farmer_id";

$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0){
  while($row = mysqli_fetch_assoc($result)) {
    echo "marker(".$row['lat'].", ".$row['lng']." , ".$row['nic'].",". $row['flag_code'] .");";
  }
}
mysqli_close($conn);


 ?>
