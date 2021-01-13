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

<h2>Staff</h2>

<table>
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Mobile</th>
    <th>Address</th>
    <th>E-mail</th>
    <th>Type</th>
    <th>Regtraion date</th>
  </tr>
<?php
  require '../dbcon.php';
  $conn = mysqli_connect($servername, $username, $password, $dbname);

  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  $sql = "SELECT staff.id,name,mobile,address,email,user_type.type,reg_date FROM staff,user_type WHERE staff.type=user_type.id";

  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result))
    {
      echo "<tr>
        <td>".$row['id']."</td>
        <td>".$row['name']."</td>
        <td>".$row['mobile']."</td>
        <td>".$row['address']."</td>
        <td>".$row['email']."</td>
        <td>".$row['type']."</td>
        <td>".date("d/m/Y", strtotime($row["reg_date"]))."</td>
      </tr>";
    }
  }

  ?>

</table>

</body>
</html>
