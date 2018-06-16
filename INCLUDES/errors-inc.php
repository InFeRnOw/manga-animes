<?php
/* LOGIN */
if (!isset($_GET['login']) && !isset($_GET['register']) && !isset($_GET['link']) && !isset($_GET['edit']) && !isset($_GET['posting']) && !isset($_GET['set']) && !isset($_GET['forget']) && !isset($_GET['recover']) || $_GET['register'] == "success" || $_GET['forget'] == "success" || $_GET['recover'] == "success") {
    if (isset($_GET['account']) && $_GET['account'] == "activated") {
        $accountCheck = $_GET['account'];
        echo "<p style='color: green;'>Account activatation success. Welcome on manga-animes !</p>";
    } //isset($_GET['account']) && $_GET['account'] == "activated"
    else if (isset($_GET['register']) && $_GET['register'] == "success") {
        echo "<p style='color: green;'>Registration success. Please check your emails !</p>";
    } //isset($_GET['register']) && $_GET['register'] == "success"
    else if (isset($_GET['forget']) && $_GET['forget'] == "success") {
        echo "<p style='color: green;'>An email has been sent to your inbox !</p>";
    } //isset($_GET['forget']) && $_GET['forget'] == "success"
    else if (isset($_GET['recover']) && $_GET['recover'] == "success") {
        echo "<p style='color: green;'>Password successfully changed !</p>";
    } //isset($_GET['recover']) && $_GET['recover'] == "success"
} //!isset($_GET['login']) && !isset($_GET['register']) && !isset($_GET['link']) && !isset($_GET['edit']) && !isset($_GET['posting']) && !isset($_GET['set']) && !isset($_GET['forget']) && !isset($_GET['recover']) || $_GET['register'] == "success" || $_GET['forget'] == "success" || $_GET['recover'] == "success"
else if (isset($_GET['login'])) {
    $loginCheck = $_GET['login'];
    $accountCheck = $_GET['account'];
    if ($loginCheck == "empty") {
        echo "<p style='color: red;'>Some fields are empty !</p>";
    } //$loginCheck == "empty"
    elseif ($loginCheck == "notactivated") {
        echo "<h1>Login</h1>
      <p style='color: red;'>Your account must be activated first !</p>";
    } //$loginCheck == "notactivated"
        elseif ($loginCheck == "error") {
        echo "<h1>Login</h1>
      <p style='color: red;'>Password or username not valid !</p>";
    } //$loginCheck == "error"
        elseif ($loginCheck == "same") {
        echo "<h1>Login</h1>
      <p style='color: red;'>New password is the same as the current !</p>";
    } //$loginCheck == "same"
} //isset($_GET['login'])
/* REGISTER */
else if (isset($_GET['register']) && $_GET['register'] !== "success") {
    $registerCheck = $_GET['register'];
    if ($registerCheck == "empty") {
        echo "<p style='color: red;'>Some fields are empty !</p>";
    } //$registerCheck == "empty"
    elseif ($registerCheck == "emailinvalid") {
        echo "<p style='color: red;'>Invalid email !</p>";
    } //$registerCheck == "emailinvalid"
        elseif ($registerCheck == "emailtaken") {
        echo "<p style='color: red;'>Email is already used !</p>";
    } //$registerCheck == "emailtaken"
        elseif ($registerCheck == "usernametaken") {
        echo "<p style='color: red;'>Username is already used !</p>";
    } //$registerCheck == "usernametaken"
        elseif ($registerCheck == "passwordconfirm") {
        echo "<p style='color: red;'>Passwords do not match !</p>";
    } //$registerCheck == "passwordconfirm"
        elseif ($registerCheck == "specialchars") {
        echo "<p style='color: red;'>Special characters are not allowed !</p>";
    } //$registerCheck == "specialchars"
} //isset($_GET['register']) && $_GET['register'] !== "success"
/* FORGET */
else if (isset($_GET['forget']) && $_GET['forget'] !== "success") {
    $forgetCheck = $_GET['forget'];
    echo "<h1>Forgot password or username</h1>";
    if ($forgetCheck == "empty") {
        echo "<p style='color: red;'>Some fields are empty !</p>";
    } //$forgetCheck == "empty"
    elseif ($forgetCheck == "emailinvalid") {
        echo "<p style='color: red;'>Invalid email !</p>";
    } //$forgetCheck == "emailinvalid"
        elseif ($forgetCheck == "false") {
        echo "<p style='color: red;'>Invalid link or expired !</p>";
    } //$forgetCheck == "false"
} //isset($_GET['forget']) && $_GET['forget'] !== "success"
/* RECOVER */
else if (isset($_GET['recover']) && $_GET['recover'] !== "success") {
    $recoverCheck = $_GET['forget'];
    echo "<h1>Change password</h1>";
    if ($recoverCheck == "empty") {
        echo "<p style='color: red;'>Some fields are empty !</p>";
    } //$recoverCheck == "empty"
    elseif ($recoverCheck == "emailinvalid") {
        echo "<p style='color: red;'>Invalid email !</p>";
    } //$recoverCheck == "emailinvalid"
        elseif ($recoverCheck == "passnotsame") {
        echo "<p style='color: red;'>Passwords do not match !</p>";
    } //$recoverCheck == "passnotsame"
} //isset($_GET['recover']) && $_GET['recover'] !== "success"
/* FRIENDS */
else if (isset($_GET['link']) && isset($_GET['add']) || isset($_GET['request']) || isset($_GET['chatroom'])) {
    $addCheck = $_GET['add'];
    $requestCheck = $_GET['request'];
    $chatroomCheck = $_GET['chatroom'];
    if ($addCheck == "error") {
        echo "<p style='color: red;'>You can't add yourself or nothing !</p>";
    } //$addCheck == "error"
    elseif ($addCheck == "noexist") {
        echo "<p style='color: red;'>User doesn't exist !</p>";
    } //$addCheck == "noexist"
        elseif ($addCheck == "userNotActive") {
        echo "<p style='color: red;'>User didn't activate his account !</p>";
    } //$addCheck == "userNotActive"
        elseif ($addCheck == "alreadyAdded") {
        echo "<p style='color: red;'>User is your already your friend !</p>";
    } //$addCheck == "alreadyAdded"
        elseif ($addCheck == "success") {
        echo "<p style='color: green;'>User successfully added !</p>";
    } //$addCheck == "success"
        elseif ($requestCheck == "accepted") {
        echo "<p style='color: green;'>Friend request successfully accepted !</p>";
    } //$requestCheck == "accepted"
        elseif ($requestCheck == "refused") {
        echo "<p style='color: green;'>Friend request successfully refused !</p>";
    } //$requestCheck == "refused"
        elseif ($requestCheck == "deleted") {
        echo "<p style='color: green;'>Friend successfully deleted !</p>";
    } //$requestCheck == "deleted"
        elseif ($chatroomCheck == "exist") {
        echo "<p style='color: red;'>Chat room already exists !</p>";
    } //$chatroomCheck == "exist"
        elseif ($chatroomCheck == "success") {
        echo "<p style='color: red;'>Chat room successfully created !</p>";
    } //$chatroomCheck == "success"
} //isset($_GET['link']) && isset($_GET['add']) || isset($_GET['request']) || isset($_GET['chatroom'])
/* VOTE */
else if (isset($_GET['vote'])) {
    $voteCheck = $_GET['vote'];
    if ($voteCheck == "success") {
        echo "<p style='color: green;'>Successfully voted !</p>";
    } //$voteCheck == "success"
    elseif ($voteCheck == "already") {
        echo "<p style='color: red;'>You already voted on this post!</p>";
    } //$voteCheck == "already"
} //isset($_GET['vote'])
/* POSTING */
else if (isset($_GET['posting'])) {
    $postingCheck = $_GET['posting'];
    if ($postingCheck == "blank") {
        echo "<p style='color: red;'>Some fields are empty !</p>";
    } //$postingCheck == "blank"
} //isset($_GET['posting'])
else if (isset($_GET['edit']) && !isset($_GET['upload']) && !isset($_GET['delete'])) {
    $editCheck = $_GET['edit'];
    if ($editCheck == "blank") {
        echo "<p style='color: red;'>Some fields are empty !</p>";
    } //$editCheck == "blank"
} //isset($_GET['edit'])
/* IMAGE UPLOADER */
else if (isset($_GET['upload']) || isset($_GET['delete'])) {
    $uploadCheck = $_GET['upload'];
    $deleteCheck = $_GET['delete'];
    if ($uploadCheck == "success") {
        echo "<p style='color: green;'>Image uploaded !</p>";
    } //$uploadCheck == "success"
    elseif ($uploadCheck == "invalidtype") {
        echo "<p style='color: red;'>Image format invalid !</p>";
    } //$uploadCheck == "typeinvalid"
    elseif ($uploadCheck == "toobigfile") {
        echo "<p style='color: red;'>Image too big (max 10MB) !</p>";
    } //$uploadCheck == "typeinvalid"
    elseif ($uploadCheck == "error") {
        echo "<p style='color: red;'>An error occured please try again, if it persists please contact admins or support !</p>";
    } //$uploadCheck == "error"
    elseif ($uploadCheck == "failed") {
        echo "<p style='color: red;'>An error occured please try again, if it persists please contact admins or support !</p>";
    } //$uploadCheck == "failed"
    elseif ($deleteCheck == "success") {
        echo "<p style='color: red;'>Image deleted !</p>";
    } //$deleteCheck == "success"
}
