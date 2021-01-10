        <?php
        require '../dbcon.php';
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT harvest.id,farmer.nic,farmer.name,crop.crop_type,qty_kg,price,picture_1,date FROM harvest, crop,farmer WHERE harvest.crop_type_id=crop.id AND harvest.farmer_id=farmer.nic AND  harvest.expiry_timestamp > NOW() ORDER BY harvest.date DESC,farmer_id";

        $result = mysqli_query($conn, $sql);
        $temp_id="";
        $output="";
        $districtdiv="";
        $cropdiv="";
        $crop2div="";
        $datediv="";
        $picdiv="";
        if (mysqli_num_rows($result) > 0){
          while($row = mysqli_fetch_assoc($result)) {

            if($temp_id==$row["nic"]){
               $cropdiv .= "<p><small><li>".$row['crop_type']." ".$row['qty_kg']."kg Rs:".$row['price']."/kg</li></small></p>";
              continue;
            }
            else {
              $output .= $districtdiv.$cropdiv.$datediv.$picdiv;
            }
            $pic = $row['picture_1'];
            $date = date("d.m.y", strtotime($row["date"]));
            $temp_id=$row["nic"];
            $districtdiv = "<div class=\"row\" style=\"display:table-row;width:100%\"><ul class=\"col\">
              <a  class=\"list-group-item list-group-item-action d-flex justify-content-between align-items-center\">
                <div class=\"col\" style=\"font-weight:bold\">".$row['name'];
              $cropdiv="<p><small><li>".$row['crop_type']." ".$row['qty_kg']."kg Rs:".$row['price']."/kg</li></small></p>";
              $datediv="<span class=\"badge badge-info badge-pill\"> ".$date."</span>
            </div>";
              $picdiv="<div class=\"image-parent\" style=\"float:right\"><img src=\"".$pic."\" class=\"img-thumbnail\" alt=\"quixote\">
              </div>
            </a>
              </ul>
      </div>";
          }
          $output .= $districtdiv.$cropdiv.$datediv.$picdiv;
          echo $output;
        }
        mysqli_close($conn);

         ?>
</table>

    </div>
</body>
