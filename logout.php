<?php
include 'includes/header.php';
?>
<section id="inner-headline">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="pageTitle">ADVP Login</h2>
            </div>
        </div>
    </div>
</section>
<?php
//destroy the SESSION object
$_SESSION=array();
session_destroy();
setcookie(session_name(),'', time()-300);
?>
<div class="page-header">
    <div class="container">
        <h2>Logged Out</h2>
        <div class="alert alert-success">
            <p>Thank you for visiting</p>
        </div>
        
    </div>
</div>
<?php
include 'includes/footer.php';
