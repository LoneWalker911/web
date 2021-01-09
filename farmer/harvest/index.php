<?php require '../../cookiechk.php';
if($user_type!="Farmer") {header("Location:/web/$login_username");}
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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" >
    <link rel="stylesheet" type="text/css" href="farmer.css">
    <title></title>
  </head>
  <body>

  <div id="edit" class="modal">

    <div class="modal-content">
      <span class="close-modal">&times;</span>
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
