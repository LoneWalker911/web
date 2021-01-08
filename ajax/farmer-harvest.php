<?php
require '../dbcon.php';
$loginString = htmlspecialchars($_COOKIE['usr']);

if($_GET['func']=="fetchTable"){
$conn = mysqli_connect($servername, $username, $password, $dbname);

$sql = "SELECT harvest.id, crop.crop_type, trim(qty_kg)+0 AS qty, price, flag_code, date, expiry_timestamp, status FROM harvest,crop,login WHERE farmer_id=login.username AND login.loginstring='$loginString' AND harvest.crop_type_id=crop.id ORDER BY harvest.date DESC";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  echo "<tr>
    <th>ID</th>
    <th>Harvest Type</th>
    <th>Quantity</th>
    <th>Listed Price</th>
    <th>Listed Date</th>
    <th>Flag</th>
    <th>Status</th>
  </tr>";
while($row = mysqli_fetch_assoc($result)) {
 $date = date("d/m/Y", strtotime($row["date"]));
 echo "<tr>";
 echo   "<td>".$row['id']."</td>";
 echo   "<td>".$row['crop_type']."</td>";
 echo   "<td>".$row['qty']."kg</td>";
 echo   "<td>LKR ".$row['price']."</td>";
 echo   "<td>".$date."</td>";
 echo   "<td></td> ";//FLAG
 if(strtotime($row['expiry_timestamp']) < time()){
   echo "<td><p class='text-danger'>Expired</p></td>";
 }
 else if($row['status']=="Purchased"){
   echo "<td><p class='text-success'>Purchased</p></td>";
 }
 else if($row['status']=="Removed"){
   echo "<td><p class='text-danger'>Removed</p></td>";
 }
 else
 {
 echo   "<td class='btn-group' role='group'><button type='button'onClick='Edit(".$row['id'].");' class='btn btn-outline-primary'>Edit</button>"."";
 echo   "<button type='button' onClick='Remove(".$row['id'].");' class='btn btn-outline-danger'>Remove</button>"."</td></tr>";}
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
exit;
}

if($_GET['func']=="fetchModal"){
$conn = mysqli_connect($servername, $username, $password, $dbname);
$id = $_GET['id'];
$sql = "SELECT trim(qty_kg)+0 AS qty, price FROM harvest,login WHERE status IS NULL AND farmer_id=login.username AND login.loginstring='$loginString' AND harvest.id=$id";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
while($row = mysqli_fetch_assoc($result)) {


 echo "<label for='qty'>Quantity</label>";
 echo "
 <input type='number' id='qty' required name='qty' min='1' value='".$row["qty"]."' step='.1'> <span>kg (Min. 1kg)</span><br>
 <label for='price'>Price</label>
 <span>Rs.</span>
 <input type='number' id='price'  required name='price' min='1' value='".$row["price"]."' step='.01'>
 <span>(per kg)</span>
 <br>
 <div id='noti'></div>
 <br> <button type='button' id='upbtn' onclick='Update();'class='btn btn-success' name='update'>UPDATE</button>
 <button type='button' id='cancelbtn' onclick="."\"document.getElementById('edit').style.display='none';fetchTable();document.getElementById('details').innerHTML='';\""." class='btn btn-danger' name='close'>CLOSE</button>";
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


if($_GET['func']=="Update"){
$id = $_GET['id'];
$qty = $_GET['qty'];
$price = $_GET['price'];

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


$sql = "UPDATE harvest,login SET qty_kg=$qty, price=$price WHERE farmer_id=login.username AND login.loginstring='$loginString' AND harvest.id=$id";

if (mysqli_query($conn, $sql))
{
  echo 1;
}
else {
  echo 0;
}
mysqli_close($conn);
exit;
}

if($_GET['func']=="Remove"){
$id = $_GET['id'];


$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


$sql = "UPDATE harvest,login SET status='Removed' WHERE Status IS NULL AND farmer_id=login.username AND login.loginstring='$loginString' AND harvest.id=$id";

if (mysqli_query($conn, $sql))
{
  echo 1;
}
else {
  echo 0;
}
mysqli_close($conn);
exit;
}

?>
