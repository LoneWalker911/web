<?php error_reporting(0);
require '../../cookiechk.php';
if($user_type!="Keells")
if ($user_type!="DoA")
  header("Location:/web/signin");

header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <style media="screen">
      button {box-shadow: none !important;}
    </style>
    <link rel="shortcut icon" href="https://www.keellssuper.com/favicon.ico">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" >
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
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" type="text/css" href="keells.css">
    <title>Reports - Staff - Keells Agri</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light site-navbar-target scrolled awake" id="ftco-navbar">
    <div class="container">
    <a class="navbar-brand" href="/web/keells"><span>KEELLS</span>AGRI-STAFF</a>
    <button class="navbar-toggler js-fh5co-nav-toggle fh5co-nav-toggle" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="oi oi-menu"></span> Menu
    </button>
    <div class="collapse navbar-collapse" id="ftco-nav">
    <ul class="navbar-nav nav ml-auto">
      <li class="nav-item"><a href="/web/keells#home-section" class="nav-link"><span>Home</span></a></li>
      <li class="nav-item"><a href="/web/keells#services-section" class="nav-link"><span>Services</span></a></li>
      <li class="nav-item"><a href="/web/keells#analysis-section" class="nav-link"><span>Analatics</span></a></li>
      <li class="nav-item"><a href="//localhost/web/keells/reports" class="nav-link"><span>Reports</span></a></li>
      <li class="nav-item"><a href="//localhost/web/keells/transactions" class="nav-link"><span>Transactions</span></a></li>
      <!-- <li class="nav-item"><a href="#blog-section" class="nav-link"><span>Blog</span></a></li> -->
      <li class="nav-item"><a href="//localhost/web/keels#contact-section" class="nav-link"><span>Contact</span></a></li>
    </ul>
    </div>
    </div>
    </nav>
    <br><br><br>

  <br>
<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Harvest Type</th>
      <th scope="col">Quantity</th>
      <th scope="col">Listed Price</th>
      <th scope="col">Listed Date</th>
      <th scope="col">Flag</th>
       <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
    <?php
    require '../../dbcon.php';
    $loginString = htmlspecialchars($_COOKIE['usr']);

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    $sql = "SELECT harvest.id, crop.crop_type, trim(qty_kg)+0 AS qty, price, flag_code, date, expiry_timestamp, status FROM harvest,crop,login WHERE 1=login.user_type_id AND login.loginstring='$loginString' AND harvest.crop_type_id=crop.id ORDER BY harvest.date DESC";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
     $date = date("d/m/Y", strtotime($row["date"]));
     echo "<tr>";
     echo   "<td>".$row['id']."</td>";
     echo   "<td>".$row['crop_type']."</td>";
     echo   "<td>".$row['qty']."kg</td>";
     echo   "<td>LKR ".$row['price']."</td>";
     echo   "<td>".$date."</td>";
     switch ($row["flag_code"]) {
       case 1:
         echo   "<td><img src=\"//localhost/web/images/greenflag.png\" style=\"max-width: 17%;height: auto; \" class=\"img\" alt=\"Green Flag\"></td>";
         break;
       case 2:
         echo   "<td><img src=\"//localhost/web/images/yellowflag.png\" style=\"max-width: 17%;height: auto; \" class=\"img\" alt=\"Yellow Flag\"></td>";
         break;
       case 3:
         echo   "<td><img src=\"//localhost/web/images/redflag.png\" style=\"max-width: 17%;height: auto; \" class=\"img\" alt=\"Red Flag\"></td>";
         break;

       default:echo "<td>Not Flagged</td>";
         break;
     }
     if(strtotime($row['expiry_timestamp']) < time()){
       echo "<td><p class='text-danger'>Expired</p></td>";
     }
     else if($row['status']=="Purchased"){
       echo "<td><p class='text-success'>Purchased</p></td>";
     }
     else if($row['status']=="Removed"){
       echo "<td><p class='text-danger'>Removed</p></td>";
     }
     else if($row['status']=="Rejected"){
       echo "<td><p class='text-danger'>Rejected</p></td>";
     }
     else
     {
     echo "<td><p class='text-success'>Active</p></td>";
   }
     }
    }
    mysqli_close($conn);
    exit;

     ?>
  </tbody>
</table>

  </body>
</html>
