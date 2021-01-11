<?php
include '../cookiechk.php';
require '../dbcon.php';
$conn = mysqli_connect($servername, $username, $password, $dbname);
$sql = "UPDATE login SET loginstring='', exptime='' WHERE loginstring='".$_COOKIE['usr']."'";
if(mysqli_query($conn, $sql)&&mysqli_affected_rows($conn)>0)
{
  setcookie("usr", "", time() - 1800, "/");
  header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
  echo 1;
}
else {
  echo 0;
}

 ?>
