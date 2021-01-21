<?php require '../cookiechk.php';
if($user_type!="Admin") header("Location:/web/signin");
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache'); // Date in the past

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Admin - Keells Agri</title>
<meta charset="utf-8">
<link rel="shortcut icon" href="https://www.keellssuper.com/favicon.ico">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,600,700,800,900" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="../css/open-iconic-bootstrap.min.css">
<link rel="stylesheet" href="../css/animate.css">
<link rel="stylesheet" href="../css/owl.carousel.min.css">
<link rel="stylesheet" href="../css/owl.theme.default.min.css">
<link rel="stylesheet" href="../css/magnific-popup.css">
<link rel="stylesheet" href="../css/aos.css">
<link rel="stylesheet" href="../css/ionicons.min.css">
<link rel="stylesheet" href="../css/flaticon.css">
<link rel="stylesheet" href="../css/icomoon.css">
<link rel="stylesheet" href="../css/style.css">
</head>
<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light site-navbar-target scrolled awake" id="ftco-navbar">
<div class="container">
<a class="navbar-brand" href="/web/public"><span>KEELLS</span>AGRI-ADMIN</a>
<button class="navbar-toggler js-fh5co-nav-toggle fh5co-nav-toggle" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
<span class="oi oi-menu"></span> Menu
</button>
<div class="collapse navbar-collapse" id="ftco-nav">
<ul class="navbar-nav nav ml-auto">
<li class="nav-item"><a href="#home-section" class="nav-link"><span>Home</span></a></li>
<li class="nav-item"><a href="#services-section" class="nav-link"><span>Services</span></a></li>
<li class="nav-item"><a href="/web/admin/addStaff" target="_blank" class="nav-link"><span>Add Staff</span></a></li>
<li class="nav-item"><a href="/web/admin/reports.php" class="nav-link"><span>Reports</span></a></li>
<li class="nav-item"><a href="#about-section" class="nav-link"><span>About</span></a></li>
<li class="nav-item"><a href="#contact-section" class="nav-link"><span>Contact</span></a></li><br>
<li class="nav-item"><a onclick="logout();" class="btn btn-primary">Log out</a></p>
  <!-- <span style="padding-BlinkMacSystemFont"></span> -->

</ul>
</div>
</div>
</nav>

<section id="home-section" class="hero">
<h3 class="vr">Welcome to the keells agri</h3>
<div class="home-slider js-fullheight owl-carousel">
<div class="slider-item js-fullheight">
<div class="overlay"></div>
<div class="container-fluid p-0">
<div class="row d-md-flex no-gutters slider-text js-fullheight align-items-center justify-content-end" data-scrollax-parent="true">
<div class="one-third order-md-last img js-fullheight slide2" style="background-image:url(../images/slides5.jpg);">
<div class="overlay"></div>
</div>
<div class="one-forth d-flex js-fullheight align-items-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
<div class="text">
<span class="subheading">Welcome to the keells agri</span>
<h1 class="mb-4 mt-3">Fresh beacuase of <span>You</span></h1>
<p>Farmers play a key role in this, and over the years, Keells has worked together with the farmers and the farming community to ensure the produce is the best quality from the source.</p>
</div>
</div>
</div>
</div>
</div>
<div class="slider-item js-fullheight">
<div class="overlay"></div>
<div class="container-fluid p-0">
<div class="row d-flex no-gutters slider-text js-fullheight align-items-center justify-content-end" data-scrollax-parent="true">
<div class="one-third order-md-last img js-fullheight slide2" style="background-image:url(../images/slide31.jpg);">
<div class="overlay"></div>
</div>
<div class="one-forth d-flex js-fullheight align-items-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
<div class="text">
<span class="subheading">Welcome to the keells agri</span>
<h1 class="mb-4 mt-3"><span>maximise </span>yield<span><br>minimise</span> wastage</h1>
<p>Best farming practices, fertiliser management and post-harvest techniques executed with the collaboration of the Department of Agriculture.</p>
</div>
</div>
</div>
</div>
</div>
</div>
</section>


