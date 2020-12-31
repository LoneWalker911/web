<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="test.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title></title>
  </head>
  <body>
    <div class="infolist">
      <table style="width:25%">
        <tr>
          <td><div class="w3-content w3-display-container" style="max-width:800px">
  <img class="mySlides" src="veg.jpg" width="100%" height="200">
  <img class="mySlides" src="veg2.jpg" width="100%" height="200">
  <img class="mySlides" src="veg3.jpg" width="100%" height="200">
  <div class="w3-center w3-container w3-section w3-large w3-text-white w3-display-bottommiddle" style="width:50%">
    <div class="w3-left w3-hover-text-khaki" onclick="plusDivs(-1)">&#10094;</div>
    <div class="w3-right w3-hover-text-khaki" onclick="plusDivs(1)">&#10095;</div>
    <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(1)"></span>
    <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(2)"></span>
    <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(3)"></span>
  </div>
</div>

<script>
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function currentDiv(n) {
  showDivs(slideIndex = n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" w3-white", "");
  }
  x[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " w3-white";
}
</script>
</td></div>
        </tr>
        <tr>
          <td><div class="FName">Farmer name</td>
        </tr>
        <tr>
          <td><div class="listdate">Listed on 20/12/2020</td>
        </tr>
        <tr><td><div class="aaaa">
            <br>
        </div></td>
        </tr>
        <tr>
          <td><div class="Harvesttype"><li>Beans 100KG Rs:150.00/KG</li></div></td>
        </tr>
        <tr>
          <td><div class="Harvesttype"><li>Beans 100KG Rs:150.00/KG</li></div></td>
        </tr>
        <tr>
          <td><div class="Harvesttype"><li>Beans 100KG Rs:150.00/KG</li></div></td>
        </tr>
        <tr>
          <td><div class="Harvesttype"><li>Beans 100KG Rs:150.00/KG</li></div></td>
        </tr>
        <tr><td><div class="aaaa">
            <br>
        </div></td>
        </tr>
        <tr>
          <td><div class="Address"><i class="material-icons">&#xe55f;</i>    NO:102,Urubokka,Matara</div></td>
        </tr>
        <tr>
          <td><div class="phone"><i class="material-icons">&#xe551;</i>    041-2258456</div></td>
        </tr>
        <tr>
        <tr>
          <td><div class="note">Special note from Farmer:<br><br><br></div></td>
        </tr>

          <td><div class="message"><br><br><button class="messagebtn">MESSAGE</button></td>
        </tr>


      </table>

    </div>

  </body>
</html>
