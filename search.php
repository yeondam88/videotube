<?php
require_once 'includes/header.php';
require_once 'includes/classes/SearchResultsProvider.php';

if (!isset($_GET["term"]) || $_GET["term"] == "") {
    echo 'You must enter a search term';
    exit();
}

$term = $_GET["term"];

if (!isset($_GET['orderBy']) || $_GET['orderBy'] == 'views') {
    $orderBy = "views";
} else {
    $orderBy = "uploadDate";
}

$searchResultsProvider = new SearchResultsProvider($connection, $userLoggedInObj);
$videos = $searchResultsProvider->getVideos($term, $orderBy);

$videoGrid = new VideoGrid($connection, $userLoggedInObj);
?>
<div class='largeVideoGridContainer'>
    <?php 
        if (sizeof($video) > 0) {
            
        } else {
            echo "No results found";
        }
    ?>
</div>


<?php
require_once 'includes/footer.php';