<?php
class NavigationMenuProvider {

    private $con, $userLoggedInObj;

    public function __construct($con, $userLoggedInObj) {
        $this->con = $con;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function create() {
        $menuHtml = $this->createNavItem("Home", "fa-solid fa-house", "index.php");
        $menuHtml .= $this->createNavItem("Trending", "fa-solid fa-arrow-trend-up", "trending.php");
        $menuHtml .= $this->createNavItem("Subscriptions", "fa-solid fa-users", "subscriptions.php");
        $menuHtml .= $this->createNavItem("Liked Videos", "fa-solid fa-heart", "likedVideos.php");

        if(User::isLoggedIn()) {
            $menuHtml .= $this->createNavItem("Settings", "fa-solid fa-gear", "settings.php");
            $menuHtml .= $this->createNavItem("Log Out", "fa-solid fa-right-from-bracket", "logout.php");

            $menuHtml .= $this->createSubscriptionsSection();
        }

        return "<div class='navigationItems'>
                    $menuHtml
                </div>";
    }

    private function createNavItem($text, $icon, $link) {
        return "<div class='navigationItem'>
                    <a href='$link'>
                        <i class='$icon'></i>
                        <span>$text</span>
                    </a>
                </div>";
    }

    private function createSubscriptionsSection() {
        $subscriptions = $this->userLoggedInObj->getSubscriptions();

        $html = "<span class='heading'>Subscriptions</span>";
        foreach($subscriptions as $sub) {
            $subUsername = $sub->getUsername();
            $html .= $this->createNavItem($subUsername, $sub->getProfilePic(), "profile.php?username=$subUsername");
        }
        return $html;
    }

}
?>