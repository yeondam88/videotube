<?php
class VideoInfoSection {
  
  private $connection; 
  private $video;
  private $userLoggedInObj;
  

  public function __construct($connection, $video, $userLoggedInObj) {
    $this->connection = $connection;
    $this->video = $video;
    $this->userLoggedInObj = $userLoggedInObj;  
  }

  public function create() {
    return $this->createPrimaryInfo() . $this->createSecondaryInfo();
  }

  private function createPrimaryInfo() {
    $title = $this->video->getTitle();
    $views = $this->video->getViews();

    return "
    <div class='videoInfo'>
      <h1>$title</h1>
      <div class='bottomSection'>
        <span class='viewCount'>$views</span>
      </div>
    </div>";
  }

  private function createSecondaryInfo() {

  }
}