function checkMsg() {
  var xhttp;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        document.getElementById('msgs').innerHTML=this.responseText;
        console.log("GG");
    }
  };
  xmlhttp.open("GET", "//localhost/web/ajax/messageprocess.php?func=farmer_check", true);
  xmlhttp.send();
}

function sendMsg() {
  var xhttp;
  var message = document.getElementById('msg').value;
  if(message!=""){
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        document.getElementById('msg').value="";
        checkMsg();
    }
  };
  xmlhttp.open("GET", "//localhost/web/ajax/messageprocess.php?func=farmer_send&message=" + message, true);
  xmlhttp.send();
}}

checkMsg();
setInterval(function() {checkMsg();}, 3000);
