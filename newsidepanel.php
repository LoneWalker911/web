<?php
//$url = "//".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
require 'cookiechk.php';
require '../../cookiechk.php';
if($user_type!="Keells"||$user_type!="Admin"||$user_type!="DoA")
exit;
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="//fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/ionicons.min.css">
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/side-panel-style.css">
    <title></title>
  </head>
  <body>

    <div class=" item ">
<div class="testimony-wrap text-center py-4 pb-5 ">
      <?php
      require 'dbcon.php';
      $conn = mysqli_connect($servername, $username, $password, $dbname);
      $id = 2;

      if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      }

      $sql = "SELECT farmer.name, address1, address2, mobile, crop.crop_type, qty_kg, price, picture_1, picture_2, picture_3, picture_4, picture_5, date, flag_code, status FROM harvest, crop, farmer WHERE harvest.crop_type_id=crop.id AND harvest.farmer_id=farmer.nic AND harvest.expiry_timestamp > NOW() AND harvest.id=$id";

      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result))
        {
          $name = $row['name'];
          $mobile = $row['mobile'];
          $address = $row['address1'].", ".$row['address2'];
          $crop = $row['crop_type'];
          $qty = $row['qty_kg'];
          $price = $row['price'];
          $flag= $row['flag_code'];
          $pic1 = $row['picture_1'];
          $pic2 = $row['picture_2'];
          $pic3 = $row['picture_3'];
          $pic4 = $row['picture_4'];
          $pic5 = $row['picture_5'];
          $status=$row['status'];
          $date = date("d/m/Y", strtotime($row["date"]));
        }
      }
      $img="";
      if($pic1!="")
      {
        $img .= "<div class=\"user-img sidepanelcss w3-display-container mySlides\" style=\"background-image: url(".$pic1.")\">";
      }
      if($pic2!="")
      {
        $img .= "<div class=\"user-img sidepanelcss w3-display-container mySlides\" style=\"background-image: url(".$pic2.")\">";
      }
      if($pic3!="")
      {
        $img .= "<div class=\"user-img sidepanelcss w3-display-container mySlides\" style=\"background-image: url(".$pic3.")\">";
      }
      if($pic4!="")
      {
        $img .= "<div class=\"user-img sidepanelcss w3-display-container mySlides\" style=\"background-image: url(".$pic4.")\">";
      }
      if($pic5!="")
      {
        $img .= "<div class=\"user-img sidepanelcss w3-display-container mySlides\" style=\"background-image: url(".$pic15.")\">";
      }

      echo $img;
      echo "<script>var id=".$id."</script>";
      ?>

      </div>
      <button class="w3-button w3-display-left w3-black" onclick="plusDivs(-1)">&#10094;</button>
      <button class="w3-button w3-display-right w3-black" onclick="plusDivs(1)">&#10095;</button>
      <div class="text px-4 pb-5">
      <p class="name farname"><?php echo $name; ?></p>
      <p class="mb-4"><li class="harvestdetail" style="font-size:5px" ><?php echo $crop; ?><span style="padding-left:3rem";></span> <?php echo $qty; ?>kg  <span style="padding-left:3rem";></span>  LKR:<?php echo $price; ?>/KG</li></p>
      <p class="name panelcontact"><i class="material-icons w3icon ">&#xe55f;</i><?php echo $address; ?></p>
      <p class="name panelcontact"><i class="material-icons w3icon ">&#xe551;</i><?php echo $mobile; ?></p>
      <br>
      <span class="position panelcontact" style="font-style:italic">Listed on:<?php echo $date; ?></span>
      <br>
      <span id="stat"><?php echo "<p style=\"display:inline\" class='text-info'>".$status."</p>"; ?></span>
      <br><br>
      <div class="icon">
        <img onclick="updateFlag(3)" class="redflag" src="//localhost/web/images/redflag.png" style="width:50px;height:60px;">
        <img onclick="updateFlag(2)" class="yellflag" src="//localhost/web/images/yellowflag.png" style="width:50px;height:60px;">
        <img onclick="updateFlag(1)" class="greenflag" src="//localhost/web/images/greenflag.png" style="width:50px;height:60px;">
        <?php
        switch ($flag) {
          case '1':
            echo "<script type=\"text/javascript\">
              document.getElementsByClassName('greenflag')[0].id=\"greenflag\";
            </script>";
            break;
          case '2':
            echo "<script type=\"text/javascript\">
              document.getElementsByClassName('yellflag')[0].id=\"yellflag\";
            </script>";
            break;
          case '3':
            echo "<script type=\"text/javascript\">
              document.getElementsByClassName('redflag')[0].id=\"redflag\";
            </script>";
            break;
          }
         ?>
           <br>
           <span id="ff"></span>
           </p>
      </div>
      <br>
      <a onclick="reject();" class="btn btn-primary px-4 py-3 rbtn panelbtn">Reject</a>
      <a onClick="openMsg();" class="btn btn-primary px-4 py-3 mbtn panelbtn">Message</a>
      <a onclick="Buy();" class="btn btn-primary px-4 py-3 panelbtn">Buy</a>
      </div>
      </div>

      </div>

    <div id="edit" class="modal">

      <div class="modal-content">

        <form id="details">

        </form>


        </form>
      </div>

    </div>

    <script>
