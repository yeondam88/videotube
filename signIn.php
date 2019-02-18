<?php
require_once "includes/config.php";
require_once 'includes/classes/Account.php';
require_once 'includes/classes/Constants.php';
require_once 'includes/classes/FormSanitizer.php';

$account = new Account($connection);

if (isset($_POST['submitButton'])) {
	
	$username = FormSanitizer::sanitizeFormUsername($_POST['username']);
	$password = FormSanitizer::sanitizeFormPassword($_POST['password']);
	
	$wasSuccessful = $account->login($username, $password);
	
	if ($wasSuccessful) {
		$_SESSION["userLoggedIn"] = $username;
		header("Location: index.php");
	}
	else {
		echo 'Failed to login';
	}
	
}

function getInputValue($name)
{
	if (isset($_POST[$name])) {
		echo $_POST[$name];
	}
}

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
  <title>Sign In</title>
</head>

<body>
  <div class="signInContainer">
    <div class="column">
      <div class="header">
        <img src="assets/images/icons/VideoTubeLogo.png" alt="VideoTube Logo" title="VideoTube">
        <h3>Sign In</h3>
        <span>to continue to VideoTube</span>
      </div>
      <div class="loginForm">
        <form action="signIn.php" method="POST">
          <?php echo $account->getError(Constants::$userNotFound);
?>
          <input type="text" name="username" placeholder="Username" value="<?php getInputValue('username');
?>" required
            autocomplete=" off">
          <input type="password" name="password" placeholder="Password" required autocomplete="off">
          <input type="submit" name="submitButton" value="SUBMIT">
        </form>
      </div>
      <a href="signUp.php" class="signInMessage">Need an account? Sign Up here!</a>
    </div>
  </div>
</body>

</html>