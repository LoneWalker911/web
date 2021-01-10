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
    <link rel="shortcut icon" href="https://www.keellssuper.com/favicon.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" >
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="../../css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="../../css/animate.css">
    <link rel="stylesheet" href="../../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../../css/magnific-popup.css">
    <link rel="stylesheet" href="../../css/aos.css">
    <link rel="stylesheet" href="../../css/ionicons.min.css">
    <link rel="stylesheet" href="../../css/flaticon.css">
    <link rel="stylesheet" href="../../css/icomoon.css">
    <link rel="stylesheet" type="text/css" href="farmer.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style.css">
    <title>Transactions - Farmer - Keells Agri</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light site-navbar-target scrolled awake" id="ftco-navbar">
    <div class="container">
    <a class="navbar-brand" href="//localhost/web"><span>KEELLS</span>AGRI-FARMER</a>
    <button class="navbar-toggler js-fh5co-nav-toggle fh5co-nav-toggle" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="oi oi-menu"></span> Menu
    </button>
    <div class="collapse navbar-collapse" id="ftco-nav">
    <ul class="navbar-nav nav ml-auto">
    <li class="nav-item"><a href="#home-section" class="nav-link"><span>Home</span></a></li>
    <li class="nav-item"><a href="#services-section" class="nav-link"><span>Services</span></a></li>
    <li class="nav-item"><a href="#projects-section" class="nav-link"><span>Analatics</span></a></li>
    <li class="nav-item"><a href="//localhost/web/farmer/harvest" class="nav-link"><span>My Reports</span></a></li>
    <li class="nav-item"><a href="//localhost/web/farmer/transactions" class="nav-link"><span>Transactions</span></a></li>
    <!-- <li class="nav-item"><a href="#blog-section" class="nav-link"><span>Blog</span></a></li> -->
    <li class="nav-item"><a href="//localhost/web/farmer#contact-section" class="nav-link"><span>Contact</span></a></li>
    </ul>
    </div>
    </div>
    </nav>

  <br><br><br>
<table class="table">
  <thead>
    <tr>
      <th class="text-center" scope="col">ID</th>
      <th class="text-center" scope="col">Harvest ID</th>
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

    $sql = "SELECT transaction.id, harvest.id AS hid, crop.crop_type, trim(transaction.qty_kg)+0 AS qty, harvest.price AS hprice, transaction.price AS tprice, harvest.date AS hdate, transaction.date AS tdate FROM harvest,crop,login,transaction WHERE farmer_id=login.username AND login.loginstring='$loginString' AND harvest.crop_type_id=crop.id ORDER BY harvest.date DESC";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {

     $hdate = date("d/m/Y h:i:s A", strtotime($row["hdate"]));
     $tdate = date("d/m/Y h:i:s A", strtotime($row["tdate"]));
     echo "<tr class=\"text-center\">";
     echo   "<th class=\"text-center\" scope=\"row\">".$row['id']."</th>";
     echo   "<th class=\"text-center\" scope=\"row\">".$row['hid']."</th>";
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
<script type="text/javascript" src="process.js"></script>
<script src="../../js/jquery.min.js"></script>
<script src="../../js/jquery-migrate-3.0.1.min.js"></script>
<script src="../../js/popper.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/jquery.easing.1.3.js"></script>
<script src="../../js/jquery.waypoints.min.js"></script>
<script src="../../js/jquery.stellar.min.js"></script>
<script src="../../js/owl.carousel.min.js"></script>
<script src="../../js/jquery.magnific-popup.min.js"></script>
<script src="../../js/aos.js"></script>
<script src="../../js/jquery.animateNumber.min.js"></script>
<script src="../../js/scrollax.min.js"></script>
<script src="../../js/publicMap.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAI6bwkbJkNfAXK0kqSVi21V7Ll0CnUzOM&callback=mainMap"></script>
<script src="../../js/google-map.js"></script>
<script src="../../js/main.js"></script>
  </body>
</html>
