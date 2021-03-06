

<section id="inner-headline">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="pageTitle">SQL Demos</h2>
            </div>
        </div>
    </div>
</section>
<section id="content">


    <?php
    if (isset($_SESSION['user_id']) && isset($_SESSION['fullname']) && empty($_SESSION['active'])) {
        $userid = $_SESSION['user_id'];
    } else {
        $userid = "";
    }


    if ($userid == "") {
        //USER NOT LOGGED IN? 
        echo "<div class='container content'>";


        echo "<div class='row'>";
        echo '<div class="col-md-12">';
        echo '<div class="about-logo">';
        echo '<h2 class="resreg">Registered Users Only</h2>
              <p class="resreg">You must be logged in or have an active account to see demos!<br>Check your email to activate your account</p>';
        ?>
        <p class="resreg"><a href="login.php" >Login</a><strong> or </strong><a href="register.php">Register</a></p>
        <?php
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    } else if ($_SESSION['user_id']) {
        ?>
        <div class="container content">		
            <!-- Service Blcoks -->

            <div class="row"> 
                <div class="col-md-12">
                    <div class="about-logo">
                        <h3>SQL <span class="color">Demos</span></h3>
                        <p>For the months of October and November, SQL queries where covered in class. A list of the chapters will be excusable along with the demos that went along with them.  
                            
                    </div>  
                </div>
            </div>
            <?php
            //Get All demos by calling the getdemoList method 
            //from the DbHandler class, returning array data in variable
            //$data
///////////////////////////////////////////////////////////////////////////////////

            if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) {
                //get single article for particular id
                $id = $_GET['id'];

                $data = $dbh->getDemoList($id);
                //var_dump($data);



                if ($data['error'] == false) {
                    //success - display data items within html table
                    $demo = $data['items'];
                    if (empty($demo)) {
                        //no article with that id
                        echo '<h3>No article</h3>';
                    } else {
                        $output = "<table class='table table-striped'>
              <thead>
                <tr>
                    <th>Demo Name</th>
                    <th>Chapter Number</th>
                    <th>Demo Link</th>
                </tr>
              </thead>
              <tbody>";


                        //loop all records creating tr td combination
                        foreach ($demo as $item):
                            $chapterid = $item['chapterID'];
                            $demoid = $item['demoID'];
                            $demoName = $item['demoName'];
                            $chapterNumber = $item['chapterNumber'];
                            //$description = $item['description'];
                            $output .= "<tr>
              <td>$demoName</td>
              
              <td>$chapterNumber</td>    
              <td><a href='/demoCode.php?id=$demoid'>Demo $demoid</a>              
              </td>
              </tr>";
                        endforeach;
                        $output .= "</tbody></table>";

                        //display final output
                        echo $output;
                    }
                }
            }else {
                echo "<h3>This page has been accessed in error.</h3>";
            }
            ?>
        </div>
    </div>

    <?php
}
?>



