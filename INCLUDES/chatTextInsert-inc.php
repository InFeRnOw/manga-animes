<?php
session_start();
    include 'dbh-inc.php';

      $chatRoomId = $_SESSION['roomid'];
      $user = $_SESSION['u_uid'];

      $sql = "SELECT * FROM chat WHERE chat_room_id='$chatRoomId' ORDER BY id ASC";
      $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_assoc($result)) {
          $sender = $row['chat_room_sender'];
          $text = $row['chat_room_text'];
          $timeH = $row['chat_room_timeh'];
          $timeD = $row['chat_room_timed'];
          $senderId = $row['chat_room_sender_id'];
          if ($user == $sender) {
            /* Style pour le vrai utilisateur */
            $float = "right";
            $floatInv = "left";
            $class = "msg";
          }
          else {
            /* Style pour l'ami */
            $float = "left";
            $floatInv = "right";
            $class= "msg darker";
          }

          /* N'hésite modifier cette section pour rendre le css pour beau */
          $id = $senderId;
          $sqlImg = "SELECT * FROM profileimg WHERE userid='$id'";
          $resultImg = mysqli_query($conn, $sqlImg);
          if ($rowImg = mysqli_fetch_assoc($resultImg)) {
                  if ($rowImg['status'] == 0) {
                    $filename = "uploads/profile".$id."*";
                    $fileinfo = glob($filename);
                    $fileext = explode(".", $fileinfo[0]);
                    $fileActualExt = $fileext[1];
                      $img =  '<img class="avatarOfUser" src="../uploads/profile'.$id.'.'.$fileActualExt.'?'.mt_rand().'">';
                  }
                  else {
                      $img = '<img class="avatarOfUser" src="images/symbol_questionmark.png">';
                  }
                }
          echo '<style>
                  .msg {
                      border: 2px solid #dedede;
                      background-color: #f1f1f1;
                      border-radius: 5px;
                      padding: 10px;
                      margin: 10px 0;
                      max-width: 1350px;
                  }

                  /* Darker chat container */
                  .darker {
                      border-color: #ccc;
                      background-color: #ddd;
                  }

                  /* Style images */
                  .msg img {
                      float: left;
                      max-width: 5em;
                      max-height: 5em;
                      width: 100%;
                      margin-right: 20px;
                      border-radius: 10px;
                  }

                  /* Style the right image */
                  .msg img.right {
                      float: right;
                      margin-left: 20px;
                      margin-right:0;
                  }

                  /* Style time text */
                  .time-right {
                      float: right;
                      color: #aaa;
                  }

                  /* Style time text */
                  .time-left {
                      float: left;
                      color: #999;
                  }
                </style>
                <div class="'.$class.'" style="text-align:'.$floatInv.'">
                  '.$img.'
                  <p>'.$text.'</p>
                  <span class="time-right">'.$timeH.'</span>
                  </br>
                </div>';
        }
