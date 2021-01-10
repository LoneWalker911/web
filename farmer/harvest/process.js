var modal = document.getElementById("edit");
var modal1 = document.getElementById('del');
//var span = document.getElementsByClassName("close-modal")[0];

var localid = "";

function Edit(id)
{
  localid = id;
  modal.style.display = "block";
  document.getElementById('details').innerHTML="<label for='qty'>Quantity</label> "+
        "<input type='text' value='Loading...'> <span>kg (Min. 1kg)</span> <br>"+
        "<label>Price</label> "+
        "<span>Rs.</span> <input type='text' value='Loading...' > <span>(per kg)</span><br><div id='noti'></div><br>"+
        "<button type='button' class='btn btn-success'>UPDATE</button> "+
        "<button type='button' class='btn btn-danger' >CLOSE</button>";
  var xhttp;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        document.getElementById('details').innerHTML=this.responseText;
    }
  };
  xmlhttp.open("GET", "//localhost/web/ajax/farmer-harvest.php?func=fetchModal&id=" + id, true);
  xmlhttp.send();
}

function Update()
{
  var qty = document.getElementById('qty').value;
  var price = document.getElementById('price').value;
  document.getElementById('upbtn').disabled=true;
  document.getElementById('cancelbtn').disabled=true;
  document.getElementById('noti').innerHTML="<p class='text-info'>Updating...</p>";
  var xhttp;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        if(this.responseText=="1"){
         document.getElementById('noti').innerHTML="<p class='text-success'>Update Complete</p>";
         setTimeout(() => {  document.getElementById('edit').style.display='none'; document.getElementById('details').innerHTML=""; fetchTable(); }, 2000);
        }

        else {
          document.getElementById('noti').innerHTML="<p class='text-danger'>Update Failed. Try Again.</p>";
          setTimeout(() => {  document.getElementById('edit').style.display='none'; document.getElementById('details').innerHTML=""; fetchTable(); }, 2000);
        }
    }
  };
  xmlhttp.open("GET", "//localhost/web/ajax/farmer-harvest.php?func=Update&id=" + localid + "&qty=" + qty + "&price=" + price, true);
  xmlhttp.send();
}

function Remove(id)
{
  document.getElementById("deldiv").innerHTML="<button onclick=\"document.getElementById('del').style.display='none';\" type=\"button\" class=\"btn-Light\">Cancel</button> <button class=\"btn-danger\" onClick=\"Delete("+ id +")\" type=\"button\">Delete</button> <br> <div id=\"msg\"></div>";
  modal1.style.display = "block";
}

function Delete(id)
{
  document.getElementById("msg").innerHTML="<p class='text-info'>Removing...</p>";
    var xhttp;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          if(this.responseText=="1"){
           document.getElementById("msg").innerHTML="<p class='text-success'>Removed</p>";
           setTimeout(() => {  document.getElementById("del").style.display='none';  fetchTable(); }, 2000);
          }

          else {
            document.getElementById("msg").innerHTML="<p class='text-danger'>Removing Failed. Try Again.</p>";
            setTimeout(() => {  document.getElementById("del").style.display='none'; fetchTable(); }, 2000);
          }
      }
    };
    xmlhttp.open("GET", "//localhost/web/ajax/farmer-harvest.php?func=Remove&id=" + id, true);
    xmlhttp.send();
}


// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    fetchTable();
    modal.style.display = "none";
    document.getElementById('details').innerHTML="";
  }
}

window.onclick = function(event) {
  if (event.target == modal1) {
    modal1.style.display = "none";
  }
}

function fetchTable() {
  document.getElementById('table').innerHTML="<tbody><tr><th>ID</th><th>Harvest Type</th><th>Quantity</th><th>Listed Price</th><th>Listed Date</th><th>Flag</th><th>Status</th></tr><tr><td>Loading...</td><td>Loading...</td><td>Loading...</td><td>Loading...</td><td>Loading...</td><td>Loading...</td><td>Loading...</td></tr></tbody>";
  var xhttp;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        document.getElementById('table').innerHTML=this.responseText;
    }
  };
  xmlhttp.open("GET", "//localhost/web/ajax/farmer-harvest.php?func=fetchTable", true);
  xmlhttp.send();
}

fetchTable();
