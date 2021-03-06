<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>ADVP Study Web</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="" />
        <meta name="author" content="http://webthemez.com" />
        <!-- css -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">     
        <link href="css/style.css" rel="stylesheet" />
        <!--pluging for prism-->
        <link href="prism.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="plugins/line-numbers/prism-line-numbers.css" data-noprefix />
        <script src="prism.js" type="text/javascript"></script>
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
              <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
            <![endif]-->
        <style>
            
                input.form-control {
                                    color: #FCB017;}
            
            .navbar-brand img{ width: 85%;}

            @media (max-width: 850px) {
                .navbar-brand img{ width: 60%;
                                    float: left;}}
            
            @media (max-width: 650px) {
                .navbar-brand img{ width: 90%;}}

        </style>
<?php
session_start();

if(isset($_SESSION['LAST_ACTIVITY']) 
        && (time() -$_SESSION['LAST_ACTIVITY']>1800)){
    //last request was more than 30 minutes ago
    session_unset(); //unset session variable
    session_destroy(); //destroy session data in storage    
}

//Update LAST_ACTIVITY time stamp
$_SESSION['LAST_ACTIVITY'] = time();
?>
    </head>
    <body>
<?php

//var_dump($_SESSION);
function __autoload($class) {
    require_once 'classes/' . $class . '.php';
}

//instantiate the database handler
$dbh = new DbHandler();

//$data=$dbh->getDemoList();
//var_dump($data);
?>
        <!--<div id="wrapper" class="home-page">-->
        <div class="topbar">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <p class="pull-left hidden-xs">Welcome</p>
                        <!--<p class="pull-right"><i class="fa fa-phone"></i>Tel No. (+001) 123-456-789</p>-->
                    </div>
                </div>
            </div>
        </div>
        <!-- start header -->
        <header>
            <div class="navbar navbar-default navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="index.php"><img src="/img/logo4.png" alt="logo"/></a>
                    </div>
                    <div class="navbar-collapse collapse" class="breadcrumb">
                        <ul class="nav navbar-nav" >
<?php
include 'includes/navbar.php'
?> 
                            <form method="get" action="/search.php" class="navbar-form navbar-right">
                                <div class="right-inner-addon">
                                    <input class="form-control typeahead tt-query" type="text" placeholder="Search..." id="s" name="s" autocomplete="off" spellcheck="false"/>
                                    <input type="submit" style="height: 0px; width: 0px; border: none; padding: 0px;" hidefocus="true" />
                                </div>
                            </form>
                        </ul>
                    </div>
                </div>
            </div>

        </header>
        <!-- end header -->
        <section id="banner">

