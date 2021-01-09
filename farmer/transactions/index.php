<?php
error_reporting(0);
require '../../cookiechk.php';
if($user_type!="Farmer") {header("Location:/web/signin");}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <style media="screen">
      button {box-shadow: none !important;}
    </style>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" >
    <link rel="stylesheet" type="text/css" href="farmer.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title></title>
  </head>
  <body>
    <ul class="nav1">

      <li class="a"><a class="nav" href="../harvest/add">Add-harvest</a></li>
      <li class="a"><a class="nav" href="#">report</a></li>
      <img src="https://essstr.blob.core.windows.net/uiimg/keellslogo.png" width="60%">
      <li class="a"><a class="nav" href="#">transaction</a></li>
      <li class="a"><a class="nav" href="#">message</a></li>

  </ul>

  <br>
<table class="table">
  <thead>
    <tr>
      <th class="text-center" scope="col">ID</th>
      <th class="text-center" scope="col">Harvest Type</th>
      <th class="text-center" scope="col">Quantity</th>
      <th class="text-center" scope="col">Listed Price</th>
      <th class="text-center" scope="col">Bought Price</th>
      <th class="text-center" scope="col">Listed Date</th>
      <th class="text-center" scope="col">Bought Date</th>
    </tr>
  </thead>
  <tbody class="table-hover">
    <?php
$loginString=htmlspecialchars($_COOKIE['usr']);
    require '../../dbcon.php';
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    $sql = "SELECT transaction.id, crop.crop_type, trim(transaction.qty_kg)+0 AS qty, harvest.price AS hprice, transaction.price AS tprice, harvest.date AS hdate, transaction.date AS tdate FROM harvest,crop,login,transaction WHERE farmer_id=login.username AND login.loginstring='$loginString' AND harvest.crop_type_id=crop.id ORDER BY harvest.date DESC";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {

     $hdate = date("d/m/Y h:i:s A", strtotime($row["hdate"]));
     $tdate = date("d/m/Y h:i:s A", strtotime($row["tdate"]));
     echo "<tr class=\"text-center\">";
     echo   "<th class=\"text-center\" scope=\"row\">".$row['id']."</th>";
     echo   "<td class=\" text-center\">".$row['crop_type']."</td>";
     echo   "<td class=\" text-center\">".$row['qty']."kg</td>";
     echo   "<td class=\" text-center\">LKR ".$row['hprice']."</td>";
     echo   "<td class=\" text-center\">LKR ".$row['tprice']."</td>";
     echo   "<td class=\" text-center\">".$hdate."</td>";
     echo   "<td class=\" text-center\">".$tdate."</td>";
     echo   "</tr>";
   }}
    else {
      echo "<tr class=\"text-center\">";
      echo   "<th scope=\"row text-center\">"."-"."</th>";
      echo   "<td class=\"h4 text-center\">"."-"."</td>";
      echo   "<td class=\"h4 text-center\">"."-"."</td>";
      echo   "<td class=\"h4 text-center\">"."-"."</td>";
      echo   "<td class=\"h4 text-center\">"."-"."</td>";
      echo   "<td class=\"h4 text-center\">"."-"."</td>";
      echo   "<td class=\"h4 text-center\">"."-"."</td>";
      echo   "<tr>";
    }
    mysqli_close($conn);
    exit;
     ?>

  </tbody>


</table>
<script type="text/javascript" src="process.js">

</script>
  </body>
</html>