<section class="ftco-section ftco-no-pb ftco-no-pt ftco-services bg-light" id="services-section">
<div class="container">
<div class="row no-gutters">
<div class="col-md-4 ftco-animate py-5 nav-link-wrap">
<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
<a class="nav-link px-4 active" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="true"><span class="mr-3 flaticon-ideas"></span> Business Strategy</a>
<a class="nav-link px-4" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2" role="tab" aria-controls="v-pills-2" aria-selected="false"><span class="mr-3 flaticon-flasks"></span> Research</a>
<a class="nav-link px-4" id="v-pills-3-tab" data-toggle="pill" href="#v-pills-3" role="tab" aria-controls="v-pills-3" aria-selected="false"><span class="mr-3 flaticon-analysis"></span> Data Analysis</a>
<a class="nav-link px-4" id="v-pills-4-tab" data-toggle="pill" href="#v-pills-4" role="tab" aria-controls="v-pills-4" aria-selected="false"><span class="mr-3 flaticon-web-design"></span> UI/UX Design</a>
<a class="nav-link px-4" id="v-pills-5-tab" data-toggle="pill" href="#v-pills-5" role="tab" aria-controls="v-pills-5" aria-selected="false"><span class="mr-3 flaticon-innovation"></span> Technology</a>

</div>
</div>
<div class="col-md-8 ftco-animate p-4 p-md-5 d-flex align-items-center">
<div class="tab-content pl-md-5" id="v-pills-tabContent">
<div class="tab-pane fade show active py-5" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-1-tab">
<span class="icon mb-3 d-block flaticon-ideas"></span>
<h2 class="mb-4">Business Strategy</h2>
<p>We use this marketplace platform to reach small rural farmers and provide them with a better opportunity to sell their harvest.</p>
<p>This further improves our supply chain and provide fresh and better produce for our customers while improving life of small farmers.</p>
</div>
<div class="tab-pane fade py-5" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-2-tab">
<span class="icon mb-3 d-block flaticon-flasks"></span>
<h2 class="mb-4">Research</h2>
<p>This platform allow us to gather important and valuable data that can be used for the better of everyone</p>
<p>Keells research team has access to the data this platform generates which can be used to develop and validate their researches.</p>
</div>
<div class="tab-pane fade py-5" id="v-pills-3" role="tabpanel" aria-labelledby="v-pills-3-tab">
<span class="icon mb-3 d-block flaticon-analysis"></span>
<h2 class="mb-4">Data Analysis</h2>
<p>Most of the data we gather from this platform are published on our website. The public can view platforms data as graphs</p>
<p>These graphs are updated everytime a customer visits our website.</p>
</div>
<div class="tab-pane fade py-5" id="v-pills-4" role="tabpanel" aria-labelledby="v-pills-4-tab">
<span class="icon mb-3 d-block flaticon-web-design"></span>
<h2 class="mb-4">UI/UX Design</h2>
<p>We tried to make the UI as simple as possible to improve the efficency of user interaction.</p>
<p>Interacting with the website is so much easier than a traditional website. We chose a primary color that reflect our brand. Graphs, maps and icons to make the UI more attractive.</p>
</div>
<div class="tab-pane fade py-5" id="v-pills-5" role="tabpanel" aria-labelledby="v-pills-5-tab">
<span class="icon mb-3 d-block flaticon-innovation"></span>
<h2 class="mb-4">Technology</h2>
<p>Our Information Technology sector has a vision of providing quality, world class end-to-end information and communications technology services ranging from business process outsourcing, software services and information integration to office automation.</p>
<p>We have established a strong customer base in Sri Lanka, South Asia, the United Kingdom, Middle East, North America, Scandinavia and the Far East. The IT industry group is at the forefront of making Sri Lanka an ICT hub in South Asia.</p>
</div>
</div>
</div>
</div>
</div>
</section>

<section class="ftco-section">
  <div class="container-fluid">
    <div id="wrapper">
    <div id="googleMap2"></div>
      <div  id="over_map" class="">
        <div class="table" style="overflow-y:auto;height:373%;">
          <div id="side-list" >

                </div>