var slideIndex = 1;
showDivs(slideIndex);
var modal = document.getElementById("edit");


function plusDivs(n) {
  showDivs(slideIndex += n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  x[slideIndex-1].style.display = "block";
}
function emptyfunc(pp){
  switch (pp) {
    case 1:document.getElementById('ff').innerHTML="<p style=\"display:inline\" class='text-success'>Updated</p>";break;
    case 0:document.getElementById('ff').innerHTML="<p style=\"display:inline\" class='text-danger'>Update Failed. Try Again.</p>";break;
  }
  setTimeout(() => { document.getElementById('ff').innerHTML=""; }, 500);

}

function updateFlag(code)
{
  document.getElementsByClassName('greenflag')[0].id="";
    document.getElementsByClassName('yellflag')[0].id="";
    document.getElementsByClassName('redflag')[0].id="";
    document.getElementById('ff').innerHTML="<p style=\"display:inline\" class='text-info'>Updating...</p>";
  var xhttp;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      switch (this.responseText) {
        case '1':document.getElementsByClassName('greenflag')[0].id="greenflag";emptyfunc(1);break;
        case '2':document.getElementsByClassName('yellflag')[0].id="yellflag";emptyfunc(1);break;
        case '3':document.getElementsByClassName('redflag')[0].id="redflag";emptyfunc(1);break;

        default:emptyfunc(0);
      }
    }
  };
  xmlhttp.open("GET", "//localhost/web/ajax/panel-update.php?func=flagUpdate&id=" + id + "&code=" + code, true);
  xmlhttp.send();
}

function reject()
{
  document.getElementById('stat').innerHTML="<p style=\"display:inline\" class='text-info'>Updating...</p>";
  var xhttp;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      switch (this.responseText) {
        case '1':document.getElementById('stat').innerHTML="<p style=\"display:inline\" class='text-danger'>Rejected</p>";emptyfunc(1);break;
        case '0':document.getElementById('stat').innerHTML="<p style=\"display:inline\" class='text-danger'>Failed.</p>";emptyfunc(0);break;


        default:document.getElementById('stat').innerHTML="<p style=\"display:inline\" class='text-danger'>Rejection Process Failed.</p>";
      }
    }
  };
  xmlhttp.open("GET", "//localhost/web/ajax/panel-update.php?func=reject&id=" + id, true);
  xmlhttp.send();
}

function openMsg()
{
  var xhttp;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      window.open("//localhost/web/messages/keells?nic="+this.responseText);
      }

  };
  xmlhttp.open("GET", "//localhost/web/ajax/panel-update.php?func=findNic&id=" + id, true);
  xmlhttp.send();
}

function Buy()
{
  modal.style.display = "block";
  document.getElementById('details').innerHTML="<label for='qty'>Quantity</label> "+
        "<input type='text' value='Loading...'> <span>kg (Min. 1kg)</span> <br>"+
        "<label>Price</label> "+
        "<span>Rs.</span> <input type='text' value='Loading...' > <span>(per kg)</span><br><div id='noti'></div><br>"+
        "<button type='button' class='btn btn-primary btnbuy'>BUY</button> "+
        "<button type='button' class='btn btn-danger btncls' >CLOSE</button>";
  var xhttp;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById('details').innerHTML=this.responseText;
    }
  };
  xmlhttp.open("GET", "//localhost/web/ajax/panel-update.php?func=buy&id=" + id, true);
  xmlhttp.send();
}

function CnfBuy()
{
  var qty = document.getElementById('qty').value;
  var price = document.getElementById('price').value;
  document.getElementById('noti').innerHTML="<p class='text-info'>Purchase Processing...</p>";
  var xhttp;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        if(this.responseText=="1"){
         document.getElementById('noti').innerHTML="<p class='text-success'>Purchase Complete</p>";
         document.getElementById('stat').innerHTML="<p style=\"display:inline\" class=\"text-success\">Purchased</p>"
         setTimeout(() => {  document.getElementById('edit').style.display='none'; document.getElementById('details').innerHTML=""; }, 2000);
        }

        else {
          document.getElementById('noti').innerHTML="<p class='text-danger'>Purchase Failed. Try Again.</p>";
          setTimeout(() => {  document.getElementById('edit').style.display='none'; document.getElementById('details').innerHTML=""; }, 2000);
        }
    }
  };
  xmlhttp.open("GET", "//localhost/web/ajax/panel-update.php?func=cnfbuy&id=" + id + "&qty=" + qty + "&price=" + price, true);
  xmlhttp.send();
}

</script>


  </body>
</html>
