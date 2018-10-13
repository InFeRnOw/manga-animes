<?php 
include_once 'dbh-inc.php';
if (isset($_POST['submit'])) {
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    if (empty($content)) {
        header("Location: ../tutorialPost.php?tutorial=empty");
    } //empty($content)
    else {
        $sql = "SELECT * FROM tutorial WHERE t_id = 1";
        $result = mysqli_query($conn, $sql);
        if ($row = mysqli_fetch_assoc($result)) {
            $sql = "UPDATE tutorial SET t_content='$content' WHERE t_id=1;";
            $result = mysqli_query($conn, $sql);
            header("Location: ../tutorial.php?tutorial=edited");
            exit();
        } //$row = mysqli_fetch_assoc($result)
    }
} //isset($_POST['submit'])
else {
    header("Location: ../tutorialPost.php?tutorial=error");
}
