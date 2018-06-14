<?php
session_start();

echo '<!-- Logo -->
        <h1><a href="index.php" id="logo" class="link hidden-xs">Manga-Animes</a></h1>

      <!-- Nav -->
        <nav class="navbar navbar-default">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
                <a class="navbar-brand visible-xs" href="index.php">Manga-Animes</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
              <ul class="nav navbar-nav">
              <li><a href="index.php">Home</a></li>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Correspondence<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="top-animes.php">Top animes</a></li>
                  <li><a href="alphabetic-order.php">Alphabetic Order</a></li>
                  <li><a href="in-vote.php">In vote</a></li>
                </ul>
              </li>
              <li><a href="news.php">News</a></li>
              <li><a href="donate.php">Donate</a></li>
              <li><a href="contact.php">Contact</a></li>
              </ul>
              <ul class="nav navbar-nav navbar-right">';

              if (!isset($_SESSION['u_id'])) {
                  echo '<li><a href="register.php">Signup</a></li>
                        <li><a href="login.php">Login</a></li>
                      </ul>
                    </div>
                  </div>
                </nav>';
              }
              else {
                $id = $_SESSION['u_id'];

                $sqlImg = "SELECT * FROM profileimg WHERE userid='$id'";
                $resultImg = mysqli_query($conn, $sqlImg);
                $rowImg = mysqli_fetch_assoc($resultImg);

                if ($rowImg['status'] == 0) {
                  $source = "../uploads/profile".$id.".jpg";
                }
                else {
                  $source = "CSS/images/symbol_questionmark.png";
                }
                echo '<li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><img id="nav-avatar" src="'.$source.'" alt="profile pic"/>'.$_SESSION['u_uid'].'<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a href="profile.php?link='.$id.'">Profile</a></li>
                          <li><a href="friend.php?link='.$id.'">Friends</a></li>
                          <li><a href="settings.php?link='.$id.'">Settings</a></li>
                          <li><a href="login.php?logout=success">Logout</a></li>
                        </ul>
                      </li>
                    </ul>
                  </div>
                </div>
              </nav>';
              }
