<?php
require_once "includes/config.php";
require_once "includes/classes/ButtonProvider.php";
require_once "includes/classes/User.php";
require_once "includes/classes/Video.php";
require_once "includes/classes/VideoGrid.php";
require_once "includes/classes/VideoGridItem.php";
require_once "includes/classes/SubscriptionProvider.php";
require_once "includes/classes/NavigationMenuProvider.php";

$usernameLoggedIn = User::isLoggedIn() ? $_SESSION["userLoggedIn"] : "";
$userLoggedInObj = new User($connection, $usernameLoggedIn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
    integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
    integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
    integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
  </script>
  <script src="assets/js/commonActions.js"></script>
  <script src="assets/js/userActions.js"></script>
  <title>VideoTube</title>
</head>

<body>
  <div id="pageContainer">
    <div id="mastHeadContainer">
      <button class="navShowHide">
        <img src="assets/images/icons/menu.png" alt="menu button">
      </button>
      <a class="logoContainer" href="index.php">
        <img src="assets/images/icons/VideoTubeLogo.png" alt="VideoTube Logo" title="VideoTube">
      </a>
      <div class="searchBarContainer">
        <form action="search.php" method="GET">
          <input type="text" class="searchBar" name="term" placeholder="Search...">
          <button class="searchButton">
            <img src="assets/images/icons/search.png" alt="search button">
          </button>
        </form>
      </div>
      <div class="rightIcons">
        <a href="upload.php">
          <img class="upload" src="assets/images/icons/upload.png" alt="upload button">
        </a>
        <?php echo ButtonProvider::createUserProfileNavigationButton($connection, $userLoggedInObj->getUsername());
?>
      </div>
    </div>
    <div id="sideNavContainer" style="display: none;">
      <?php
$navigationProvider = new NavigationMenuProvider($connection, $userLoggedInObj);
echo $navigationProvider->create();
?>
    </div>
    <div id="mainSectionContainer">
      <div id="mainContentContainer">