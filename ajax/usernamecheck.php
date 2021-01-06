<?php
require '../dbcon.php';
$conn = mysqli_connect($servername, $username, $password, $dbname);
$uname = htmlspecialchars($_GET['uname']);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT 1 FROM login WHERE username='$uname'";

$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0){
  while($row = mysqli_fetch_assoc($result))
  {
    if($row['1']==1)
    echo 0;
    else {
      echo 1;
    }
  }
}
else echo 1;
