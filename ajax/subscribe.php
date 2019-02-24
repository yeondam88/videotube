<?php
require_once "../includes/config.php";

if (isset($_POST["userTo"]) && isset($_POST["userFrom"])) {

    $userTo = $_POST["userTo"];
    $userFrom = $_POST["userFrom"];

    $query = $connection->prepare("SELECT * FROM subscribers WHERE userTo=:userTo AND userFrom=:userFrom");
    $query->bindParam(":userTo", $userTo);
    $query->bindParam(":userFrom", $userFrom);
    $query->execute();

    if ($query->rowCount() == 0) {
        $query = $connection->prepare("INSERT INTO subscribers(userTo, userFrom) VALUES(:userTo, :userFrom)");
        $query->bindParam(":userTo", $userTo);
        $query->bindParam(":userFrom", $userFrom);
        $query->execute();
    } else {
        $query = $connection->prepare("DELETE FROM subscribers WHERE userTo=:userTo AND userFrom=:userFrom");
        $query->bindParam(":userTo", $userTo);
        $query->bindParam(":userFrom", $userFrom);
        $query->execute();
    }

    $query = $connection->prepare("SELECT * FROM subscribers WHERE userTo=:userTo");
    $query->bindParam(":userTo", $userTo);
    $query->execute();

    echo $query->rowCount();

} else {
    echo "One or more parameters are not passed into subscribe.php the file.";
}