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
    $season = mysqli_real_escape_string($conn, $_POST['season']);
    $episodes = mysqli_real_escape_string($conn, $_POST['episodes']);
    $adaptation = mysqli_real_escape_string($conn, $_POST['adaptation']);
    $titleEn = mysqli_real_escape_string($conn, $_POST['titleEn']);
    $statusManga = mysqli_real_escape_string($conn, $_POST['statusManga']);
    $imgCreditsName = mysqli_real_escape_string($conn, $_POST['imgCreditsName']);
    $imgCreditsLink = mysqli_real_escape_string($conn, $_POST['imgCreditsLink']);

    $genre = $_POST['genre'];
    $newGenre = implode(", ", $genre);
    $pageLinkFirstPart = uniqid('post', TRUE);
    $pageLinkSecondPart = uniqid('animecenter', TRUE);
    $pageLink = $pageLinkFirstPart . $pageLinkSecondPart;
    if (empty($title) || empty($status) || empty($type) || empty($titleEn) || empty($newGenre) || empty($statusManga) || empty($content) || empty($season) || empty($episodes) || empty($adaptation) || empty($imgCreditsName) || empty($imgCreditsLink)) {
        $_SESSION['contentTemp'] = $content;
        header("Location: ../posting-center.php?posting=blank&title=$title&titleEn=$titleEn&seasonc=$season&episodesc=$episodes&status=$status&statusm=$statusManga&adaptation=$adaptation&type=$type&genre=$newGenre&imgCreditsName=$imgCreditsName&imgCreditsLink=$imgCreditsLink");
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
                        $sql = "INSERT INTO posts (p_user, p_title, p_status, p_type, p_content, p_link, p_active, p_titleen, p_genre, p_statusmanga, p_seasoncenter, p_episodescenter, p_adaptation, p_img_src, p_img_status, p_imgcreditsname, p_imgcreditslink) VALUES ('$uid', '$title', '$status', '$type', '$content', '$pageLink', 2, '$titleEn', '$newGenre', '$statusManga', '$season', '$episodes', '$adaptation', '$pageLink', 'true', '$imgCreditsName', '$imgCreditsLink' );";
                        $result = mysqli_query($conn, $sql);
                        $_SESSION['contentTemp'] = "";
                        header("Location: ../post.php?posting=success&link=$pageLink");
                    } //move_uploaded_file($fileTmpName, $fileDestination)
                    else {
                        $_SESSION['contentTemp'] = $content;
                        header("Location: ../posting-center.php?upload=failed&link=$pageLink&title=$title&titleEn=$titleEn&seasonc=$season&episodesc=$episodes&status=$status&statusm=$statusManga&adaptation=$adaptation&type=$type&linkMyAnime=$linkMyAnime&genre=$newGenre&imgCreditsName=$imgCreditsName&imgCreditsLink=$imgCreditsLink");
                    }
                } //$fileSize < 1250000
                else {
                    $_SESSION['contentTemp'] = $content;
                    header("Location: ../posting-center.php?upload=toobigfile&link=$pageLink&title=$title&titleEn=$titleEn&seasonc=$season&episodesc=$episodes&status=$status&statusm=$statusManga&adaptation=$adaptation&type=$type&linkMyAnime=$linkMyAnime&genre=$newGenre&imgCreditsName=$imgCreditsName&imgCreditsLink=$imgCreditsLink");
                }
            } //$fileError === 0
            else {
                $_SESSION['contentTemp'] = $content;
                header("Location: ../posting-center.php?upload=error&link=$pageLink&title=$title&titleEn=$titleEn&seasonc=$season&episodesc=$episodes&status=$status&statusm=$statusManga&adaptation=$adaptation&type=$type&linkMyAnime=$linkMyAnime&genre=$newGenre&imgCreditsName=$imgCreditsName&imgCreditsLink=$imgCreditsLink");
            }
        } //in_array($fileActualExt, $allowed)
        else {
            $_SESSION['contentTemp'] = $content;
            header("Location: ../posting-center.php?upload=invalidtype&link=$pageLink&title=$title&titleEn=$titleEn&seasonc=$season&episodesc=$episodes&status=$status&statusm=$statusManga&adaptation=$adaptation&type=$type&linkMyAnime=$linkMyAnime&genre=$newGenre&imgCreditsName=$imgCreditsName&imgCreditsLink=$imgCreditsLink");
        }
    }
} //isset($_POST['submit'])
