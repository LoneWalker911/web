<?php
  require 'dbcon.php';
  if(isset($_COOKIE['usr'])) {
    $string=$_COOKIE['usr'];
    echo "string";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $sql = "SELECT loginstring,exptime FROM login WHERE loginstring='$string'";

    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {

    while($row = mysqli_fetch_assoc($result)) {
    if((double)$row['exptime']<time())
    {
      setcookie("usr", "", time() - 1800, "/");
      header("Location:/web/signin");
    }
      }
    }
    mysqli_close($conn);
   }
   else {
    header("Location:/web/signin");
   }

 ?>
