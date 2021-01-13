<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style>
.dropbtn {
  background-color: #4CAF50;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown:hover .dropbtn {
  background-color: #3e8e41;
}
</style>

  </head>
  <body>
    <div class="dropdown">
  <button class="dropbtn">Select the report type :</button>
  <div class="dropdown-content">
  <a onclick="report1();">Farmer</a>
  <a onclick="report2();">Harvest</a>
  <a onclick="report3();">Staff</a>
  <a onclick="report4();">Transactions</a>
  </div>
</div>
<div id="table" class="admin-table">


</div>
<script type="text/javascript">
function report1()
{
  var xhttp;
  document.getElementById("table").innerHTML = "<p class'loading-txt'>Loading...</p>";
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("table").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "//localhost/web/admin/admin-farmer.php", true);
  xhttp.send();
}

function report2()
{
  var xhttp;
  document.getElementById("table").innerHTML = "<p class'loading-txt'>Loading...</p>";
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("table").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "//localhost/web/admin/harvest.php", true);
  xhttp.send();
}

function report3()
{
  var xhttp;
  document.getElementById("table").innerHTML = "<p class'loading-txt'>Loading...</p>";
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("table").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "//localhost/web/admin/staff.php", true);
  xhttp.send();
}

function report4()
{
  var xhttp;
  document.getElementById("table").innerHTML = "<p class'loading-txt'>Loading...</p>";
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("table").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "//localhost/web/admin/transaction.php", true);
  xhttp.send();
}
</script>


  </body>
</html>
