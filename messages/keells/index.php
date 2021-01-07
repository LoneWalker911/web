<?php require '../../dbcon.php'; ?><!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="style.css">
    <!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <div class="container-fluid">
    <div class="messaging">
          <div class="inbox_msg">
            <div class="inbox_people">
              <div class="headind_srch">
                <div class="recent_heading">
                </div>
                <div class="srch_bar">
                  <div class="stylish-input-group">
                    <input type="text" class="search-bar"  placeholder="Search" >
                    <span class="input-group-addon">
                    <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                    </span> </div>
                </div>
              </div>
              <div class="inbox_chat">
              <?php

              $conn = mysqli_connect($servername, $username, $password, $dbname);
              $loginstring = htmlspecialchars($_COOKIE['usr']);
              $uname="";

              if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
              }


              $sql = "SELECT DISTINCT farmer.name,nic,date_format(timestamp, '%b %d')AS date FROM message,farmer WHERE sender=farmer.nic OR receiver=farmer.nic  ORDER BY timestamp DESC";

              $result = mysqli_query($conn, $sql);
              if (mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                  $id=$row['nic'];
                  echo "<div class='chat_list' onClick='checkMsg($id);'>";
                    echo "<div class='chat_people'>";
                      echo "<div class='chat_ib'>";
                        echo "<h5>".$row['name']."<span class='chat_date'>".$row['date']."</span></h5>";
                        echo "<p>".$id."</p>";
                    echo  "</div></div></div>";
                }
              }
              else {
                echo "<div class='chat_list active_chat'>";
                  echo "<div class='chat_people'>";
                    echo "<div class='chat_ib'>";
                      echo "<h5>"."Database Error"."<span class='chat_date'>"."ERROR"."</span></h5>";
                      echo "<p>"."Please contact admin"."</p>";
                  echo  "</div></div></div>";
              }


              ?>
              </div>
            </div>

            <div class="mesgs">
              <div id="msgs" class="msg_history">
              <div class="type_msg">
                <div class="input_msg_write">
                  <input type="text" class="write_msg" id="msg" placeholder="Type a message" />
                  <button class="msg_send_btn" onclick="sendMsg();" type="button" id="sendbtn"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                </div>
              </div>
            </div>
          </div>
        </div></div>
        <script src="msg.js"></script>
  </body>
</html>
