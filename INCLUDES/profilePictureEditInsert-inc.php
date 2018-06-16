<?php
$id = $_SESSION['u_id'];
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    if ($row = mysqli_fetch_assoc($result)) {
        $id = $_SESSION['u_id'];
        $sqlImg = "SELECT * FROM profileimg WHERE userid='$id'";
        $resultImg = mysqli_query($conn, $sqlImg);
        if ($rowImg = mysqli_fetch_assoc($resultImg)) {
            if ($rowImg['status'] == 0) {
                $filename = "uploads/profile" . $id . "*";
                $fileinfo = glob($filename);
                $fileext = explode(".", $fileinfo[0]);
                $fileActualExt = $fileext[1];
                // echo '<div class="container-fluid">
                //   <div class="row">
                //     <div class="col-lg-12 col-xs-12">
                //       <img class="avatarOfUser" src="../uploads/profile'.$id.'.'.$fileActualExt.'?'.mt_rand().'">
                //       <p style="font-size:12px;">Only jpg, jpeg, png and ico is supported</p>
                //     </div>
                //   </div>
                //       <form action="INCLUDES/upload-inc.php" method="POST" enctype="multipart/form-data">
                //         <div class="row">
                //         <div class="col-lg-4 col-xs-1"></div>
                //           <div class="col-lg-4 col-xs-10"><input class="fileSelector btn btn-basic" type="file" name="avatar" style="width: 100%; margin-left: 0;"></div>
                //           <div class="col-lg-4 col-xs-1"></div>
                //           </div>
                //           <div class="row">
                //           <div class="col-lg-12 col-xs-12"><button class="fileSubmit button" type="submit" name="submit" style="border: 2px solid green">Save image</button></div>
                //         </div>
                //       </form>
                //     </div>
                //     </br>
                //   <div class="col-lg-12 col-xs-12">
                //     <form action="INCLUDES/delete-inc.php" method="POST">
                //         <button class="fileDelete button" type="submit" name="submit" style="border: 2px solid red">Delete image</button>
                //     </form>
                //   </div>
                //   </br>
                // </br>';
                echo '<div class="row">
                                <div class="col-lg-12 col-xs-12">
                                  <img class="profile-avatar" src="../uploads/profile' . $id . '.jpg">
                                  <p style="font-size:12px;">Only jpg is supported and max 10MB</p>
                                </div>
                              </div>
                              <div class="row">
                                <form action="INCLUDES/upload-inc.php" method="POST" enctype="multipart/form-data">
                                  <div class="col-md-6 col-xs-12">
                                    <input class="btn btn-basic center-block" type="file" name="avatar">
                                  </div>
                                  <div class="col-md-3 col-xs-12">
                                    <button class="btn btn-success center-block" type="submit" name="submitProfile">Save</button>
                                  </div>
                                </form>
                                  <div class="col-md-3 col-xs-12">
                                <form action="INCLUDES/delete-inc.php" method="POST">
                                    <button class="btn btn-danger center-block" type="submit" name="submitProfile">Delete</button>
                                </form>
                                  </div>
                              </div>';
            } //$rowImg['status'] == 0
            else {
                echo '<div class="row">
                                <div class="col-lg-12 col-xs-12">
                                  <img class="profile-avatar" src="CSS/images/symbol_questionmark.png">
                                  <p style="font-size:12px;">Only jpg is supported and max 10MB</p>
                                </div>
                              </div>
                            <form action="INCLUDES/upload-inc.php" method="POST" enctype="multipart/form-data">
                              <div class="row">
                                <div class="col-md-6 col-xs-12">
                                  <input class="btn btn-basic center-block" type="file" name="avatar">
                                </div>
                                <div class="col-md-6 col-xs-12">
                                  <button class="btn btn-success center-block" type="submit" name="submitProfile">Save image</button>
                                </div>
                            </form>';
            }
        } //$rowImg = mysqli_fetch_assoc($resultImg)
    } //$row = mysqli_fetch_assoc($result)
} //mysqli_num_rows($result) > 0
