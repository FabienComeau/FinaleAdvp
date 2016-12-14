<?php

include 'includes/header.php';
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
