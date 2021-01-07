var id="";
var temp="";
var arr = [];
const messages = document.getElementById('msgs');

function test(th){
  id=th;
  console.log("RUN"+id+" "+temp);
  var xhttp;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      if(document.getElementById('msgs').innerHTML!=this.responseText)
        { console.log(document.getElementById('msgs').innerHTML);
          document.getElementById('msgs').innerHTML=this.responseText;
        scrollToBottom();}
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
        if(document.getElementById('msgs').innerHTML!=this.responseText)
          {document.getElementById('msgs').innerHTML=this.responseText;
          scrollToBottom();}
      }
    };
    xmlhttp.open("GET", "//localhost/web/ajax/messageprocess.php?func=keells_check&id=" + id, true);
    xmlhttp.send();
  },3000));
}

function fetchContacts() {
  var xhttp;
  scrollToBottom();
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      if(document.getElementById('srcdiv').innerHTML!=this.responseText)
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
        test(id);
    }
  };
  xmlhttp.open("GET", "//localhost/web/ajax/messageprocess.php?func=keells_send&message=" + message + "&rec=" + id, true);
  xmlhttp.send();
}}

function scrollToBottom() {
  messages.scrollTop = messages.scrollHeight;
}


fetchContacts();
//setInterval(function() {scrollToBottom();}, 300);
setInterval(function() {fetchContacts();}, 3000);
