<?php

      $id = $_GET['link'];

      $sql = "SELECT * FROM users";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
          if ($row = mysqli_fetch_assoc($result)) {

              $id = $_GET['link'];

              $sqlImg = "SELECT * FROM profileimg WHERE userid='$id'";
              $resultImg = mysqli_query($conn, $sqlImg);

              if ($rowImg = mysqli_fetch_assoc($resultImg)) {
                      if ($rowImg['status'] == 0) {

                        $filename = "uploads/profile".$id."*";
                        $fileinfo = glob($filename);
                        $fileext = explode(".", $fileinfo[0]);
                        $fileActualExt = $fileext[1];

                        //   echo '<div class="container-fluid">
                        //     <div class="row">
                        //       <div class="col-lg-12 col-xs-12">
                        //         <img class="avatarOfUser" src="../uploads/profile'.$id.'.'.$fileActualExt.'?'.mt_rand().'">
                        //       </div>
                        //     </div>
                        //   </br>
                        // </br>';
                        echo '<div class="row">
                                <div class="col-lg-12 col-xs-12">
                                  <img class="profile-avatar" src="../uploads/profile'.$id.'.jpg">
                                </div>
                              </div>
                            </br>';
                      }
                      else {
                          echo '<div class="row">
                                  <div class="col-lg-12 col-xs-12">
                                    <img class="profile-avatar" src="CSS/images/symbol_questionmark.png">
                                  </div>
                                </div>
                              </br>';
                      }
                    }
                  }
          }
