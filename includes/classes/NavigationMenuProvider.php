<?php
class NavigationMenuProvider
{

    private $connection;
    private $userLoggedInObj;

    public function __construct($connection, $userLoggedInObj)
    {
        $this->connection = $connection;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function create()
    {
        $menuHtml = $this->createNavItem("Home", "assets/images/icons/home.png", "index.php");
        $menuHtml .= $this->createNavItem("Trending", "assets/images/icons/trending.png", "trending.php");
        $menuHtml .= $this->createNavItem("Subscriptions", "assets/images/icons/subscriptions.png", "subscriptions.php");
        $menuHtml .= $this->createNavItem("Liked Videos", "assets/images/icons/thumb-up.png", "likedVideos.php");

        if (User::isLoggedIn()) {
            $menuHtml .= $this->createNavItem("Settings", "assets/images/icons/settings.png", "settings.php");
            $menuHtml .= $this->createNavItem("Log Out", "assets/images/icons/logout.png", "logout.php");
        }

        return "
          <div class='navigationItems'>
            $menuHtml
          </div>
        ";

    }

    private function createNavItem($text, $icon, $link)
    {
        return "
        <div class='navigationItem'>
          <a href='$link'>
            <img src='$icon'>
            <span>$text</span>
          </a>
        </div>
      ";
    }
}