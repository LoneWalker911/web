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

<h2>Farmer</h2>

<table>
  <tr>
    <th>NIC</th>
    <th>Name</th>
    <th>Mobile</th>
    <th>Address</th>
    <th>E-mail</th>
    <th>Regtraion date</th>
  </tr>
  <?php
  require '../dbcon.php';
  $conn = mysqli_connect($servername, $username, $password, $dbname);

  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  $sql = "SELECT nic,name,mobile,address1,address2,email,reg_date FROM farmer";

  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result))
    {
      echo "<tr>
        <td>".$row['nic']."</td>
        <td>".$row['name']."</td>
        <td>".$row['mobile']."</td>
        <td>".$row['address1'].", ".$row['address2']."</td>
        <td>".$row['email']."</td>
        <td>".date("d/m/Y", strtotime($row["reg_date"]))."</td>
      </tr>";
    }
  }

  ?>

</table>

</body>
</html>
