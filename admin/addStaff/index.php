<?php
require '../../dbcon.php';
if (isset($_POST['submit'])){
$name = $_POST['name'];
$uname = $_POST['uname'];
$mobile = $_POST['mobile'];
$address = $_POST['address'];
$email = $_POST['email'];
$psw = $_POST['psw'];
$type = $_POST['type'];

$psw=md5($uname.$psw);


$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO staff (name, mobile, address, type, email)
VALUES ('$name', '$mobile', '$address', $type, '$email')";

if (mysqli_query($conn, $sql)) $last_id = mysqli_insert_id($conn); else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

$sql2 = "INSERT INTO login (username, password, user_type_id, user_id)
VALUES ('$uname', '$psw', $type, '$last_id')";

if (mysqli_query($conn, $sql2)){
  echo "<p class='pass'>User successfully added to the database.</p>";
}else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
}
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">

    <style media="screen">
    .no-arrow {
      -moz-appearance: textfield;s
    }
    .no-arrow::-webkit-inner-spin-button {
      display: none;
    }
    .no-arrow::-webkit-outer-spin-button,
    .no-arrow::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
    </style>
    <script type="text/javascript">
      function unameCheck() {
        var str = document.forms["addStaff"]["uname"].value;
        var patt = /(^\d{12}$)|(^\d{9}.$)|(\s)|(\0)|(<(.|\n)+?>)/i;
        if(patt.test(str)||str.length<8)
        {
          document.getElementById('error').innerHTML="Invalid username. Please try again";
          return;
        }
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            if(this.responseText==1){
              document.forms["addStaff"]["uname"].readonly=true;
              document.getElementById('chkbtn').disabled=true;
              document.getElementById('submit').disabled=false;
              document.getElementById('error').innerHTML="";
            }
            else {
              document.forms["addStaff"]["uname"].readonly=false;
              document.getElementById('submit').disabled=true;
              document.getElementById('chkbtn').disabled=false;
              document.getElementById('error').innerHTML="Username already exists please try again";
            }
          }
        };
        xmlhttp.open("GET", "//localhost/web/ajax/usernamecheck.php?uname=" + str, true);
        xmlhttp.send();
      }

      function Reset(){
        document.forms["addStaff"]["uname"].readonly=false;
        document.getElementById('chkbtn').disabled=false;
        document.forms["addStaff"]["submit"].disabled=true;
        document.getElementById('error').innerHTML="";
      }

      function Validate(){
        if(document.forms["addStaff"]["type"].value==""){
          document.getElementById('error').innerHTML="Please select staff type.";
          return false;
          }

        var str = document.forms["addStaff"]["uname"].value;
        var patt = /(^\d{12}$)|(^\d{9}.$)|(\s)|(\0)|(<(.|\n)+?>)/i;
        if(patt.test(str)||str.length<8)
        {
          document.getElementById('error').innerHTML="Invalid username. Please try again";
          return false;
        }

        var str = document.forms["addStaff"]["name"].value;
        var patt = /^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/g;
        if(!patt.test(str))
        {
          document.getElementById('error').innerHTML="Invalid name. Please try again";
          return false;
        }

        var str = document.forms["addStaff"]["mobile"].value;
        var patt = /[0-9]{10}/g;
        if(!patt.test(str))
        {
          document.getElementById('error').innerHTML="Invalid mobile number. Please try again";
          return false;
        }

        var str = document.forms["addStaff"]["address"].value;
        var patt = /<(.|\n)+?>/g;
        if(patt.test(str))
        {
          document.getElementById('error').innerHTML="Invalid address. Please try again";
          return false;
        }

        var str = document.forms["addStaff"]["email"].value;
        var patt = /^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i;
        if(!patt.test(str))
        {
          document.getElementById('error').innerHTML="Invalid email address. Please try again";
          return false;
        }

        var str = document.forms["addStaff"]["psw"].value;
        var patt = /<(.|\n)+?>/i;
        if(patt.test(str))
        {
          document.getElementById('error').innerHTML="Invalid password. Please try again";
          return false;
        }
      }
    </script>
    <title>Add Staff</title>
    <link rel="shortcut icon" href="https://www.keellssuper.com/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/web/forms.css">
  </head>
  <body>
    <form name="addStaff" class="form-addStaff" onsubmit="return Validate();" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
        <h1 class="h3 mb-3 font-weight-normal">ADD STAFF</h1>
      <input type="radio"  id="keells" name="type" value="1">
      <label class="sr-only" for="keells">Keells</label>
      <input type="radio"  id="DoA" name="type" value="2">
      <label class="sr-only" for="DoA">DoA</label>
      <br>
      <label class="sr-only">Name</label>
      <input type="text" class="form-control" name="name" value="" required>
      <br>

      <label class="sr-only">Username</label>
      <div class="aabb">
        <input type="text" class="form-control usetext" name="uname" value="" required><span style="padding-left:31px"></span>
        <button class="btn btn-lg btn-primary btn-block"  type="button" id="chkbtn" style="width:auto" onclick="unameCheck();">Check availability</button>
      </div>

      <br>
      <label for="mobile" class="sr-only">Mobile</label>
      <input class="no-arrow form-control" type="number" pattern="[0-9]{10}" name="mobile" value="" placeholder="07xxxxxxxx" required >
      <br>
      <label for="address" class="sr-only">Address</label>
      <input type="text" class="form-control" name="address" value="" required>
      <br>
      <label for="email" class="sr-only">Email</label>
      <input type="text" class="form-control" name="email" value="" placeholder="someone@email.com" required>
      <br>
      <label for="password" class="sr-only">Password</label>
      <input type="password" class="form-control" class="sr-only" name="psw" value="" required>
      <br>
      <p id="error"></p>
      <input type="reset" id="resbtn" class="btn btn-lg btn-warning btn-block" name="" onclick="Reset();" value="Clear">
      <input type="submit" id="submitbtn" class="btn btn-lg btn-primary btn-block" id="submit" disabled name="submit" value="Submit">
    </form>
  </body>
</html>
