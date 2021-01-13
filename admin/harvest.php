<!DOCTYPE html>
<html>
<head>
<style>
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
  background-color: #4CAF50;
  color: white;
}
</style>
</head>
<body>

<h2>Harvest</h2>

<table>
  <tr>
    <th>ID</th>
    <th>Crop type</th>
    <th>Quantity(KG)</th>
    <th>Price</th>
    <th>Flag code</th>
    <th>Farmer name</th>
    <th>Date</th>
    <th>Status</th>
  </tr>
  <?php
    require '../dbcon.php';
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT harvest.id, crop.crop_type, trim(qty_kg)+0 AS qty, price, flag_code, farmer.name, harvest.date, harvest.status FROM harvest,crop,farmer WHERE farmer_id=farmer.nic  AND harvest.crop_type_id=crop.id ORDER BY harvest.date DESC";

    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0){
      while($row = mysqli_fetch_assoc($result))
      {
        echo "<tr>
          <td>".$row['id']."</td>
          <td>".$row['crop_type']."</td>
          <td>".$row['qty']."</td>
          <td>".$row['price']."</td>
          <td>".$row['flag_code']."</td>
          <td>".$row['name']."</td>
          <td>".date("d/m/Y", strtotime($row["date"]))."</td>
          <td>".$row['status']."</td>
        </tr>";
      }
    }

    ?>
  
</table>

</body>
</html>
