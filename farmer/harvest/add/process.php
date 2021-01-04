<?php
$pic1error = "";
$pic2error = "";
$pic3error = "";
$pic4error = "";
$pic5error = "";
$url2="";
$url3="";
$url4="";
$url5="";
$pass=true;
$formError = "";
if(isset($_POST['submit'])) {
  if(isset($_POST['crop']) && isset($_POST['qty']) && isset($_POST['price']) && ($_FILES['pic1']['tmp_name']!== ""))
  {

  $uploadOk = 1;
  $url = "";

  $crop = $_POST['crop'];
  $qty = $_POST['qty'];
  $price = $_POST['price'];


  function processimage($pic)
  {
    $target_dir = "C:/xampp/htdocs/web/images/harvest/";
    global $url;
    $url = "/web/images/harvest/";

    $ext = pathinfo($pic['name'], PATHINFO_EXTENSION);
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);

    do{
      $randomString = '';
    for ($i = 0; $i < 20; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
      $target_file = $target_dir . $randomString . "." . $ext;
      $url .=$randomString . "." . $ext;
    }while(file_exists($target_file));


      if (move_uploaded_file($pic["tmp_name"],$target_file)) {
        return true;
      } else {
        return false;
      }
    }


  function validateimage($pic,&$picerror)
  {
    $uploadOk = 1;

    $ext = pathinfo($pic['name'], PATHINFO_EXTENSION);

    $check = getimagesize($pic["tmp_name"]);
    if($check == false) {
      $picerror .= "<li>This file is not an image</li>";
      $uploadOk = 0;
    }

      //$target_file = $target_dir . $randomString . "." . $ext;


    $imageFileType = strtolower(pathinfo($pic["name"],PATHINFO_EXTENSION));

    if ($pic["size"] > 5000000) {
      $picerror .= "<li>Sorry, your file is too large.</li>";
      $uploadOk = 0;
      }

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
      $picerror .= "<li>Sorry, only JPG, JPEG & PNG files are allowed.</li>";
      $uploadOk = 0;
    }

    if ($uploadOk == 0) {
      return false;
    } else {
        return true;
      }
  }

  if ($_FILES['pic1']['tmp_name']!== "") {
    if(!validateimage($_FILES['pic1'],$pic1error)){
      $pass=false;
      }
    }

  if ($_FILES['pic2']['tmp_name']!== "") {
    if(!validateimage($_FILES['pic2'],$pic2error)){
      $pass=false;
      }
    }

  if ($_FILES['pic3']['tmp_name']!== "") {
    if(!validateimage($_FILES['pic3'],$pic3error)){
      $pass=false;
      }
    }

  if ($_FILES['pic4']['tmp_name']!== "") {
    if(!validateimage($_FILES['pic4'],$pic4error)){
      $pass=false;
      }
    }

  if ($_FILES['pic5']['tmp_name']!== "") {
    if(!validateimage($_FILES['pic5'],$pic5error)){
      $pass=false;
      }
    }



    if($pass&&processimage($_FILES['pic1']))
    {
      $conn = mysqli_connect($servername, $username, $password, $dbname);

      if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      }

      $sql = "INSERT INTO harvest (crop_type_id, qty_kg, price, picture_1, farmer_id, expiry_timestamp)
      VALUES ($crop, $qty, $price, '$url', '$login_username', DATE_ADD(NOW(), INTERVAL 2 DAY))";


      if (mysqli_query($conn, $sql))
      {
        global $last_id;
        $last_id = mysqli_insert_id($conn);
        $pass=true;
      }
      else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }

      mysqli_close($conn);
    }
    else {
      $formError = "Image processing faliled";
    }




if ($pass) {
  if ($_FILES['pic2']['tmp_name']!== "") {
      if (processimage($_FILES['pic2'])) {
        $url2=$url;
      }else {
        $formError = "Image processing faliled";
      }
    }

  if ($_FILES['pic3']['tmp_name']!== "") {
      if (processimage($_FILES['pic3'])) {
        $url3=$url;
      }else {
        $formError = "Image processing faliled";
      }
    }

  if ($_FILES['pic4']['tmp_name']!== "") {
      if (processimage($_FILES['pic4'])) {
        $url4=$url;
      }else {
        $formError = "Image processing faliled";
      }
    }

  if ($_FILES['pic5']['tmp_name']!== "") {
      if (processimage($_FILES['pic5'])) {
        $url5=$url;
      }else {
        $formError = "Image processing faliled";
      }
    }

    $conn = mysqli_connect($servername, $username, $password, $dbname);

      if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      }

      $sql = "UPDATE harvest
      SET picture_2='$url2', picture_3='$url3', picture_4='$url4', picture_5='$url5'
      WHERE id=$last_id";


      if (mysqli_query($conn, $sql))
      {

      }
      else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }

      mysqli_close($conn);
    }
    else {
      $formError = "Image processing faliled";
    }

}
else {
    $formError = "PLEASE ENTER ALL REQUIRED INFOMATION";
  }
}
 ?>
