<?php
require '../dbcon.php';
$loginString = htmlspecialchars($_COOKIE['usr']);

if($_GET['func']=="flagUpdate"){
$code = htmlspecialchars($_GET['code']);
$id = htmlspecialchars($_GET['id']);


$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


$sql = "UPDATE harvest,login SET flag_code=$code WHERE Status IS NULL AND login.user_type_id=1 AND login.loginstring='$loginString' AND harvest.id=$id";

if (mysqli_query($conn, $sql)&&mysqli_affected_rows($conn)>0)
{
  echo $code;
}
else {
  echo 0;
}
mysqli_close($conn);
exit;
}

if($_GET['func']=="reject"){
$id = htmlspecialchars($_GET['id']);


$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


$sql = "UPDATE harvest,login SET status='Rejected' WHERE (status IS NULL OR status <> 'Purchased') AND login.user_type_id=1 AND login.loginstring='$loginString' AND harvest.id=$id";


if (mysqli_query($conn, $sql))
{
  if(mysqli_affected_rows($conn)>0)
  echo 1;
}
else {
  echo 0;
}
mysqli_close($conn);
exit;
}


if($_GET['func']=="findNic"){
$conn = mysqli_connect($servername, $username, $password, $dbname);
$id = htmlspecialchars($_GET['id']);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT farmer_id FROM harvest,login WHERE  login.user_type_id=1 AND login.loginstring='$loginString' AND harvest.id=$id";

  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result))
    {
      echo $row['farmer_id'];
    }
}
else {
 echo "<script> if(confirm('Your session has expired. Please login again to continue')) window.location.href = 'http://localhost/web/signin';</script>";
}
mysqli_close($conn);
exit;
}


if($_GET['func']=="buy"){
$conn = mysqli_connect($servername, $username, $password, $dbname);
$id = $_GET['id'];
$sql = "SELECT trim(qty_kg)+0 AS qty FROM harvest WHERE  harvest.id=$id";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
while($row = mysqli_fetch_assoc($result)) {

 echo "<label for='qty'>Quantity</label>";
 echo "
 <input type='number' id='qty' required name='qty' min='1' max='".$row["qty"]."' step='.1'> <span>kg (Max. ".$row["qty"]."kg)</span><br>
 <label for='price'>Price</label>
 <span>Rs.</span>
 <input type='number' id='price'  required name='price' min='1' value='' step='.01'>s
 <span>(per kg)</span>
 <br>
 <div id='noti'></div>
 <br> <button type='button' id='upbtn' onclick='CnfBuy();'class='btn btn-primary btnbuy' name='update'>BUY</button>
 <button type='button' id='cancelbtn' onclick="."\"document.getElementById('edit').style.display='none';fetchTable();document.getElementById('details').innerHTML='';\""." class='btn btn-danger btncls' name='close'>CLOSE</button>";
 }
}
else {
 echo "
   <p>NOTHING
   TO
   SEE
   HERE
    </p>";
}
mysqli_close($conn);
exit;
}

if($_GET['func']=="cnfbuy"){
$id = htmlspecialchars($_GET['id']);
$qty = htmlspecialchars($_GET['qty']);
$price = htmlspecialchars($_GET['price']);


$conn = mysqli_connect($servername, $username, $password, $dbname);
if  (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "UPDATE harvest,login SET status='Purchased' WHERE login.user_type_id=1 AND login.loginstring='$loginString' AND harvest.id=$id";

$sql2 = "INSERT INTO transaction (harvest_id,price,qty_kg) VALUES ($id,$price,$qty)";

if (mysqli_query($conn, $sql)&&mysqli_affected_rows($conn)>0)
{
  if (mysqli_query($conn, $sql2)&&mysqli_affected_rows($conn)>0) {
    echo 1;
  }
  else {
    echo 0;
    exit;
  }
}
else {
  echo 0;
}
mysqli_close($conn);
exit;
}

 ?>
