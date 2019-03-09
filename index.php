<?php require_once "includes/header.php";
?>
<div class="videoSection">
  <?php
$videoGrid = new VideoGrid($connection, $userLoggedInObj->getUsername());
echo $videoGrid->create(null, "Recommended", false);
?>
</div>
<?php require_once "includes/footer.php";
?>