<?php
class Account
{
    private $connection;
    private $errorArray = array();

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function register($firstName, $lastName, $username, $email, $email2, $password, $password2)
    {
        $this->validateFirstName($firstName);
        $this->validatelastName($lastName);
        $this->validateUserName($username);
        $this->validateEmail($email, $email2);
        $this->validatePassword($password, $password2);

        if (empty($this->errorArray)) {
            return $this->insertUserDetails($firstName, $lastName, $username, $email, $password);
        } else {
            return false;
        }
    }

    public function insertUserDetails($firstName, $lastName, $username, $email, $password)
    {
        $password = hash("sha512", $password);
        $profilePic = "assets/images/profilePictures/default.png";

        $query = $this->connection->prepare("INSERT INTO users (firstName, lastName, username, email, password, profilePic) VALUES (:firstName, :lastName, :username, :email, :password, :profilePic)");

        $query->bindParam(':firstName', $firstName);
        $query->bindParam(':lastName', $lastName);
        $query->bindParam(':username', $username);
        $query->bindParam(':email', $email);
        $query->bindParam(':password', $password);
        $query->bindParam(':profilePic', $profilePic);

        return $query->execute();
    }

    private function validateFirstName($firstName)
    {
        if (strlen($firstName) > 25 || strlen($firstName) < 2) {
            array_push($this->errorArray, Constants::$firstNameCharacters);
        }
    }

    private function validateLastName($lastName)
    {
        if (strlen($lastName) > 25 || strlen($lastName) < 2) {
            array_push($this->errorArray, Constants::$lastNameCharacters);
        }
    }

    private function validateUserName($username)
    {
        if (strlen($username) > 25 || strlen($username) < 5) {
            array_push($this->errorArray, Constants::$usernameCharacters);
            return;
        }

        $query = $this->connection->prepare("SELECT username FROM users WHERE username=:username");
        $query->bindParam(':username', $username);
        $query->execute();

        if ($query->rowCount() != 0) {
            array_push($this->errorArray, Constants::$usernameTaken);
        }
    }

    private function validateEmail($email, $email2)
    {
        if ($email != $email2) {
            array_push($this->errorArray, Constants::$emailDoNotMatch);
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errorArray, Constants::$emailInvalid);
            return;
        }

        $query = $this->connection->prepare("SELECT email FROM users WHERE email=:email");
        $query->bindParam(':email', $email);
        $query->execute();

        if ($query->rowCount() != 0) {
            array_push($this->errorArray, Constants::$emailTaken);
        }
    }

    private function validatePassword($password, $password2)
    {
        if ($password != $password2) {
            array_push($this->errorArray, Constants::$passwordDoNotMatch);
            return;
        }

        if (preg_match("/[^A-Za-z0-9]/", $password)) {
            array_push($this->errorArray, Constants::$passwordInvalid);
            return;
        }

        if (strlen($password) > 30 || strlen($password) < 5) {
            array_push($this->errorArray, Constants::$passwordLength);
            return;
        }
    }

    public function getError($error)
    {
        if (in_array($error, $this->errorArray)) {
            return "<span class='errorMessage'>$error</span>";
        }
    }
}