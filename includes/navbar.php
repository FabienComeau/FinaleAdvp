<?php

$home = array(
    'page' => 'Home',
    'url' => '/FinaleAdvp/index.php',
    'icon' => 'home'
);

$about = array(
    'page' => 'About Us',
    'url' => '/FinaleAdvp/about_us.php',
    'icon' => 'cultery'
);

$services = array(
    'page' => 'Services',
    'url' => '/FinaleAdvp/services.php',
    'icon' => 'phone'
);

$contact = array(
    'page' => 'Contact',
    'url' => '/FinaleAdvp/contact.php',
    'icon' => 'info-sign'
);

//build multi-dimensional array
$pages = array(
    'Home' => $home,
    'About Us' => $about,
    'Services' => $services,
    'Contact' => $contact
);

//var_dump($pages);
//find out which page user is viewing
$this_page = $_SERVER['REQUEST_URI'];
//echo $this_page;
//loop the array and print the list items
foreach ($pages as $page => $list) {
    $url = $list['url'];
    $icon = $list['icon'];
   // echo '<li><a ';
    if ($this_page == $url) {
        //echo ' class="active" ';
        echo "<li class=\"active\"><a href=\"$url\">$page</a></li>";
    }else{
        echo "<li><a href=\"$url\">$page</a></li>";
    }
    //echo "href=\"$url\"><span class=\"glyphicon glyphicon-$icon\"></span> $page</a></li>";
}

