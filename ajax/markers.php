<?php
error_reporting(0);
require '../dbcon.php';
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT DISTINCT farmer.nic,lat,lng,flag_code FROM harvest, farmer WHERE harvest.farmer_id=farmer.nic AND harvest.expiry_timestamp > NOW() ORDER BY harvest.date DESC,farmer_id";
$i=0;
$json= array();
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0){
  while($row = mysqli_fetch_assoc($result)) {
    $json[$i]->lat = $row['lat'];
    $json[$i]->lng = $row['lng'];
    $json[$i]->nic = $row['nic'];
    $json[$i]->flag = $row['flag_code'];
    $i+=1;
  }
}
echo json_encode($json);
mysqli_close($conn);


 ?>
