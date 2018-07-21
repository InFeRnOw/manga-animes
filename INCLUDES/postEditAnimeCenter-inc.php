<?php
session_start();
if (isset($_POST['submit'])) {
    include 'dbh-inc.php';
    $uid = $_SESSION['u_uid'];
    $pageLink = $_SESSION['linkTemp'];
    $file = $_FILES['banner'];
    $fileName = $_FILES['banner']['name'];
    $fileTmpName = $_FILES['banner']['tmp_name'];
    $fileSize = $_FILES['banner']['size'];
    $fileError = $_FILES['banner']['error'];
    $fileType = $_FILES['banner']['type'];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array(
        'jpg'
    );
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $type = mysqli_real_escape_string($conn, $_POST['type']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $season = mysqli_real_escape_string($conn, $_POST['season']);
    $episodes = mysqli_real_escape_string($conn, $_POST['episodes']);
    $adaptation = mysqli_real_escape_string($conn, $_POST['adaptation']);
    $titleEn = mysqli_real_escape_string($conn, $_POST['titleEn']);
    $statusManga = mysqli_real_escape_string($conn, $_POST['statusManga']);

    $genre = $_POST['genre'];
    $newGenre = implode(", ", $genre);
    if (empty($title) || empty($status) || empty($type) || empty($titleEn) || empty($newGenre) || empty($statusManga) || empty($content) || empty($season) || empty($episodes) || empty($adaptation)) {
        header("Location: ../posting-center.php?edit=blank&link=$pageLink&title=$title&titleEn=$titleEn&season=$season&episodes=$episodes&status=$status&statusm=$statusManga&adaptation=$adaptation&type=$type");
        $_SESSION['contentTemp'] = $content;
    } //empty($title) || empty($status) || empty($type) || empty($titleEn) || empty($newGenre) || empty($statusManga) || empty($content) || empty($season) || empty($episodes) || empty($adaptation)
    else {
        // $sql = "UPDATE posts SET p_title='$title', p_status='$status', p_type='$type', p_content='$content', p_titleen='$titleEn', p_genre='$newGenre', p_statusmanga='$statusManga', p_season='$season', p_episodes='$episodes', p_adaptation='$adaptation', p_img_src='$pageLink' WHERE p_link='$pageLink';";
        // $result = mysqli_query($conn, $sql);
        //
        // header("Location: ../post.php?posting=success&link=$pageLink");
        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 1250000) {
                    $fileNameNew = "postimg" . $pageLink . "." . $fileActualExt;
                    $fileNameOld = "postimg" . $pageLink . "." . $allowed;
                    $fileDestination = '../uploads/postsimages/' . $fileNameNew;
                    if (move_uploaded_file($fileTmpName, $fileDestination)) {
                        $sql = "UPDATE posts SET p_title='$title', p_status='$status', p_type='$type', p_content='$content', p_titleen='$titleEn', p_genre='$newGenre', p_statusmanga='$statusManga', p_seasoncenter='$season', p_episodescenter='$episodes', p_adaptation='$adaptation', p_img_src='$pageLink' WHERE p_link='$pageLink'";
                        $result = mysqli_query($conn, $sql);
                        header("Location: ../post.php?posting=success&link=$pageLink");
                    } //move_uploaded_file($fileTmpName, $fileDestination)
                    else {
                        header("Location: ../posting-center.php?edit&upload=failed&link=$pageLink&title=$title&titleEn=$titleEn&season=$season&episodes=$episodes&status=$status&statusm=$statusManga&adaptation=$adaptation&type=$type");
                    }
                } //$fileSize < 1250000
                else {
                    header("Location: ../posting-center.php?edit&upload=toobigfile&link=$pageLink&title=$title&titleEn=$titleEn&season=$season&episodes=$episodes&status=$status&statusm=$statusManga&adaptation=$adaptation&type=$type");
                }
            } //$fileError === 0
            else {
                header("Location: ../posting-center.php?edit&upload=error&link=$pageLink&title=$title&titleEn=$titleEn&season=$season&episodes=$episodes&status=$status&statusm=$statusManga&adaptation=$adaptation&type=$type");
            }
        } //in_array($fileActualExt, $allowed)
        else {
            header("Location: ../posting-center.php?edit&upload=invalidtype&link=$pageLink&title=$title&titleEn=$titleEn&season=$season&episodes=$episodes&status=$status&statusm=$statusManga&adaptation=$adaptation&type=$type");
        }
    }
} //isset($_POST['submit'])