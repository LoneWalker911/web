<?php
include '../cookiechk.php';
require '../dbcon.php';
$conn = mysqli_connect($servername, $username, $password, $dbname);
$sql = "UPDATE login SET loginstring=NULL, exptime='' WHERE loginstring='".$_COOKIE['usr']."'";
if(mysqli_query($conn, $sql)&&mysqli_affected_rows($conn)>0)
{
  setcookie("usr", "", time() - 1800, "/");
  echo 1;
}
else {
  echo 0;
}

 ?>
