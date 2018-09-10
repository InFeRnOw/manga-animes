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
    $creator = mysqli_real_escape_string($conn, $_POST['bannerCreator']);
    $creatorPage = mysqli_real_escape_string($conn, $_POST['bannerCreatorPageLink']);
    $imgKeep = mysqli_real_escape_string($conn, $_POST['imgKeep']);
    $numberArcsCenter = mysqli_real_escape_string($conn, $_POST['arcsCenter']);

    $genre = $_POST['genre'];
    $newGenre = implode(", ", $genre);
    if (empty($title) || empty($status) || empty($type) || empty($titleEn) || empty($newGenre) || empty($statusManga) || empty($content) || empty($season) || empty($episodes) || empty($adaptation) || empty($numberArcsCenter)) {
        $_SESSION['contentTemp'] = $content;
        header("Location: ../posting-center.php?edit=blank&link=$pageLink");
    } //empty($title) || empty($status) || empty($type) || empty($titleEn) || empty($newGenre) || empty($statusManga) || empty($content) || empty($season) || empty($episodes) || empty($adaptation)
    else {
        // $sql = "UPDATE posts SET p_title='$title', p_status='$status', p_type='$type', p_content='$content', p_titleen='$titleEn', p_genre='$newGenre', p_statusmanga='$statusManga', p_season='$season', p_episodes='$episodes', p_adaptation='$adaptation', p_img_src='$pageLink' WHERE p_link='$pageLink';";
        // $result = mysqli_query($conn, $sql);
        //
        // header("Location: ../post.php?posting=success&link=$pageLink");
        if (!empty($imgKeep) && $fileSize == 0) {
            $sql = "UPDATE posts SET p_title='$title', p_status='$status', p_type='$type', p_content='$content', p_titleen='$titleEn', p_genre='$newGenre', p_statusmanga='$statusManga', p_seasoncenter='$season', p_episodescenter='$episodes', p_adaptation='$adaptation', p_img_src='$imgKeep', p_linkmyanime='$linkMyAnime', p_lastedited='$uid', p_imgcreditsname='$creator', p_imgcreditslink='$creatorPage', p_arcsCenter='
            WHERE p_link='$pageLink'";
            $result = mysqli_query($conn, $sql);
            saveData('', '', '', '', '', '', '', '', '', '', '', '', '');
            header("Location: ../post.php?posting=success&link=$pageLink");
        }
        elseif (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0 || !empty($imgKeep)) {
                if ($fileSize < 1250000 || !empty($imgKeep)) {
                    $fileNameNew = "postimg" . $pageLink . "." . $fileActualExt;
                    $fileNameOld = "postimg" . $pageLink . "." . $allowed;
                    $fileDestination = '../uploads/postsimages/' . $fileNameNew;
                    if (move_uploaded_file($fileTmpName, $fileDestination)) {
                        $sql = "UPDATE posts SET p_title='$title', p_status='$status', p_type='$type', p_content='$content', p_titleen='$titleEn', p_genre='$newGenre', p_statusmanga='$statusManga', p_seasoncenter='$season', p_episodescenter='$episodes', p_adaptation='$adaptation', p_img_src='$pageLink', p_linkmyanime='$linkMyAnime', p_lastedited='$uid', p_imgcreditsname='$creator', p_imgcreditslink='$creatorPage', p_arcsCenter='$numberArcsCenter' WHERE p_link='$pageLink'";
                        $result = mysqli_query($conn, $sql);
                        saveData('', '', '', '', '', '', '', '', '', '', '', '', '');
                        header("Location: ../post.php?posting=success&link=$pageLink");
                    } //move_uploaded_file($fileTmpName, $fileDestination)
                    else {
                        saveData($content, $title, $titleEn, $season, $episodes, $status, $statusManga, $adaptation, $type, $linkMyAnime, $newGenre, $creator, $creatorPage, $numberArcsCenter);
                        header("Location: ../posting-center.php?edit&upload=failed&link=$pageLink");
                    }
                } //$fileSize < 1250000
                else {
                    saveData($content, $title, $titleEn, $season, $episodes, $status, $statusManga, $adaptation, $type, $linkMyAnime, $newGenre, $creator, $creatorPage, $numberArcsCenter);
                    header("Location: ../posting-center.php?edit&upload=toobigfile&link=$pageLink");
                }
            } //$fileError === 0
            else {
                saveData($content, $title, $titleEn, $season, $episodes, $status, $statusManga, $adaptation, $type, $linkMyAnime, $newGenre, $creator, $creatorPage, $numberArcsCenter);
                header("Location: ../posting-center.php?edit&upload=error&link=$pageLink");
            }
        } //in_array($fileActualExt, $allowed)
        else {
            saveData($content, $title, $titleEn, $season, $episodes, $status, $statusManga, $adaptation, $type, $linkMyAnime, $newGenre, $creator, $creatorPage, $numberArcsCenter);
            header("Location: ../posting-center.php?edit&upload=invalidtype&link=$pageLink");
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
