<?php require_once "includes/header.php";
?>
<?php if (isset($_SESSION['userLoggedIn'])) {
    echo 'hello' . " " . $_SESSION["userLoggedIn"] . '?';
} else {
    echo 'Please sign in';
}
?>
<?php require_once "includes/footer.php";