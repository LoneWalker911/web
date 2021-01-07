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
              </div>
              <div id="srcdiv" class="inbox_chat">
              </div>
            </div>

            <div class="mesgs">
              <div id="msgs" class="msg_history"></div>
              <div class="type_msg">
                <div class="input_msg_write">
                  <input type="text" class="write_msg" id="msg" placeholder="Type a message" />
                  <button class="msg_send_btn" onclick="sendMsg();" type="button" id="sendbtn"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                </div>
              </div>
            </div>
          </div>
        </div></div></div>
        <script src="msg.js"></script>
        <?php // the message
$msg = "First line of text\nSecond line of text";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
mail("thisara.gunathilaka@gmail.com","My subject",$msg); ?>
  </body>
</html>
