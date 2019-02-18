<?php
class Video
{
    private $connection;
    private $sqlData;
    private $userLoggedInObj;

    public function __construct($connection, $input, $userLoggedInObj)
    {
        $this->connection = $connection;
        $this->userLoggedInObj = $userLoggedInObj;

        if (is_array($input)) {
          $this->sqlData = $input;
        } else {
          $query = $this->connection->prepare("SELECT * FROM videos WHERE id=:videoId");
          $query->bindParam(":videoId", $input);
          $query->execute();

          $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
        }

    }

    public function getId()
    {
        return $this->sqlData["id"];
    }

    public function getUploadedBy()
    {
        return $this->sqlData["uploadedBy"];
    }

    public function getTitle()
    {
        return $this->sqlData["title"];
    }

    public function getDescription()
    {
        return $this->sqlData["description"];
    }

    public function getPrivacy()
    {
        return $this->sqlData["privacy"];
    }

    public function getFilePath()
    {
        return $this->sqlData["filePath"];
    }

    public function getCategory()
    {
        return $this->sqlData["category"];
    }

    public function getUploadDate()
    {
        return $this->sqlData["uploadDate"];
    }

    public function getViews()
    {
        return $this->sqlData["views"];
    }

    public function getDuration()
    {
        return $this->sqlData["duration"];
    }

    public function incrementViews() {
      $query = $this->connection->prepare("UPDATE videos SET views=views+1 WHERE id=:id");
      $query->bindParam(":id", $videoId);

      $videoId = $this->getId();

      $query->execute();
      $this->sqlData["views"] = $this->sqlData["views"] + 1;
    }

}