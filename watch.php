<?php
require_once "includes/header.php";
require_once "includes/classes/VideoPlayer.php";
require_once "includes/classes/VideoInfoSection.php";

if (!isset($_GET['id'])) {
    echo 'No url passed into page.';
    exit();
}

$video = new Video($connection, $_GET['id'], $userLoggedInObj);
$video->incrementViews();

?>
<script src="assets/js/videoPlayerActions.js"></script>

<div class="watchLeftColumn">

  <?php
$videoPlayer = new VideoPlayer($video);
echo $videoPlayer->create(true);

$videoInfoSection = new videoInfoSection($connection, $video, $userLoggedInObj);
echo $videoInfoSection->create();
?>

</div>
<div class="suggestions">

</div>

<?php require_once "includes/footer.php";?>