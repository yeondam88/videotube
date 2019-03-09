<?php
class VideoGrid
{
    private $connection;
    private $userLoggedInObj;
    private $largeMode = false;
    private $gridClass = "videoGrid";

    public function __construct($connection, $userLoggedInObj)
    {
        $this->connection = $connection;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function create($videos, $title, $showFilter)
    {
        return "
        <div class='$this->gridClass'>

        </div>
      ";
    }
}