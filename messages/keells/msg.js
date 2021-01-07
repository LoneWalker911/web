var id="";
var temp="";
var arr = [];

function test(th){
  id=th;
  console.log("RUN"+id+" "+temp);
  var xhttp;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        document.getElementById('msgs').innerHTML=this.responseText;
    }
  };
  xmlhttp.open("GET", "//localhost/web/ajax/messageprocess.php?func=keells_check&id=" + id, true);
  xmlhttp.send();
  arr.map((a) => {
    clearInterval(a);
    arr = [];
  })
  checkMsg();
}

function checkMsg() {
  temp=id;
  arr.push(setInterval(function() {
    console.log("RUN"+id+" "+temp);
    var xhttp;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          document.getElementById('msgs').innerHTML=this.responseText;
      }
    };
    xmlhttp.open("GET", "//localhost/web/ajax/messageprocess.php?func=keells_check&id=" + id, true);
    xmlhttp.send();
  },3000));
}

function fetchContacts() {
  var xhttp;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        document.getElementById('srcdiv').innerHTML=this.responseText;
    }
  };
  xmlhttp.open("GET", "//localhost/web/ajax/messageprocess.php?func=keells_contacts", true);
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
        checkMsg(usrid);
    }
  };
  xmlhttp.open("POST", "//localhost/web/ajax/messageprocess.php", true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send("func=keells_send&message=" + message +"&rec="+usrid);
}}


fetchContacts();
setInterval(function() {fetchContacts();}, 3000);