</div>
</div>
  </div>
</div>
</section>
</section>
<section class="ftco-section ftco-project bg-light" id="analysis-section">
  <div class="container-fluid">

      <?php include "../charts/index.php"; ?>

  </div>
</section>

<section class="ftco-counter img ftco-section ftco-no-pt ftco-no-pb" id="about-section">
<div class="container">
<div class="row d-flex">
<div class="col-md-6 col-lg-5 d-flex">
<div class="img d-flex align-self-stretch align-items-center" style="background-image:url(../images/akka.jpg);">
</div>
</div>
<div class="col-md-6 col-lg-7 pl-lg-5 py-5">
<div class="py-md-5">
<div class="row justify-content-start pb-3">
<div class="col-md-12 heading-section ftco-animate">
<span class="subheading">Welcome to the keells agri</span>
<h2 class="mb-4" style="font-size: 34px; text-transform: capitalize;">Fresh because of you</h2>
<p>Keells, with the recently launched ‘Fresh because of you’ campaign made several investments and improvements to processes to ensure the customer receives the freshest produce at the store</p>
<p>Farmers play a key role in this, and over the years, Keells has worked together with the farmers and the farming community to ensure the produce is the best quality from the source. </p>
<p>Keells has partnered strategically with organisations and together, has looked at how the agricultural practices overall can be uplifted to ensure the end-product quality is improved. The teams at the vegetable and fruit collection centres across the country in areas such as Sooriyaweva, Pannegamuwa, Keppetipola, Thambuttegama, Jaffna, and Sigiriya ensure they work together with the farmers in the region to improve not just the quality of produce, but also to disseminate good agricultural practices and thereby introducing sustainable farming practices.</p>
</div>
</div>
<div class="counter-wrap ftco-animate d-flex mt-md-3">
<div class="text p-4 bg-primary">
<p class="mb-0">
<span class="number" data-number="22">0</span>
<span>Years of experience</span>
</p>
</div>
</div>
</div>
</div>
</div>
</div>
</section>


<section class="ftco-section contact-section ftco-no-pb" id="contact-section">
<div class="container">
<div class="row justify-content-center mb-5 pb-3">
<div class="col-md-7 heading-section text-center ftco-animate">
<span class="subheading">Contact</span>
<h2 class="mb-4">Contact Us</h2>
</div>
</div>
<div class="row d-flex contact-info mb-5">
<div class="col-md-6 col-lg-3 d-flex ftco-animate">
<div class="align-self-stretch box p-4 text-center">
<div class="icon d-flex align-items-center justify-content-center">
<span class="icon-map-signs"></span>
</div>
<h3 class="mb-4">Address</h3>
<p>Jaykay Marketing Services Pvt Ltd
No:148, Vauxhall Street,
Colombo 2, Sri Lanka.</p>
</div>
</div>
<div class="col-md-6 col-lg-3 d-flex ftco-animate">
<div class="align-self-stretch box p-4 text-center">
<div class="icon d-flex align-items-center justify-content-center">
<span class="icon-phone2"></span>
</div>
<h3 class="mb-4">Contact Number</h3>
<p><a href="tel://1234567920">+94 11 2303500</a></p>
</div>
</div>
<div class="col-md-6 col-lg-3 d-flex ftco-animate">
<div class="align-self-stretch box p-4 text-center">
<div class="icon d-flex align-items-center justify-content-center">
<span class="icon-paper-plane"></span>
</div>
<h3 class="mb-4">Email Address</h3>
<p><span class="__cf_email__">keellsfarmercare.jms@keells.com</span></a></p>
</div>
</div>
<div class="col-md-6 col-lg-3 d-flex ftco-animate">
<div class="align-self-stretch box p-4 text-center">
<div class="icon d-flex align-items-center justify-content-center">
<span class="icon-globe"></span>
</div>
<h3 class="mb-4">Website</h3>
<p><a href="#">keellssuper.com</a></p>
</div>
</div>
</div>
</div>
</section>


