<?php
// check cookie but do not redirect if a cookies is not found
require '../../dbcon.php';
$pass=false;
if (isset($_POST['submit'])){
$nic = $_POST['nic'];
$name = $_POST['name'];
$mobile = $_POST['mobile'];
$address1 = $_POST['address1'];
$address2 = $_POST['address2'];
$district = $_POST['district'];
$email = $_POST['email'];
$psw = $_POST['psw'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];


$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO farmer (nic, name, mobile, address1, address2, email, lat, lng, district)
VALUES ('$nic', '$name', '$mobile', '$address1', '$address2', '$email', $lat, $lng, $district)";

$sql2 = "INSERT INTO login (username, password, user_type_id, user_id)
VALUES ('$nic', '$psw', 3, '$nic')";

if (mysqli_query($conn, $sql)&&mysqli_query($conn, $sql2)) {
  $pass=true;
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Farmer Registration</title>
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

    // Update the count down every 1 second
    var x = setInterval(function() {

      // Get today's date and time
      var now = new Date().getTime();

      // Find the distance between now and the count down date
      var distance = countDownDate - now;

      // Time calculations for days, hours, minutes and seconds
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);
      document.getElementById("timer").style.display = "block";

      // Display the result in the element with id="demo"
      document.getElementById("timer").innerHTML = "Your account has successfully created. Redirecting you to sign in page in " + seconds + "";

      // If the count down is finished, write some text
      if (distance < 0) {
        clearInterval(x);
        document.getElementById("timer").innerHTML = "If the page did't redirect you to automatically please <a href=''>click here</a>";
      }
    }, 1000);
    }
</script>
  </head>
  <body>
    <p id="timer" style="display:none;"></p>
    <?php if($pass) echo "<script>timer();</script>"; ?>
    <form class="form-signin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

            <h1 class="h3 mb-3 font-weight-normal">Sign Up</h1>

            <label for="inputEmail" class="sr-only">National ID</label>
            <input type="text" placeholder="National ID" name="nic" class="form-control" required>
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
            <input type="text" placeholder="someone@gmail.com" name="email" class="form-control" required>
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
            <button class="btn btn-lg btn-primary btn-block" class="submit" id="signbtn" type="submit">Submit</button>

        </form>
  </body>
</html>
