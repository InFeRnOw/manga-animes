<?php
session_start();
include 'dbh-inc.php';
$chatRoomId = $_SESSION['roomid'];
$user = $_SESSION['u_uid'];
$sql = "SELECT * FROM chat WHERE chat_room_id='$chatRoomId' ORDER BY id ASC";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$resultCheck = mysqli_num_rows($result) - 1;
for ($i = 1; $i <= $resultCheck; $i++) {
    $row = mysqli_fetch_assoc($result);
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
    } //$user == $sender
    else {
        /* Style pour l'ami */
        $float = "left";
        $floatInv = "right";
        $class = "msg darker";
    }
    /* N'hésite modifier cette section pour rendre le css pour beau */
    $id = $senderId;
    $sqlImg = "SELECT * FROM profileimg WHERE userid='$id'";
    $resultImg = mysqli_query($conn, $sqlImg);
    if ($rowImg = mysqli_fetch_assoc($resultImg)) {
        if ($rowImg['status'] == 0) {
            $filename = "uploads/profile" . $id . "*";
            $fileinfo = glob($filename);
            $fileext = explode(".", $fileinfo[0]);
            $fileActualExt = $fileext[1];
            $img = '<img class="avatarOfUser ' . $float . '" src="../uploads/profile' . $id . '.jpg">';
        } //$rowImg['status'] == 0
        else {
            $img = '<img class="avatarOfUser ' . $float . '" src="images/symbol_questionmark.png">';
        }
    } //$rowImg = mysqli_fetch_assoc($resultImg)
    echo '<style>
                    .msg {
                        border: 2px solid #dedede;
                        background-color: #f1f1f1;
                        border-radius: 5px;
                        padding: 10px;
                        margin: 10px 0;
                        max-width: 100%;
                        height: auto;
                        min-height: 6.2em;
                    }

                    /* Darker chat container */
                    .darker {
                        border-color: #ccc;
                        background-color: #ddd;
                    }

                    /* Style images */
                    .msg img {
                        float: left;
                        width: 5em;
                        height: 5em;
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
                        color: #aaa;
                        bottom: 0;
                        position: absolute;
                        right: 0;
                    }

                    /* Style time text */
                    .time-left {
                        float: left;
                        color: #999;
                        bottom: 0;
                        position: absolute;
                    }
                  </style>
                  <div class="' . $class . '" style="text-align:' . $floatInv . '; word-wrap: break-word; position: relative;">
                    ' . $img . '
                      <p>' . $text . '</p>
                    <span class="time-' . $floatInv . '">' . $timeH . ' (' . $timeD . ')</span>
                </div>';
} //$i = 1; $i <= $resultCheck; $i++
