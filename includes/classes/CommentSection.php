<?php
class CommentSection
{

    private $connection;
    private $video;
    private $userLoggedInObj;

    public function __construct($connection, $video, $userLoggedInObj)
    {
        $this->connection = $connection;
        $this->video = $video;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function create()
    {
        return $this->createCommentSection();

    }

    private function createCommentSection()
    {
        $numComments = $this->video->getNumberOfComments();
        $postedBy = $this->userLoggedInObj->getUsername();
        $videoId = $this->video->getId();

        $profileButton = ButtonProvider::createUserProfileButton($this->connection, $postedBy);
        $commentAction = "postComment(this, \"$postedBy\", $videoId, null, \"comments\")";
        $commentButton = ButtonProvider::createButton("COMMENT", null, $commentAction, "postComment");

        $comments = $this->video->getComments();
        $commentItems = "";

        foreach ($comments as $comment) {
            $commentItems .= $comment->create();
        }

        return "
          <div class='commentSection'>
            <div class='header'>
              <span class='commentCount'>$numComments Comments</span>
              <div class='commentForm'>
                $profileButton
                <textarea class='commentBodyClass' placeholder='Add a comments'></textarea>
                $commentButton
              </div>
            </div>

            <div class='comments'>
              $commentItems
            </div>
          </div>
        ";
    }

}