<?php
class User
{
    private $connection;
    private $sqlData;

    public function __construct($connection, $username)
    {
        $this->connection = $connection;

        $query = $this->connection->prepare("SELECT * FROM users WHERE username=:username");
        $query->bindParam(":username", $username);
        $query->execute();

        $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
    }

    public static function isLoggedIn()
    {
        return isset($_SESSION["userLoggedIn"]);
    }

    public function getUsername()
    {
        return $this->sqlData["username"];
    }

    public function getName()
    {
        return $this->sqlData["firstName"] . " " . $this->sqlData["lastName"];
    }

    public function getFirstName()
    {
        return $this->sqlData["firstName"];
    }

    public function getLastName()
    {
        return $this->sqlData["lastName"];
    }

    public function getEmail()
    {
        return $this->sqlData["email"];
    }

    public function getProfilePic()
    {
        return $this->sqlData["profilePic"];
    }

    public function getSignUpDate()
    {
        return $this->sqlData["signUpDate"];
    }

    public function isSubscribedTo($userTo)
    {
        $query = $this->connection->prepare("SELECT * FROM subscribers WHERE userTo=:userTo AND userFrom=:userFrom");
        $query->bindParam(":userFrom", $username);

        $query->bindParam(":userTo", $userTo);
        $username = $this->getUsername();
        $query->execute();

        return $query->rowCount() > 0;
    }

    public function getSubscriberCount()
    {
        $query = $this->connection->prepare("SELECT * FROM subscribers WHERE userTo=:userTo");
        $username = $this->getUsername();

        $query->bindParam(":userTo", $username);
        $query->execute();
        return $query->rowCount();
    }

    public function getSubscriptions()
    {
        $query = $this->connection->prepare("SELECT userTo FROM subscribers WHERE userFrom=:userFrom");
        $username = $this->getUsername();
        $query->bindParam(":userFrom", $username);

        $query->execute();

        $subs = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $user = new User($this->connection, $row["userTo"]);
            array_push($subs, $user);
        }

        return $subs;
    }
}