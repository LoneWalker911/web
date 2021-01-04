<?php
  require 'dbcon.php';
  $user_type="";
  $login_username="";
  if(isset($_COOKIE['usr'])) {
    $string=$_COOKIE['usr'];
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $sql = "SELECT login.username,user_type.type,loginstring,exptime FROM login,user_type WHERE loginstring='$string' AND login.user_type_id=user_type.id";

    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {

    while($row = mysqli_fetch_assoc($result)) {
      $user_type=$row['type'];
      $login_username=$row['username'];
    if((double)$row['exptime']<time())
    {
      setcookie("usr", "", time() - 1800, "/");
      header("Location:/web/signin");
    }
      }
    }
    else
      header("Location:/web/signin");

    mysqli_close($conn);
  }
  else {
    header("Location:/web/signin");
  }

 ?>
