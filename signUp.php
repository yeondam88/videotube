<?php
require_once "includes/config.php";
require_once 'includes/classes/Account.php';
require_once 'includes/classes/Constants.php';
require_once 'includes/classes/FormSanitizer.php';

$account = new Account($connection);

if (isset($_POST['submitButton'])) {
	$firstName = FormSanitizer::sanitizeFormString($_POST['firstName']);
	$lastName = FormSanitizer::sanitizeFormString($_POST['lastName']);
	
	$username = FormSanitizer::sanitizeFormUsername($_POST['username']);
	
	$email = FormSanitizer::sanitizeFormEmail($_POST['email']);
	$email2 = FormSanitizer::sanitizeFormEmail($_POST['email2']);
	
	$password = FormSanitizer::sanitizeFormPassword($_POST['password']);
	$password2 = FormSanitizer::sanitizeFormPassword($_POST['password2']);
	
	$account->register($firstName, $lastName, $username, $email, $email2, $password, $password2);
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
  <title>Sign Up</title>
</head>

<body>
  <div class="signInContainer">
    <div class="column">
      <div class="header">
        <img src="assets/images/icons/VideoTubeLogo.png" alt="VideoTube Logo" title="VideoTube">
        <h3>Sign Up</h3>
        <span>to continue to VideoTube</span>
      </div>
      <div class="loginForm">
        <form action="signUp.php" method="POST">
          <?php echo $account->getError(Constants::$firstNameCharacters);
?>
          <input type="text" name="firstName" placeholder="First Name" autocomplete="off" required>
          <?php echo $account->getError(Constants::$lastNameCharacters);
?>
          <input type="text" name="lastName" placeholder="Last Name" autocomplete="off" required>
          <?php echo $account->getError(Constants::$usernameCharacters);
?>
          <?php echo $account->getError(Constants::$usernameTaken);
?>
          <input type="text" name="username" placeholder="Username" autocomplete="off" required>
          <?php echo $account->getError(Constants::$emailDoesNotMatch);
?>
          <?php echo $account->getError(Constants::$emailInvalid);
?>
          <?php echo $account->getError(Constants::$emailTaken);
?>
          <input type="email" name="email" placeholder="Email" autocomplete="off" required>
          <input type="email" name="email2" placeholder="Confirm Email" autocomplete="off" required>
          <?php echo $account->getError(Constants::$passwordDoesNotMatch);
?>
          <?php echo $account->getError(Constants::$passwordInvalid);
?>
          <?php echo $account->getError(Constants::$passwordLength);
?>
          <input type="password" name="password" placeholder="Password" autocomplete="off" required>
          <input type="password" name="password2" placeholder="Confirm Password" autocomplete="off" required>
          <input type="submit" name="submitButton" value="SUBMIT">
        </form>
      </div>
      <a href="signIn.php" class="signInMessage">Already have an account? Sign in here!</a>
    </div>
  </div>
</body>

</html>