<?php
session_start();
    include 'dbh-inc.php';

      $chatRoomId = $_SESSION['roomid'];
      $user = $_SESSION['u_uid'];

      $sql = "SELECT * FROM chat WHERE chat_room_id='$chatRoomId' ORDER BY id ASC";
      $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_assoc($result)) {
          $sender = $row['chat_room_sender'];
          if ($user == $sender) {
            /* Style pour le vrai utilisateur */
            $float = "right";
            $color = "white";
            
          }
          else {
            /* Style pour l'ami */
            $float = "left";
            $color = "hsl(204, 100%, 65%)";
          }
          /* N'hésite modifier cette section pour rendre le css pour beau */
             echo "<div id='postBox' style='text-align: ".$side.";'>
                   <div style='background-color: ".$color."; display: none; padding: 0px 10px 0px 10px; border-radius: 2px; font-size: 12px; ".$float."; '>
                    <p>" .$row['chat_room_text']. "</p>
                  </div>
            </div>";
        }
