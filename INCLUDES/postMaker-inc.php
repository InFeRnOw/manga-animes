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
    $studio = mysqli_real_escape_string($conn, $_POST['studio']);
    $linkMyAnime = mysqli_real_escape_string($conn, $_POST['linkMyAnime']);
    $creator = mysqli_real_escape_string($conn, $_POST['bannerCreator']);
    $creatorPage = mysqli_real_escape_string($conn, $_POST['bannerCreatorPageLink']);

    $genre = $_POST['genre'];
    $newGenre = implode(", ", $genre);
    $pageLinkFirstPart = uniqid('post', TRUE);
    $pageLinkSecondPart = uniqid('in-vote', TRUE);
    $pageLink = $pageLinkFirstPart . $pageLinkSecondPart;
    if (empty($title) || empty($status) || empty($type) || empty($titleEn) || empty($newGenre) || empty($studio) || empty($content) || empty($season) || empty($episodes) || empty($adaptation) || empty($linkMyAnime)) {
        saveData($content, $title, $titleEn, $season, $episodes, $status, $studio, $adaptation, $type, $linkMyAnime, $newGenre, $creator, $creatorPage);
        header("Location: ../posting.php?posting=blank");
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
                        $sql = "INSERT INTO posts (p_user, p_title, p_status, p_type, p_content, p_link, p_titleen, p_genre, p_active, p_studio, p_season, p_episodes, p_adaptation, p_img_src, p_img_status, p_linkmyanime, p_imgcreditsname, p_imgcreditslink) VALUES ('$uid', '$title', '$status', '$type', '$content', '$pageLink', '$titleEn', '$newGenre', '0', '$studio', '$season', '$episodes', '$adaptation', '$pageLink', 'true', '$linkMyAnime', '$creator', '$creatorPage');";
                        $result = mysqli_query($conn, $sql);
                        saveData('', '', '', '', '', '', '', '', '', '', '', '', '');
                        header("Location: ../post.php?posting=success&link=$pageLink");
                    } //move_uploaded_file($fileTmpName, $fileDestination)
                    else {
                        saveData($content, $title, $titleEn, $season, $episodes, $status, $studio, $adaptation, $type, $linkMyAnime, $newGenre, $creator, $creatorPage);
                        header("Location: ../posting.php?upload=failed");
                    }
                } //$fileSize < 1250000
                else {
                    saveData($content, $title, $titleEn, $season, $episodes, $status, $studio, $adaptation, $type, $linkMyAnime, $newGenre, $creator, $creatorPage);
                    header("Location: ../posting.php?upload=toobigfile");
                }
            } //$fileError === 0
            else {
                saveData($content, $title, $titleEn, $season, $episodes, $status, $studio, $adaptation, $type, $linkMyAnime, $newGenre, $creator, $creatorPage);
                header("Location: ../posting.php?upload=error");
            }
        } //in_array($fileActualExt, $allowed)
        else {
            saveData($content, $title, $titleEn, $season, $episodes, $status, $studio, $adaptation, $type, $linkMyAnime, $newGenre, $creator, $creatorPage);
            header("Location: ../posting.php?upload=invalidtype");
        }
    }
} //isset($_POST['submit'])

function saveData($content, $title, $titleEn, $season, $episodes, $status, $studio, $adaptation, $type, $linkMyAnime, $newGenre, $creator, $creatorPage) {
    $_SESSION['contentTemp'] = $content;
    $_SESSION['SaveTemp_title'] = $title;
    $_SESSION['SaveTemp_titleEn'] = $titleEn;
    $_SESSION['SaveTemp_season'] = $season;
    $_SESSION['SaveTemp_episodes'] = $episodes;
    $_SESSION['SaveTemp_status'] = $status;
    $_SESSION['SaveTemp_studio'] = $studio;
    $_SESSION['SaveTemp_adaptation'] = $adaptation;
    $_SESSION['SaveTemp_type'] = $type;
    $_SESSION['SaveTemp_linkMyAnime'] = $linkMyAnime;
    $_SESSION['SaveTemp_genre'] = $newGenre;
    $_SESSION['SaveTemp_Creator'] = $creator;
    $_SESSION['SaveTemp_CreatorPage'] = $creatorPage;
}
