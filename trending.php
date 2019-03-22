<?php
require_once "includes/header.php";
require_once "includes/classes/TrendingProvider.php";

$trendingProvider = new TrendingProvider($connection, $userLoggedInObj);
$videos = $trendingProvider->getVideos();

$videoGrid = new VideoGrid($connection, $userLoggedInObj);
?>
<div class="largeVideoGridContainer">
  <?php
if (sizeof($videos) > 0) {
	echo $videoGrid->createLarge($videos, "Trending videos uploaded in the last week", false);
}
else {
	echo "No Trending videos to show";
}
?>
</div>