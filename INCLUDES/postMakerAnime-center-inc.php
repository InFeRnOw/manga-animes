<?php
session_start();
if (isset($_POST['submit'])) {
    include 'dbh-inc.php';
    $uid = $_SESSION['u_uid'];
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
    $season = mysqli_real_escape_string($conn, $_POST['seasonCenter']);
    $episodes = mysqli_real_escape_string($conn, $_POST['episodesCenter']);
    $adaptation = mysqli_real_escape_string($conn, $_POST['adaptation']);
    $titleEn = mysqli_real_escape_string($conn, $_POST['titleEn']);
    $statusManga = mysqli_real_escape_string($conn, $_POST['statusManga']);
    $linkMyAnime = mysqli_real_escape_string($conn, $_POST['linkMyAnime']);

    $genre = $_POST['genre'];
    $newGenre = implode(", ", $genre);
    $pageLinkFirstPart = uniqid('post', TRUE);
    $pageLinkSecondPart = uniqid('end', TRUE);
    $pageLink = $pageLinkFirstPart . $pageLinkSecondPart;
    if (empty($title) || empty($status) || empty($type) || empty($titleEn) || empty($newGenre) || empty($statusManga) || empty($content) || empty($season) || empty($episodes) || empty($adaptation) || empty($linkMyAnime)) {
        $_SESSION['contentTemp'] = $content;
        header("Location: ../posting.php?posting=blank&title=$title&titleEn=$titleEn&season=$season&episodes=$episodes&status=$status&statusm=$statusManga&adaptation=$adaptation&type=$type&linkMyAnime=$linkMyAnime");
    } //empty($title) || empty($status) || empty($type) || empty($titleEn) || empty($newGenre) || empty($statusManga) || empty($content) || empty($season) || empty($episodes) || empty($adaptation)
    else {
        // $sql = "INSERT INTO posts (p_user, p_title, p_status, p_type, p_content, p_link, p_titleen, p_genre, p_statusmanga, p_season, p_episodes, p_adaptation, p_img_src, p_img_status) VALUES ('$uid', '$title', '$status', '$type', '$content', '$pageLink', '$titleEn', '$newGenre', '$statusManga', '$season', '$episodes', '$adaptation', '$pageLink', 'true');";
        // $result = mysqli_query($conn, $sql);
        //
        // $_SESSION['contentTemp'] = "";
        //
        // header("Location: ../post.php?posting=success&link=$pageLink");
        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 1250000) {
                    $fileNameNew = "postimg" . $pageLink . "." . $fileActualExt;
                    $fileNameOld = "postimg" . $pageLink . "." . $allowed;
                    $fileDestination = '../uploads/postsimages/' . $fileNameNew;
                    if (move_uploaded_file($fileTmpName, $fileDestination)) {
                        $sql = "INSERT INTO posts (p_user, p_title, p_status, p_type, p_content, p_link, p_active, p_titleen, p_genre, p_statusmanga, p_seasoncenter, p_episodescenter, p_adaptation, p_img_src, p_img_status, p_linkmyanime) VALUES ('$uid', '$title', '$status', '$type', '$content', '$pageLink', 2, '$titleEn', '$newGenre', '$statusManga', '$season', '$episodes', '$adaptation', '$pageLink', 'true', '$linkMyAnime');";
                        $result = mysqli_query($conn, $sql);
                        $_SESSION['contentTemp'] = "";
                        header("Location: ../post.php?posting=success&link=$pageLink");
                    } //move_uploaded_file($fileTmpName, $fileDestination)
                    else {
                        header("Location: ../posting.php?upload=failed&link=$pageLink&title=$title&titleEn=$titleEn&season=$season&episodes=$episodes&status=$status&statusm=$statusManga&adaptation=$adaptation&type=$type&linkMyAnime=$linkMyAnime");
                    }
                } //$fileSize < 1250000
                else {
                    header("Location: ../posting.php?upload=toobigfile&link=$pageLink&title=$title&titleEn=$titleEn&season=$season&episodes=$episodes&status=$status&statusm=$statusManga&adaptation=$adaptation&type=$type&linkMyAnime=$linkMyAnime");
                }
            } //$fileError === 0
            else {
                header("Location: ../posting.php?upload=error&link=$pageLink&title=$title&titleEn=$titleEn&season=$season&episodes=$episodes&status=$status&statusm=$statusManga&adaptation=$adaptation&type=$type&linkMyAnime=$linkMyAnime");
            }
        } //in_array($fileActualExt, $allowed)
        else {
            header("Location: ../posting.php?upload=invalidtype&link=$pageLink&title=$title&titleEn=$titleEn&season=$season&episodes=$episodes&status=$status&statusm=$statusManga&adaptation=$adaptation&type=$type&linkMyAnime=$linkMyAnime");
        }
    }
} //isset($_POST['submit'])