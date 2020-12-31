<?php
require '../dbcon.php';
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (isset($_POST['submit'])){
$uname = $_POST['username'];
$psw = $_POST['psw'];

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
      header("Location:/web/signin");
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

  }
}

}

if(isset($_COOKIE['usr'])) {
  $string=$_COOKIE['usr'];
  $sql = "SELECT user_type.type,exptime FROM login,user_type WHERE loginstring='$string' AND login.user_type_id=user_type.id";

  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {

  while($row = mysqli_fetch_assoc($result)) {
  if((double)$row['exptime']>time())
  {
    switch ($row['type']) {
    case "Farmer":
      header("Location:/web/farmer");
      break;
    case "DoA":
      echo "Your favorite color is blue!";
      break;
    case "Keells":
      echo "Your favorite color is green!";
      break;
    default:
      echo "Your favorite color is neither red, blue, nor green!";
  }

    }
    else {
      setcookie("usr", "", time() - 1800, "/");
    }
  }

}else {
  setcookie("usr", "", time() - 1800, "/");
}}
 mysqli_close($conn);
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
    <a href="/web/farmer/signup">
    <button type="button" name="button">Signup</button></a>
  </body>
</html>
