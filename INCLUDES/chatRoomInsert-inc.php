<?php
session_start();
    include 'dbh-inc.php';
    $actualUser = $_SESSION['u_uid'];

    $sql = "SELECT * FROM chatrooms WHERE chat_to = '$actualUser' OR chat_from = '$actualUser' ORDER BY chat_id DESC";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)) {
        if ($row['chat_from'] == $actualUser) {
          $friend = $row['chat_to'];
          $sql3 = "SELECT * FROM chatrooms WHERE chat_to = '$friend' OR chat_from = '$actualUser' ORDER BY chat_id DESC";
          $result3 = mysqli_query($conn, $sql3);
          $row3 = mysqli_fetch_assoc($result3);
          $chatRoomId = $row3['chat_id'];
        }
        else {
          $friend = $row['chat_from'];
          $sql3 = "SELECT * FROM chatrooms WHERE chat_to = '$actualUser' OR chat_from = '$friend' ORDER BY chat_id DESC";
          $result3 = mysqli_query($conn, $sql3);
          $row3 = mysqli_fetch_assoc($result3);
          $chatRoomId = $row3['chat_id'];
        }
        $sql2 = "SELECT * FROM profiles WHERE pf_user = '$friend'";
        $results = mysqli_query($conn, $sql2);
        $rows = mysqli_fetch_assoc($results);
        $friendLink = $rows['pf_link'];


         echo "<form id='formFriend' action='INCLUDES/friendFonctions-inc.php' method='POST'>
                <div class='container-fluid'>
                  <div class='row'>
                    <div class='col-xs-3'><img id='friendImg' src='uploads/profile".$friendLink.".jpg' alt='friend img'/></div>
                    <div class='col-xs-6'><a class='link' href='profile.php?link=$friendLink'><p><input type='hidden' name='friend' value='".$friend."' />".$friend."</p></a></div>
                    <div class='col-xs-3'>
                        <input type='hidden' name='chatroom' value='".$chatRoomId."'/>
                        <button class='btn btn-primary glyphicon glyphicon-resize-full' type='submit' name='chatOpen'></button>
                    </div>
                  </div>
                </div>
              </form>
            </br>";
    }
