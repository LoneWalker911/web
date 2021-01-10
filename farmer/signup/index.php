<?php
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if(isset($_COOKIE['usr'])) {
  $string=$_COOKIE['usr'];
  $conn = mysqli_connect($servername, $username, $password, $dbname);
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
}
mysqli_close($conn);
}

require '../../dbcon.php';
$pass=false;
if (isset($_POST['submit'])){
$nic = test_input($_POST['nic']);

$exp="/^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/";
if(preg_match($exp,$_POST['name']))
$name = test_input($_POST['name']);
else return;

$mobile = test_input($_POST['mobile']);
$address1 = test_input($_POST['address1']);
$address2 = test_input($_POST['address2']);
$district = test_input($_POST['district']);
$email = test_input($_POST['email']);

$psw = test_input($_POST['psw']);

$exp="/^\d[0-9]*.[0-9]*/";
if(preg_match($exp,$_POST['lat'])&&preg_match($exp,$_POST['lng'])){
$lat = test_input($_POST['lat']);
$lng = test_input($_POST['lng']);}
else return;



$psw = md5($nic.$psw);

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO farmer (nic, name, mobile, address1, address2, email, lat, lng, district)
VALUES ('$nic', '$name', '$mobile', '$address1', '$address2', '$email', $lat, $lng, $district); INSERT INTO login (username, password, user_type_id, user_id)
VALUES ('$nic', '$psw', 3, '$nic')";


if (mysqli_query($conn, $sql)&&mysqli_affected_rows($conn)>0){
  $pass=true;
}
else {
  $pass=false;
}


mysqli_close($conn);
}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="https://www.keellssuper.com/favicon.ico">
    <title>Farmer Registration - Keells Agri</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../forms.css">
    <script type="text/javascript" src="map.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAI6bwkbJkNfAXK0kqSVi21V7Ll0CnUzOM&callback=initMap&libraries=&v=weekly"
      defer
    ></script>

    <script>
    function timer(){
    var countDownDate = new Date().getTime()+5000;
    document.getElementById("timer").style.display = "block";
    // Update the count down every 1 second
    var x = setInterval(function() {

      // Get today's date and time
      var now = new Date().getTime();

      // Find the distance between now and the count down date
      var distance = countDownDate - now;

      // Time calculations for days, hours, minutes and seconds
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);


      // Display the result in the element with id="demo"
      document.getElementById("timer").innerHTML = "Your account has successfully created. Redirecting you to sign in page in " + seconds + "";

      // If the count down is finished, write some text
      if (distance < 0) {
        clearInterval(x);
        document.getElementById("timer").innerHTML = "If the page did't redirect you to automatically please <a href=''>click here</a>";
        window.location.href = "http://localhost/web/signin";
      }
    }, 1000);
    }
</script>
  </head>
  <body>
    <p id="timer" style="display:none;"></p>
    <?php if($pass) echo "<script>timer();</script>"; ?>
    <form class="form-signin" name="upform" onsubmit="return validate();" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

            <h1 class="h3 mb-3 font-weight-normal">Sign Up</h1>

            <label for="inputEmail" class="sr-only">National ID</label>
            <input type="text" placeholder="National ID" name="nic" class="form-control" required autofocus>
            <br>

            <label for="inputFname" class="sr-only">Full Name</label>
            <input type="text" placeholder="Full Name " name="name" class="form-control" required>
            <br>

            <label for="inputmobile" class="sr-only">Mobile</label>
            <input type="text" placeholder="Mobile" name="mobile" class="form-control" required>
            <br>

            <label for="inputaddress" class="sr-only">Address</label>
            <input type="text" placeholder="1st Line" name="address1" class="form-control" required>
            <br>
            <input type="text" placeholder="2nd Line" name="address2" class="form-control" required>
            <br>

            <label for="inputdistrict" class="sr-only">District</label><br>
            <select name="district" class="district01">
        <?php
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        $sql = "SELECT id, district FROM district";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {

        while($row = mysqli_fetch_assoc($result)) {
        echo "<option value=".$row['id'].">".$row['district']."</option>";
          }
        }
        else {
          echo "<option value=''>Database Connection Failed.</option>";
        }
        mysqli_close($conn);
         ?>
      </select>
            <br>
            <br>
            <label for="inputemail" class="sr-only">E-mail</label>
            <input type="text" placeholder="someone@gmail.com" name="email" class="form-control">
            <br>

            <input id="lat" type="hidden" name="lat" value="">
            <input id="lng" type="hidden" name="lng" value="">
            <div id="map" style="height:275px;width:auto;;"></div>
            <br>

            <label for="password" class="sr-only">Password</label>
            <input type="password"  id="password" class="form-control"  required>
            <br>

            <label for="cnfpassword" class="sr-only">Confirm Password</label>
            <input type="password" name="psw" id="confpassword" class="form-control"  required>
            <br>

            <button class="btn btn-lg btn-warning btn-block" type="reset">Clear</button>
            <button class="btn btn-lg btn-primary btn-block" class="submit" name="submit" id="signbtn" type="submit">Submit</button>

        </form>
        <script type="text/javascript">
          function validate()
          {
            var x = document.getElementById('lat').value;
            if (x == "") {
              alert("A location must be selected");
              return false;
            }
            var x = document.getElementById('password').value;
            var y = document.getElementById('confpassword').value;
            if (x != y) {
              alert("Unmached passwords.");
              return false;
            }
            var patt = /^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/;
            if(!patt.test(document.forms["upform"]["name"].value))
            return false;
          }
        </script>
  </body>
</html>
