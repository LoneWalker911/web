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

<h2>Transactions</h2>

<table>
  <tr>
    <th>ID</th>
    <th>Harvest ID</th>
    <th>Price</th>
    <th>Quantity</th>
    <th>Date</th>
  </tr>
  <?php
    require '../dbcon.php';
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT id,harvest_id,price,qty_kg,date FROM transaction";

    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0){
      while($row = mysqli_fetch_assoc($result))
      {
        echo "<tr>
          <td>".$row['id']."</td>
          <td>".$row['harvest_id']."</td>
          <td>".$row['price']."</td>
          <td>".$row['qty_kg']."</td>
          <td>".date("d/m/Y", strtotime($row["date"]))."</td>
        </tr>";
      }
    }

    ?>

</table>

</body>
</html>
