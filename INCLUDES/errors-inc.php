<?php
/* LOGIN */
if(!isset($_GET['login']) && !isset($_GET['register']) && !isset($_GET['link']) || $_GET['register'] == "success") {
  echo "<h1>Login</h1>";
  if(isset($_GET['account']) && $_GET['account'] == "activated") {
    $accountCheck = $_GET['account'];
    echo "<p style='color: green;'>Account activatation success. Welcome on manga-animes !</p>";
  }
  else if (isset($_GET['register']) && $_GET['register'] == "success") {
    echo "<p style='color: green;'>Registration success. Please check your emails !</p>";
  }
}
else if(isset($_GET['login'])){
  $loginCheck = $_GET['login'];
  $accountCheck = $_GET['account'];
    if($loginCheck == "empty") {
      echo "<h1>Login</h1>
      <p style='color: red;'>Some fields are empty !</p>";
    }
    elseif ($loginCheck == "notactivated") {
      echo "<h1>Login</h1>
      <p style='color: red;'>Your account must be activated first !</p>";
    }
    elseif ($loginCheck == "error") {
      echo "<h1>Login</h1>
      <p style='color: red;'>Password or username not valid !</p>";
    }
}
/* REGISTER */
else if(isset($_GET['register']) && $_GET['register'] !== "success") {
  $registerCheck = $_GET['register'];
    echo "<h1>Register</h1>";

    if($registerCheck == "empty") {
      echo "<p style='color: red;'>Some fields are empty !</p>";
    }
    elseif ($registerCheck == "emailinvalid") {
      echo "<p style='color: red;'>Invalid email !</p>";
    }
    elseif ($registerCheck == "emailtaken") {
      echo "<p style='color: red;'>Email is already used !</p>";
    }
    elseif ($registerCheck == "usernametaken") {
      echo "<p style='color: red;'>Username is already used !</p>";
    }
    elseif ($registerCheck == "passwordconfirm") {
      echo "<p style='color: red;'>Passwords do not match !</p>";
    }
    elseif ($registerCheck == "specialchars") {
      echo "<p style='color: red;'>Special characters are not allowed !</p>";
    }
}

/* FRIENDS */

else if(isset($_GET['link']) && isset($_GET['add']) || isset($_GET['request'])) {
  $addCheck = $_GET['add'];
  $requestCheck = $_GET['request'];

    if($addCheck == "error") {
      echo "<p style='color: red;'>You can't add yourself or nothing !</p>";
    }
    elseif ($addCheck == "noexist") {
      echo "<p style='color: red;'>User doesn't exist !</p>";
    }
    elseif ($addCheck == "userNotActive") {
      echo "<p style='color: red;'>User didn't activate his account !</p>";
    }
    elseif ($addCheck == "alreadyAdded") {
      echo "<p style='color: red;'>User is your already your friend !</p>";
    }
    elseif ($addCheck == "success") {
      echo "<p style='color: green;'>User successfully added !</p>";
    }
    elseif ($requestCheck == "accepted") {
      echo "<p style='color: green;'>Friend request successfully accepted !</p>";
    }
    elseif ($requestCheck == "refused") {
      echo "<p style='color: green;'>Friend request successfully refused !</p>";
    }
    elseif ($requestCheck == "deleted") {
      echo "<p style='color: green;'>Friend successfully deleted !</p>";
    }
}
