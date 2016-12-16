

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
    <div class="container content">		
        <!-- Service Blcoks -->

        <div class="row"> 
            <div class="col-md-12">
                <div class="about-logo">
                    <h3>SQL <span class="color">Demos</span></h3>
                    <p>For the months of October and November, SQL queries where covered in class. A list of the chapters will be excusable along with the demos that went along with them.  
                        <br>!!!!!!!!!!!Just to make it look better I would like to put another blerb here about SQL to fill up the space  sgv drbvfdgvrefgv fdgvfdcv fbfdhuhvlksjlkjfdo!!!!!!!!!!!!!</p>
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
              <td><a href='/FinaleAdvp/demoCode.php?id=$demoid'>Demo $demoid</a>              
              </td>
              </tr>";
                        endforeach;
                        $output .= "</tbody></table>";

                        //display final output
                        echo $output;
                    }
                }
            
        }else{
        echo "<h3>This page has been accessed in error.</h3>";
    }
                ?>
    </div>
</div>