<footer class="ftco-footer ftco-section">
<div class="container">
<div class="row mb-5">
<div class="col-md">
<div class="ftco-footer-widget mb-4">
<h2 class="ftco-heading-2">About KeellsAgri</h2>
<p>Farmers play a key role in this, and over the years, Keells has worked together with the farmers and the farming community to ensure the produce is the best quality from the source.</p>
<ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
<li class="ftco-animate"><a href="https://twitter.com/?lang=en"><span class="icon-twitter"></span></a></li>
<li class="ftco-animate"><a href="https://www.facebook.com/#"><span class="icon-facebook"></span></a></li>
<li class="ftco-animate"><a href="https://www.instagram.com/"><span class="icon-instagram"></span></a></li>
</ul>
</div>
</div>
<div class="col-md">
<div class="ftco-footer-widget mb-4 ml-md-4">
<h2 class="ftco-heading-2">Links</h2>
<ul class="list-unstyled">
<li><a href="#home-section"><span class="icon-long-arrow-right mr-2"></span>Home</a></li>
<li><a href="#services-section"><span class="icon-long-arrow-right mr-2"></span>Services</a></li>
<li><a href="#analysis-section"><span class="icon-long-arrow-right mr-2"></span>Analytics</a></li>
<li><a href="#about-section"><span class="icon-long-arrow-right mr-2"></span>About</a></li>
<li><a href="#contact-section"><span class="icon-long-arrow-right mr-2"></span>Contact</a></li>
</ul>
</div>
</div>
<div class="col-md">
<div class="ftco-footer-widget mb-4">
<h2 class="ftco-heading-2">Services</h2>
<ul class="list-unstyled">
<li><a href="#v-pills-1"><span class="icon-long-arrow-right mr-2"></span>Business Strategy</a></li>
<li><a href="#v-pills-2"><span class="icon-long-arrow-right mr-2"></span>Research</a></li>
<li><a href="#v-pills-3"><span class="icon-long-arrow-right mr-2"></span>Data Analysis</a></li>
<li><a href="#v-pills-4"><span class="icon-long-arrow-right mr-2"></span>UX/UI Design</a></li>
<li><a href="#v-pills-5"><span class="icon-long-arrow-right mr-2"></span>Technology</a></li>
</ul>
</div>
</div>
<div class="col-md">
<div class="ftco-footer-widget mb-4">
<h2 class="ftco-heading-2">Have Questions?</h2>
<div class="block-23 mb-3">
<ul>
<li><span class="icon icon-map-marker"></span><span class="text">Jaykay Marketing Services Pvt Ltd
No:148, Vauxhall Street,
Colombo 2, Sri Lanka.</span></li>
<li><a href="#"><span class="icon icon-phone"></span><span class="text">+94 11 2303500</span></a></li>
<li><a href="#"><span class="icon icon-envelope"></span><span class="text"><span class="__cf_email__">keellsfarmercare.jms@keells.com</span></span></a></li>
</ul>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-md-12 text-center">
<p>
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Developed by Unknown DEVs LK
</p>
</div>
</div>
</div>
</footer>

<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" /><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" /></svg></div>
<script src="../js/jquery.min.js"></script>
<script src="../js/jquery-migrate-3.0.1.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery.easing.1.3.js"></script>
<script src="../js/jquery.waypoints.min.js"></script>
<script src="../js/jquery.stellar.min.js"></script>
<script src="../js/owl.carousel.min.js"></script>
<script src="../js/jquery.magnific-popup.min.js"></script>
<script src="../js/aos.js"></script>
<script src="../js/jquery.animateNumber.min.js"></script>
<script src="../js/scrollax.min.js"></script>
<script src="../js/publicMap.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAI6bwkbJkNfAXK0kqSVi21V7Ll0CnUzOM&callback=mainMap"></script>
<script src="../js/main.js"></script>

<script>
FetchMarkers();
FetchList();
</script>
</body>
</html>
