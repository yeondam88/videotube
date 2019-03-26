<?php
require_once "includes/header.php";

$subscrptionProvider = new SubscriptionProvider($connection, $userLoggedInObj);

$videos = $subscrptionProvider->getVideos();

$videoGrid = new VideoGrid($connection, $userLoggedInObj);
?>
<div class="largeVideoGridContainer">
  <?php
if (sizeof($videos) > 0) {
	echo $videoGrid->createLarge($videos, "New from your subscriptions", false);
}
else {
	echo "No videos to show";
}
?>
</div>