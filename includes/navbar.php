<style>
    .dropdown-menu{
background: #fcb017;
background: -moz-linear-gradient(top,  #fcb017 0%, #f9d895 58%, #f9d895 58%, #f9dca2 78%, #f9da9a 98%);
background: -webkit-linear-gradient(top,  #fcb017 0%,#f9d895 58%,#f9d895 58%,#f9dca2 78%,#f9da9a 98%);
background: linear-gradient(to bottom,  #fcb017 0%,#f9d895 58%,#f9d895 58%,#f9dca2 78%,#f9da9a 98%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fcb017', endColorstr='#f9da9a',GradientType=0 );
border: 1px solid #db9304;

    }
    
    .navbar-default .navbar-nav > .open > a, .navbar-default .navbar-nav > .open > a:hover, .navbar-default .navbar-nav > .open > a:focus{
    background: #FCB017

    }
    
</style>

<?php

$home = array(
    'page' => 'Home',
    'url' => '/index.php',
    'icon' => 'home'
);

$about = array(
    'page' => 'About Us',
    'url' => '/about_us.php',
    'icon' => 'cultery'
);

$services = array(
    'page' => 'Services',
    'url' => '/services.php',
    'icon' => 'phone'
);

//build multi-dimensional array
$pages = array(
    'Home' => $home,
    'About Us' => $about,
    'Chapters' => $services,
    //'Contact' => $contact,
    
);

//var_dump($pages);
//find out which page user is viewing
$this_page = $_SERVER['REQUEST_URI'];
//echo $this_page;
//loop the array and print the list items
foreach ($pages as $page => $list) {
    $url = $list['url'];
    $icon = $list['icon'];
   
    if ($this_page == $url) {
        //echo ' class="active" ';
        echo "<li class=\"active\"><a href=\"$url\">$page</a></li>";
    }else{
        echo "<li><a href=\"$url\">$page</a></li>";
    }
    
}
?>
                        <li class="dropdown "> <a href="#" class="dropdown-toggle" data-toggle="dropdown">Account <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <?php
                                if (empty($_SESSION['user_id'])) {
                                    ?>
                                    <li><a href="/register.php">Register</a>
                                    <li><a href="/login.php">Login</span></a>

    <?php
} else {
    ?>                                    
                                    <li><a href="/logout.php">Logout</a>

    <?php
}
?>                                                        

                            </ul>
                        </li> 

