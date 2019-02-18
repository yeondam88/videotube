<?php
require_once "includes/classes/ButtonProvider.php";
class VideoInfoControls
{
    private $video;
    private $userLoggedInObj;

    public function __construct($video, $userLoggedInObj)
    {
        $this->video = $video;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function create()
    {
        $likeButton = $this->createLikeButton();
        $disLikeButton = $this->createDislikeButton();

        return "
          <div class='controls'>
            $likeButton
            $disLikeButton
          </div>
        ";
    }

    private function createLikeButton()
    {
        $text = $this->video->getLikes();
        $videoId = $this->video->getId();
        $action = "likeVideo(this, $videoId)";
        $class = "likeButton";
        $imageSrc = "assets/images/icons/thumb-up.png";

        TODO: // Change button img if video has been liked already

        return ButtonProvider::createButton($text, $imageSrc, $action, $class);
    }

    private function createDislikeButton()
    {
        $text = $this->video->getDislikes();
        $videoId = $this->video->getId();
        $action = "disLikeVideo(this, $videoId)";
        $class = "disLikeButton";
        $imageSrc = "assets/images/icons/thumb-down.png";

        return ButtonProvider::createButton($text, $imageSrc, $action, $class);
    }
}