<?php
require '../../dbcon.php';
if (isset($_POST['submit'])){
// $name = $_POST['name'];
// $uname = $_POST['uname'];
// $mobile = $_POST['mobile'];
// $address1 = $_POST['address'];
// $email = $_POST['email'];
// $psw = $_POST['psw'];
// $type = $_POST['type'];
//
// $conn = mysqli_connect($servername, $username, $password, $dbname);
//
// if (!$conn) {
//   die("Connection failed: " . mysqli_connect_error());
// }
//
// $sql = "INSERT INTO staff (name, mobile, address, type, email, password)
// VALUES ('$name', '$mobile', '$address', $type '$email', '$psw')";
//
// $sql2 = "INSERT INTO login (username, password, user_type_id, user_id)
// VALUES ('$nic', '$psw', 3, '$nic')";
//
// if (mysqli_query($conn, $sql) && mysqli_query($conn, $sql2)) {
//   $pass=true;
// } else {
//   echo "Error: " . $sql . "<br>" . mysqli_error($conn);
// }
//
// mysqli_close($conn);
}

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <style media="screen">
    .no-arrow {
      -moz-appearance: textfield;
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
              document.forms["addStaff"]["uname"].disabled=true;
              document.getElementById('chkbtn').disabled=true;
              document.getElementById('submit').disabled=false;
              document.getElementById('error').innerHTML="";
            }
            else {
              document.forms["addStaff"]["uname"].disabled=false;
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
        document.forms["addStaff"]["uname"].disabled=false;
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
      }
    </script>
    <title>Add Staff</title>
  </head>
  <body>
    <form name="addStaff" class="form" onsubmit="return Validate();" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
      <input type="radio" id="keells" name="type" value="1">
      <label for="keells">Keells</label>
      <input type="radio" id="DoA" name="type" value="2">
      <label for="DoA">DoA</label>
      <br>
      <label >Name</label>
      <input type="text" name="name" value="" required>
      <br>
      <label>Username</label>
      <input type="text" name="uname" value="" required>
      <button type="button" id="chkbtn" onclick="unameCheck();">Check availability</button>
      <br>
      <label for="mobile">Mobile</label>
      <input class="no-arrow" type="number" pattern="[0-9]{10}" name="mobile" value="" placeholder="07xxxxxxxx" required >
      <br>
      <label for="address">Address</label>
      <input type="text" name="address" value="" required>
      <br>
      <label for="email">Email</label>
      <input type="text" name="email" value="" placeholder="someone@email.com" required>
      <br>
      <label for="password">Password</label>
      <input type="password" name="psw" value="" required>
      <br>
      <p id="error"></p>
      <input type="submit" id="submit" disabled name="Submit" value="submit">
      <input type="reset" name="" onclick="Reset();" value="Clear">
    </form>
  </body>
</html>
