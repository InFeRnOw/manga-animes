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
            $side = "left";
            $color = "gray";
          }
          else {
            /* Style pour l'ami */
            $side = "right";
            $color = "green";
          }
          /* N'hésite modifier cette section pour rendre le css pour beau */
             echo "<div id='postBox' style='text-align: ".$side.";'>
                  <div style='background-color: ".$color."; width: auto;'>
                    <p>" .$row['chat_room_text']. "</p>
                  </div>
            </div>";
        }
