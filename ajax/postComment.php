<?php
require_once "../includes/config.php";

if (isset($_POST["commentText"]) && isset($_POST["postedBy"]) && isset($_POST["videoId"])) {

    $commentText = $_POST["commentText"];
    $postedBy = $_POST["postedBy"];
    $responseTo = $_POST["responseTo"];
    $videoId = $_POST["videoId"];

    $query = $connection->prepare("INSERT INTO comments(postedBy, videoId, responseTo, body) VALUES(:postedBy, :videoId, :responseTo, :body)");
    $query->bindParam(":postedBy", $postedBy);
    $query->bindParam(":videoId", $videoId);
    $query->bindParam(":responseTo", $responseTo);
    $query->bindParam(":body", $commentText);

    $query->execute();

    //     return new comment html

} else {
    echo "One or more parameters are not passed into subscribe.php the file.";
}