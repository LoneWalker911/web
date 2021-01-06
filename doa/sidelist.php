<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="sidelist.css">
    <title></title>
  </head>
  <body>
    <div class="list_table">
      <table style="width:25%">
        <?php
        require '../dbcon.php';
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT harvest.id,farmer.name,farmer.nic,crop.crop_type,qty_kg,price,picture_1,date FROM harvest, crop, farmer WHERE harvest.crop_type_id=crop.id AND harvest.farmer_id=farmer.nic AND harvest.expiry_timestamp > NOW() ORDER BY harvest.date DESC,farmer_id";

        $result = mysqli_query($conn, $sql);
        $temp_id="";
        $output="";
        $namediv="";
        $cropdiv="";
        $crop2div="";
        $datediv="";
        $picdiv="";
        if (mysqli_num_rows($result) > 0){
          while($row = mysqli_fetch_assoc($result)) {
            if($temp_id==$row["nic"]){
               $cropdiv .= "<li>".$row['crop_type']." ".$row['qty_kg']."KG Rs:".$row['price']."/KG</li><br>";
              continue;
            }
            else {
              $output .= $namediv.$cropdiv.$datediv.$picdiv;
            }
            $pic = $row['picture_1'];
            $date = date("d.m.y", strtotime($row["date"]));
            $temp_id=$row["nic"];
            $namediv = "<tr><th><div class='Farmer_name'><span>".$row['name']."</span></div><br><div class='Harvest'><ul>";
              $cropdiv="<li>".$row['crop_type']." ".$row['qty_kg']."KG Rs:".$row['price']."/KG</li><br>";
              $datediv="</ul><div class='listed_date'><span>Listed on $date</span></div>
              </div></th>";
              $picdiv="<th><div class='list_image'><img src='".$pic."'></div></th>
            </tr>
            <tr>";
          }
          $output .= $namediv.$cropdiv.$datediv.$picdiv;
          echo $output;
        }
        mysqli_close($conn);

         ?>
</table>

    </div>

  </body>
</html>
