<?php
require '../../cookiechk.php';
require '../../dbcon.php';
if($user_type!="Keells") {header("Location:/web/signin");}
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

?><!DOCTYPE html>
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
        <?php if(isset($_REQUEST['nic']))
        {
          echo "<script>test(".$_REQUEST['nic'].");</script>";
        } ?>
  </body>
</html>
