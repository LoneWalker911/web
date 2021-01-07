<?php require '../../cookiechk.php';
if($user_type!="Farmer") {header("Location:/web/$login_username");}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
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
    <ul class="nav1">

      <li class="a"><a class="nav" href="../harvest/add">Add-harvest</a></li>
      <li class="a"><a class="nav" href="#">report</a></li>
      <img src="https://essstr.blob.core.windows.net/uiimg/keellslogo.png" width="60%">
      <li class="a"><a class="nav" href="#">transaction</a></li>
      <li class="a"><a class="nav" href="#">message</a></li>

  </ul>



  <br>
<table>
  <tr>
    <th>ID</th>
    <th>Harvest Type</th>
    <th>Quantity</th>
    <th>Listed Price</th>
    <th>Listed Date</th>
    <th>Flag</th>
    <th></th>
  </tr>
  <?php
 $conn = mysqli_connect($servername, $username, $password, $dbname);

 $sql = "SELECT harvest.id, crop.crop_type, trim(qty_kg)+0 AS qty, price, flag_code, date FROM harvest,crop WHERE farmer_id='$login_username' AND harvest.crop_type_id=crop.id ORDER BY harvest.date DESC,farmer_id";
 $result = mysqli_query($conn, $sql);
 if (mysqli_num_rows($result) > 0) {

 while($row = mysqli_fetch_assoc($result)) {
   $date = date("d/m/Y", strtotime($row["date"]));
   echo "<tr>";
   echo   "<td>".$row['id']."</td>";
   echo   "<td>".$row['crop_type']."</td>";
   echo   "<td>".$row['qty']."KG</td>";
   echo   "<td>LKR ".$row['price']."</td>";
   echo   "<td>".$date."</td>";
   echo   "<td></td> ";//FLAG
   echo   "<td class='btn-group' role='group'><button type='button' onClick='Edit(".$row['id'].");' class='btn btn-outline-primary'>Edit</button>"."";
   echo   "<button type='button' onClick='Remove(".$row['id'].");' class='btn btn-danger'>Remove</button>"."</td>";
   }
 }
 else {
   echo "<tr>
     <td>NOTHING</td>
     <td>TO</td>
     <td>SEE</td>
     <td>HERE</td>
     <td></td>
     <td></td>
     <td></td>

   </tr>";
}
 mysqli_close($conn);
  ?>
  <tr>
    <td>011</td>
    <td>Carrot</td>
    <td>100KG</td>
    <td>LKR 150.00</td>
    <td>12/12/2020</td>
    <td>Note</td>
    <td>aaaa</td>

  </tr>

  <tr>
    <td>011</td>
    <td>Carrot</td>
    <td>100KG</td>
    <td>LKR 150.00</td>
    <td>12/12/2020</td>
    <td>Note</td>
    <td>aaaa</td>

  </tr>
  <tr>
    <td>011</td>
    <td>Carrot</td>
    <td>100KG</td>
    <td>LKR 150.00</td>
    <td>12/12/2020</td>
    <td>Note</td>
    <td>aaaa</td>

  </tr>
  <tr>
    <td>011</td>
    <td>Carrot</td>
    <td>100KG</td>
    <td>LKR 150.00</td>
    <td>12/12/2020</td>
    <td>Note</td>
    <td>aaaa</td>

  </tr>
  <tr>
    <td>011</td>
    <td>Carrot</td>
    <td>100KG</td>
    <td>LKR 150.00</td>
    <td>12/12/2020</td>
    <td>Note</td>
    <td>aaaa</td>

  </tr>
  <tr>
    <td>011</td>
    <td>Carrot</td>
    <td>100KG</td>
    <td>LKR 150.00</td>
    <td>12/12/2020</td>
    <td>Note</td>
    <td>aaaa</td>

  </tr>

</table>

  </body>
</html>
