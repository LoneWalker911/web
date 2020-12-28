<?php
require '../dbcon.php';
if(isset($_COOKIE['usr'])) {
  $string=$_COOKIE['usr'];
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  $sql = "SELECT loginstring,exptime FROM login WHERE loginstring='$string'";

  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {

  while($row = mysqli_fetch_assoc($result)) {
  if((double)$row['exptime']>time())
  {
    echo "win";
  }
    }
  }
  mysqli_close($conn);
 }

if (isset($_POST['submit'])){
$uname = $_POST['username'];
$psw = $_POST['psw'];

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT 1 FROM login WHERE username='$uname' AND password='$psw'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {

while($row = mysqli_fetch_assoc($result)) {
if($row['1']==1)
{
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    do{
      $randomString = '';
    for ($i = 0; $i < 30; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    if(isset($_POST['rem']))
      $exptime=time()+(86400*7);
    else
      $exptime=time()+1800;
    $sql = "UPDATE login SET loginstring='$randomString', exptime='$exptime' WHERE username='$uname'";
    $pass=mysqli_query($conn, $sql);
  }while(!$pass);
    if ($pass) {
      setcookie("usr", $randomString, time() + (86400 * 30), "/");
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

  }
}
mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="/css/signin.css">
  </head>
  <body>
    <form class="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
      <label>National ID / Username</label>
      <input type="text" name="username" value="">
      <br>
      <label>Password</label>
      <input type="password" name="psw" value="">
      <br>
      <label>Remember</label>
      <input type="checkbox" name="rem" value="">
      <br>
      <input type="submit" name="submit" value="submit">

    </form>
  </body>
</html>
