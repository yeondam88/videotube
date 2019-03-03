<?php
require_once "ButtonProvider.php";
class Comment
{

    private $connection;
    private $sqlData;
    private $userLoggedInObj;
    private $videoId;

    public function __construct($connection, $input, $userLoggedInObj, $videoId)
    {

        if (!is_array($input)) {
            $query = $connection->prepare("SELECT * FROM comments WHERE id=:id");
            $query->bindParam(":id", $input);
            $query->execute();

            $input = $query->fetch(PDO::FETCH_ASSOC);
        }

        $this->sqlData = $input;
        $this->connection = $connection;
        $this->userLoggedInObj = $userLoggedInObj;
        $this->videoId = $videoId;

    }

    public function create()
    {
        $body = $this->sqlData["body"];
        $postedBy = $this->sqlData["postedBy"];
        $profileButton = ButtonProvider::createUserProfileButton($this->connection, $postedBy);
        $timespan = '';

        return "
        <div class='itemContainer'>
          <div class='comment'>
            $profileButton
            <div class='mainContainer'>
              <div class='commentHeader'>
                <a href='profile.php?username=$postedBy'>
                  <span class='username'>$postedBy</span>
                </a>
                <span class='timestamp'>$timespan</span>
              </div>
              <div class='body'>
                $body
              </div>
            </div>
          </div>
        </div>
      ";
    }

    public function getLikes()
    {
        $query = $this->connection->prepare("SELECT count(*) as 'count' FROM likes WHERE commentId=:commentId");
        $query->bindParam(":commentId", $commentId);
        $commentId = $this->getId();
        $query->execute();

        $data = $query->fetch(PDO::FETCH_ASSOC);
        $numLikes = $data["count"];

        $query = $this->connection->prepare("SELECT count(*) as 'count' FROM dislikes WHERE commentId=:commentId");
        $query->bindParam(":commentId", $commentId);
        $query->execute();

        $data = $query->fetch(PDO::FETCH_ASSOC);
        $numDislikes = $data["count"];

        return $numLikes - $numDislikes;
    }
}