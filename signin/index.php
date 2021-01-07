<?php
require '../dbcon.php';
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (isset($_POST['submit'])){
$uname = $_POST['username'];
$psw = $_POST['psw'];

$psw=md5($uname.$psw);

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
      header("Location:/web/doa");
      break;
    case "Keells":
      header("Location:/web/keells");
      break;
    case "Admin":
        header("Location:/web/admin");
        break;

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../forms.css">
    <title></title>

  </head>
  <body>
    <form class="form-signin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

      <h1 class="h3 mb-3 font-weight-normal">Sign In</h1>
      <label for="inputEmail" class="sr-only">National ID / Username</label>
      <input type="text" placeholder="Enter National ID / Username" name="username" class="form-control" required>

      <br>
      <label for="password" class="sr-only">Password</label>
      <input type="password" id="password" name="psw" class="form-control" placeholder="Password" required>
      <br>

      <div class="checkbox mb-3">
          <label>
          <input type="checkbox" name="rem" value="remember-me"> Remember me
        </label>
      </div>
          <button class="btn btn-lg btn-warning btn-block" type="reset">Clear</button>
          <button class="btn btn-lg btn-primary btn-block" name="submit" id="signbtn" type="submit">Sign in</button>
          <br>
          <p1>If you want to Register :<a>click here</a></p1>

  </form>
  </body>
</html>
