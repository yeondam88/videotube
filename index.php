<?php require_once "includes/header.php";
?>
<?php if (isset($_SESSION['userLoggedIn'])) {
    echo "user logged in as" . " " . $userLoggedInObj->getName();
} else {
    echo 'Please sign in';
}
?>
<?php require_once "includes/footer.php";