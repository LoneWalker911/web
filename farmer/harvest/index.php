<?php error_reporting(0);
require '../../cookiechk.php';
if($user_type!="Farmer") {header("Location:/web/signin");}
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
    <link rel="stylesheet" type="text/css" href="farmer.css">
    <title>My Reports - Farmer - Keells Agri</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light site-navbar-target scrolled awake" id="ftco-navbar">
    <div class="container">
    <a class="navbar-brand" href="/web/public"><span>KEELLS</span>AGRI-FARMER</a>
    <button class="navbar-toggler js-fh5co-nav-toggle fh5co-nav-toggle" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="oi oi-menu"></span> Menu
    </button>
    <div class="collapse navbar-collapse" id="ftco-nav">
    <ul class="navbar-nav nav ml-auto">
    <li class="nav-item"><a href="/web/farmer#home-section" class="nav-link"><span>Home</span></a></li>
    <li class="nav-item"><a href="/web/farmer#services-section" class="nav-link"><span>Services</span></a></li>
    <li class="nav-item"><a href="/web/farmer#chart-section" class="nav-link"><span>Analatics</span></a></li>
    <li class="nav-item"><a href="/web/farmer/harvest" class="nav-link"><span>My Reports</span></a></li>
    <li class="nav-item"><a href="/web/farmer/transactions" class="nav-link"><span>Transactions</span></a></li>
    <!-- <li class="nav-item"><a href="#blog-section" class="nav-link"><span>Blog</span></a></li> -->
    <li class="nav-item"><a href="/web/farmer#contact-section" class="nav-link"><span>Contact</span></a></li>
    </ul>
    </div>
    </div>
    </nav>
    <br><br><br>
  <div id="edit" class="modal">

    <div class="modal-content">
      <span class="close-modal"></span>
      <form id="details">

      </form>


      </form>
    </div>

  </div>

  <div id="del" class="modal1 del">
  <span onclick="document.getElementById('del').style.display='none'" class="close" title="Close Modal">&times;</span>
  <form class="modal1-content">
    <div class="container-mo">
      <h1>Delete Report</h1>
      <p>Are you sure you want to delete your report?</p>

      <div id="deldiv" class="clearfix">

      </div>
    </div>
  </form>
</div>

  <br>
<table id="table">

</table>
<script type="text/javascript" src="process.js">

</script>
  </body>
</html>
