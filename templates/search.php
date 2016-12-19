

<section id="inner-headline">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="pageTitle">SQL Search</h2>
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
        echo '<h2 class="resreg">Registered Users Only</h2>
              <p class="resreg">You must be logged in or have an active account to see demos!<br>Check your email to activate your account</p>';
        ?>
        <p class="resreg"><a href="login.php" >Login</a><strong> or </strong><a href="register.php">Register</a></p>
        <?php
    } else if ($_SESSION['user_id']) {
        ?>
        <div class="container content">		
            <!-- Service Blcoks -->

            <div class="row"> 
                <div class="col-md-12">
                    <div class="about-logo">
                        <h3>SQL <span class="color">Search</span></h3>
                        <p>For the months of October and November, SQL queries where covered in class. A list of the chapters will be excusable along with the demos that went along with them.  
                            <br>!!!!!!!!!!!Just to make it look better I would like to put another blerb here about SQL to fill up the space  sgv drbvfdgvrefgv fdgvfdcv fbfdhuhvlksjlkjfdo!!!!!!!!!!!!!</p>
                    </div>  
                </div>
            </div>
            <?php
 

            if (isset($_GET['s'])) {
                //get single article for particular id
                $search = $_GET['s'];

                $data = $dbh->getSearch($search);
                //var_dump($data);



                if ($data['error'] == false) {
                    //success - display data items within html table
                    $searchdemo = $data['items'];
                    if ($searchdemo) {
                        
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
                        foreach ($searchdemo as $item):
                            $chapterid = $item['chapterID'];
                            $demoid = $item['demoID'];
                            $demoName = $item['demoName'];
                            //$chapterNumber = $item['chapterNumber'];                           
                            $output .= "<tr>
              <td>$demoName</td>
              
              <td>$chapterid</td>    
              <td><a href='/FinaleAdvp/demoCode.php?id=$demoid'>Demo $demoid</a>              
              </td>
              </tr>";
                            
                        endforeach;
                        //$output .= "</tbody></table>";

                        //display final output
                        echo $output;
                        echo "</tbody></table>";
                    }else{
                    //Nothing found
                    echo '<p class="bg-danger">No Results found!</p>';
                }
            }else {
                echo "<h3>This page has been accessed in error.</h3>";
            }
            }
            ?>
        </div>
    </div>

    <?php
}
?>



