<?php include '../../../cookiechk.php';
if($user_type!="Farmer") header("Location:/web/signin");
require 'process.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Add your harvest</title>
  </head>
  <body>
    <form class="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
      <label for="crop">Crop</label>
      <select name="crop">
         <?php
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        $sql = "SELECT id, crop_type FROM crop ORDER BY crop_type ASC";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {

        while($row = mysqli_fetch_assoc($result)) {
        echo "<option value=".$row['id'].">".$row['crop_type']."</option>";
          }
        }
        else {
          echo "<option value=''>Database Error</option>";
        }
        mysqli_close($conn);
         ?>
      </select>
      <br>
      <label>Quantity</label>
      <input type="number" required name="qty" min="1" value="1" step=".1"><span>kg (Min. 1kg)</span>
      <br>
      <label>Price</label>
      <span>Rs.</span><input type="number" required name="price" min="1" value="0" step=".01"><span>(per kg)</span>
      <br>
      Select image to upload: (3MB Max)<br>
      <label>Picture 1</label>
      <input required type="file" name="pic1">
      <ul class="error"><?php echo $pic1error; ?></ul>
      <br>
      <label>Picture 2</label>
      <input type="file" name="pic2">
      <p class="error"><?php echo $pic2error; ?></p>
      <br>
      <label>Picture 3</label>
      <input type="file" name="pic3">
      <p class="error"><?php echo $pic3error; ?></p>
      <br>
      <label>Picture 4</label>
      <input type="file" name="pic4">
      <p class="error"><?php echo $pic4error; ?></p>
      <br>
      <label>Picture 5</label>
      <input type="file" name="pic5">
      <p class="error"><?php echo $pic5error; ?></p>
      <br>
      <p class="error"> <?php echo $formError; ?> </p>
      <input type="submit" name="submit" value="Upload">
    </form>
  </body>
</html>