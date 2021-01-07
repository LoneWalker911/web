<?php
require '../dbcon.php';
if($_GET['func']=="farmer_check"){
$conn = mysqli_connect($servername, $username, $password, $dbname);
$loginstring = htmlspecialchars($_COOKIE['usr']);
$uname="";

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
$sql1 = "SELECT username FROM login WHERE loginstring = '$loginstring'";

$result = mysqli_query($conn, $sql1);
if (mysqli_num_rows($result) > 0){
  while($row = mysqli_fetch_assoc($result))
  {
    $uname = $row['username'];
    $sql2 = "SELECT sender,receiver,message,timestamp FROM message WHERE sender = '$uname' OR receiver ='$uname' ORDER BY timestamp ASC";
  }
  $result = mysqli_query($conn, $sql2);
  if (mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result))
    {
      $date=date('F j', strtotime($row['timestamp']));
      if($row['sender']==$uname)
      {
        echo "<div class='outgoing_msg'>";
        echo  "<div class='sent_msg'>";
        echo    "<p>".$row['message']."</p>";
        echo    "<span class='time_date'> ".date('g:i A', strtotime($row['timestamp']))."    |    ".$date."</span> </div>";
        echo  "</div>";
      }
      if($row['receiver']==$uname)
      {
        echo "<div class='incoming_msg'>";
        echo "<div class='incoming_msg_img'> <span class='badge badge-success'>".$row['sender']."</span> </div>";
        echo  "<div class='received_msg'>";
        echo "<div class='received_withd_msg'>";
        echo    "<p>".$row['message']."</p>";
        echo    "<span class='time_date'> ".date('g:i A', strtotime($row['timestamp']))."    |    ".$date."</span> </div>";
        echo  "</div></div>";
      }
    }
  }
} else {
  echo "<script> if(confirm('Your session has expired. Please login again to continue')) window.location.href = 'http://localhost/web/signin';</script>";
}
mysqli_close($conn);
}

if($_GET['func']=="farmer_send"){
$loginstring = htmlspecialchars($_COOKIE['usr']);
$uname="";
$msg = $_GET['message'];

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql1 = "SELECT username FROM login WHERE loginstring = '$loginstring'";

$result = mysqli_query($conn, $sql1);
if (mysqli_num_rows($result) > 0){
  $row = mysqli_fetch_assoc($result);
  $uname = $row['username'];
}

$sql = "INSERT INTO message (sender, message)
VALUES ('$uname', '$msg')";

if (mysqli_query($conn, $sql))
{
  echo 1;
}
else {
  echo 0;
}
}

if($_GET['func']=="keells_check"){
$conn = mysqli_connect($servername, $username, $password, $dbname);
$id = htmlspecialchars($_GET['id']);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT sender,receiver,message,timestamp FROM message WHERE sender = '$id' OR receiver ='$id' ORDER BY timestamp ASC";

  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result))
    {
      $date=date('F j', strtotime($row['timestamp']));
      if($row['receiver']=="")
      {
        echo "<div class='incoming_msg'>";
        echo "<div class='incoming_msg_img'></div>";
        echo  "<div class='received_msg'>";
        echo "<div class='received_withd_msg'>";
        echo    "<p>".$row['message']."</p>";
        echo    "<span class='time_date'> ".date('g:i A', strtotime($row['timestamp']))."    |    ".$date."</span> </div>";
        echo  "</div></div>";
      }
      else {
        echo "<div class='outgoing_msg'>";
        echo  "<div class='sent_msg'>";
        echo "<span class='badge badge-success'>".$row['sender']."</span>";
        echo    "<p>".$row['message']."</p>";
        echo    "<span class='time_date'> ".date('g:i A', strtotime($row['timestamp']))."    |    ".$date."</span> </div>";
        echo  "</div>";
      }
    }
  }
 else {
  echo "<script> if(confirm('Your session has expired. Please login again to continue')) window.location.href = 'http://localhost/web/signin';</script>";
}
mysqli_close($conn);
}

 ?>
