<?php
$url = "//".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
require '../cookiechk.php';
if(!isset($_REQUEST['id'])) exit;
 ?>
 <head>

 </head>

    <link rel="stylesheet" href="/web/css/side-panel-style.css">

    <div class=" item ">
<div class="testimony-wrap text-center py-4 pb-5 ">
      <?php
      require '../dbcon.php';
      $conn = mysqli_connect($servername, $username, $password, $dbname);
      $id = htmlspecialchars($_REQUEST["id"]);

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
        $img .= "<div class=\"user-img sidepanelcss w3-display-container mySlides\" style=\"background-image: url(".$pic5.")\">";
      }

      echo $img;
      //echo "<script type=\"text/javascript\">var id=".$id.";</script>";
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
        <img onclick="updateFlag(3)" <?php if($flag=="1") echo"id=\"redflag\""; ?> class="redflag" src="//localhost/web/images/redflag.png" style="width:50px;height:60px;">
        <img onclick="updateFlag(2)" <?php if($flag=="2") echo"id=\"yellflag\""; ?> class="yellflag" src="//localhost/web/images/yellowflag.png" style="width:50px;height:60px;">
        <img onclick="updateFlag(1)" <?php if($flag=="3") echo"id=\"greenflag\""; ?> class="greenflag" src="//localhost/web/images/greenflag.png" style="width:50px;height:60px;">
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

      </div>

    </div>
    <script type="text/javascript">
    var slideIndex = 1;
    showDivs(slideIndex);
    </script>
