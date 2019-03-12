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
        if ($videos == null) {
            $gridItems = $this->generateItems();
        } else {
            $gridItems = $this->generateItemsFromVideos($videos);
        }

        $header = "";

        if ($title !== null) {
            $header = $this->createGridHeader($title, $showFilter);
        }

        return "
          $header
          <div class='$this->gridClass'>
            $gridItems
          </div>
      ";
    }

    public function generateItems()
    {
        $query = $this->connection->prepare("SELECT * FROM videos ORDER BY RAND() LIMIT 15");
        $query->execute();

        $elementHTML = "";
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {

            $video = new Video($this->connection, $row, $this->userLoggedInObj);
            $item = new VideoGridItem($video, $this->userLoggedInObj, $this->largeMode);
            $elementHTML .= $item->create();
        }

        return $elementHTML;
    }

    public function generateItemsFromVideos($videos)
    {
        $elementHTML = "";

        foreach ($videos as $video) {
            $item = new VideoGridItem($video, $this->userLoggedInObj, $this->largeMode);
            $elementHTML .= $item->create();
        }

        return $elementHTML;
    }

    public function createGridHeader($title, $showFilter)
    {
        $filter = "";

        return "
            <div class='videoGridHeader'>
                <div class='left'>
                    $title
                </div>
                $showFilter
            </div>
        ";
    }

    public function createLarge($videos, $title, $showFilter) {
        $this->gridClass .= " large";
        $this->largeMode = true;

        return $this->create($videos, $title, $showFilter);
    }
}