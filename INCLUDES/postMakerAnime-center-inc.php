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
    $creator = mysqli_real_escape_string($conn, $_POST['bannerCreator']);
    $creatorPage = mysqli_real_escape_string($conn, $_POST['bannerCreatorPageLink']);
    $numberArcsCenter = mysqli_real_escape_string($conn, $_POST['arcNumbersCenter']);

    $genre = $_POST['genre'];
    $newGenre = implode(", ", $genre);
    $pageLinkTitle = str_replace(" ", "_", $title);
    $pageLink = $pageLinkTitle . "_anime";
    if (empty($title) || empty($status) || empty($type) || empty($titleEn) || empty($newGenre) || empty($statusManga) || empty($content) || empty($season) || empty($episodes) || empty($adaptation) || empty($numberArcsCenter)) {
        saveData($content, $title, $titleEn, $season, $episodes, $status, $statusManga, $adaptation, $type, $linkMyAnime, $newGenre, $creator, $creatorPage, $numberArcsCenter);
        header("Location: ../posting-center.php?posting=blank");
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
                        $sql = "INSERT INTO posts (p_user, p_title, p_status, p_type, p_content, p_link, p_active, p_titleen, p_genre, p_statusmanga, p_seasoncenter, p_episodescenter, p_adaptation, p_img_src, p_img_status, p_imgcreditsname, p_imgcreditslink, p_arcsCenter) VALUES ('$uid', '$title', '$status', '$type', '$content', '$pageLink', '2', '$titleEn', '$newGenre', '$statusManga', '$season', '$episodes', '$adaptation', '$pageLink', 'true', '$creator', '$creatorPage', '$numberArcsCenter');";
                        $result = mysqli_query($conn, $sql);
                        saveData('', '', '', '', '', '', '', '', '', '', '', '', '', '');
                        header("Location: ../post.php?posting=success&link=$pageLink");
                    } //move_uploaded_file($fileTmpName, $fileDestination)
                    else {
                        saveData($content, $title, $titleEn, $season, $episodes, $status, $statusManga, $adaptation, $type, $linkMyAnime, $newGenre, $creator, $creatorPage, $numberArcsCenter);
                        header("Location: ../posting-center.php?upload=failed");
                    }
                } //$fileSize < 1250000
                else {
                    saveData($content, $title, $titleEn, $season, $episodes, $status, $statusManga, $adaptation, $type, $linkMyAnime, $newGenre, $creator, $creatorPage, $numberArcsCenter);
                    header("Location: ../posting-center.php?upload=toobigfile");
                }
            } //$fileError === 0
            else {
                saveData($content, $title, $titleEn, $season, $episodes, $status, $statusManga, $adaptation, $type, $linkMyAnime, $newGenre, $creator, $creatorPage, $numberArcsCenter);
                header("Location: ../posting-center.php?upload=error");
            }
        } //in_array($fileActualExt, $allowed)
        else {
            saveData($content, $title, $titleEn, $season, $episodes, $status, $statusManga, $adaptation, $type, $linkMyAnime, $newGenre, $creator, $creatorPage, $numberArcsCenter);
            header("Location: ../posting-center.php?upload=invalidtype");
        }
    }
} //isset($_POST['submit'])
function saveData($content, $title, $titleEn, $season, $episodes, $status, $statusManga, $adaptation, $type, $linkMyAnime, $newGenre, $creator, $creatorPage, $numberArcsCenter) {
    $_SESSION['contentTemp'] = $content;
    $_SESSION['SaveTemp_title'] = $title;
    $_SESSION['SaveTemp_titleEn'] = $titleEn;
    $_SESSION['SaveTemp_season'] = $season;
    $_SESSION['SaveTemp_episodes'] = $episodes;
    $_SESSION['SaveTemp_status'] = $status;
    $_SESSION['SaveTemp_statusManga'] = $statusManga;
    $_SESSION['SaveTemp_adaptation'] = $adaptation;
    $_SESSION['SaveTemp_type'] = $type;
    $_SESSION['SaveTemp_linkMyAnime'] = $linkMyAnime;
    $_SESSION['SaveTemp_genre'] = $newGenre;
    $_SESSION['SaveTemp_Creator'] = $creator;
    $_SESSION['SaveTemp_CreatorPage'] = $creatorPage;
    $_SESSION['SaveTemp_NumberArcsCenter'] = $numberArcsCenter;
}
