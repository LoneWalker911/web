<?php
error_reporting(0);
include '../../../cookiechk.php';
if($user_type!="Farmer") header("Location:/web/signin");
include 'process.php';
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="shortcut icon" href="https://www.keellssuper.com/favicon.ico">
    <meta charset="utf-8">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="/web/forms.css">

    <title>Add your harvest</title>
  </head>
  <body>
    <form class="form-add-harvest" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
      <h1 class="h3 mb-3 font-weight-normal">ADD HARVEST</h1>
      <label for="inputcrop" class="sr-only">Select Crop Type</label>
      <select name="crop"  class="form-control"  required>
         <?php
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        $sql = "SELECT id, crop_type FROM crop ORDER BY crop_type ASC";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {

        while($row = mysqli_fetch_assoc($result)) {
        echo "<option class='form-control'  value=".$row['id'].">".$row['crop_type']."</option>";
          }
        }
        else {
          echo "<option value=''>Database Error</option>";
        }
        mysqli_close($conn);
         ?>
      </select>
      <br>
      <label for="inputquantity" class="sr-only">Quantity(Min 1KG)</label>
      <input type="number" class="form-control" required name="qty" min="1" value="1" step=".1">
      <br>
      <label for="inputprice" class="sr-only">Price(LKR-PerKG)</label>
      <input class="form-control" type="number" required name="price" min="1" value="0" step=".01">
      <br>
      Select image to upload: (3MB Max)<br>
      <label class="sr-only">Picture 1</label>
      <input required type="file" name="pic1" class="form-control" >
      <ul class="error"><?php echo $pic1error; ?></ul>
      <br>
      <label class="sr-only">Picture 2</label>
      <input type="file" name="pic2" class="form-control" >
      <p class="error"><?php echo $pic2error; ?></p>
      <br>
      <label class="sr-only">Picture 3</label>
      <input type="file" name="pic3" class="form-control" >
      <p class="error"><?php echo $pic3error; ?></p>
      <br>
      <label class="sr-only">Picture 4</label>
      <input type="file" name="pic4" class="form-control" >
      <p class="error"><?php echo $pic4error; ?></p>
      <br>
      <label class="sr-only">Picture 5</label>
      <input type="file" name="pic5" class="form-control" >
      <p class="error"><?php echo $pic5error; ?></p>
      <br>
      <p class="error"> <?php echo $formError; ?> </p>
      <input id="harvestcancel" class="btn btn-lg btn-warning btn-block" type="reset"  value="Reset">
      <input id="harvestsubmitbtn" class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="Submit">
    </form>
  </body>
</html>
