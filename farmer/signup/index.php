<?php
require '../../dbcon.php';
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

$sql = "INSERT INTO farmer (nic, name, mobile, address1, address2, email, lat, lng, district, password)
VALUES ('$nic', '$name', '$mobile', '$address1', '$address2', '$email', $lat, $lng, $district, '$psw')";

echo $sql;

if (mysqli_query($conn, $sql)) {
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
    <script type="text/javascript" src="map.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAI6bwkbJkNfAXK0kqSVi21V7Ll0CnUzOM&callback=initMap&libraries=&v=weekly"
      defer
    ></script>
    <!-- Display the countdown timer in an element -->

    <script>
    // Set the date we're counting down to
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
    <form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
      <label for="nic">National ID Number</label>
      <input type="text" name="nic" maxlength="12" value="" required>
      <br>
      <label for="name">Full Name</label>
      <input type="text" name="name" value="" required>
      <br>
      <label for="mobile">Mobile</label>
      <input type="text" maxlength="10" name="mobile" value="" placeholder="07xxxxxxxx" required>
      <br>
      <label for="address">Address</label>
      <input type="text" name="address1" value="" placeholder="1st Line" required>
      <input type="text" name="address2" value="" placeholder="2nd Line">
      <br>
      <label for="district">District</label>
      <select name="district">
        <?php
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        $sql = "SELECT id, district FROM district";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {

        while($row = mysqli_fetch_assoc($result)) {
        echo "<option value=".$row['id'].">".$row['district']."</option>";
          }
        }
        mysqli_close($conn);
         ?>
      </select>
      <br>
      <label for="email">Email</label>
      <input type="text" name="email" value="" placeholder="someone@email.com" >
      <br>
      <input id="lat" type="hidden" name="lat" value="">
      <input id="lng" type="hidden" name="lng" value="">
      <div id="map" style="height:400px;width:400px;"></div>
      <br>
      <label for="password">Password</label>
      <input type="text" value="">
      <br>
      <label for="cnfpassword">Confirm Password</label>
      <input type="text" name="psw" value="">
      <br>
      <input type="submit" name="submit" value="submit">
    </form>
  </body>
</html>
