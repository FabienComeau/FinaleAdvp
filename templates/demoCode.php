<section id="inner-headline">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="pageTitle">SQL Code</h2>
            </div>
        </div>
    </div>
</section>
<section id="content">
    <div class="container content">		
        <!-- Service Blcoks -->

<!--        <div class="row"> 
            <div class="col-md-12">
                <div class="about-logo">
                    <h3>SQL <span class="color">Demos</span></h3>
                    <p>For the months of October and November, SQL queries where covered in class. A list of the chapters will be excusable along with the demos that went along with them.  
                        <br>!!!!!!!!!!!Just to make it look better I would like to put another blerb here about SQL to fill up the space  sgv drbvfdgvrefgv fdgvfdcv fbfdhuhvlksjlkjfdo!!!!!!!!!!!!!</p>
                </div>  
            </div>
        </div>-->
        <!-- Info Blcoks -->
        <div class="row">       


 <?php
       
        if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) {
            //get single article for particular id
            $id = $_GET['id'];
     
                    $data = $dbh->getDemoCode($id);

                    if ($data['error'] == false) {
                        $catItems = $data['items'];
                        
                      if (empty($catItems)) {
                    //no article with that id
                   echo '<h3>No article</h3>';
                } else {   

                        foreach ($catItems as $item) {
                            $catId = $item['demoID'];
                            $demoCode = $item['demo_code'];                 
                            $demoName = $item['demoName'];
                            echo "<h3>$demoName</h3>";
                            echo "<pre><p><code>$demoCode</code></p></pre>";                            
                            
                        }
                    }
}else{
        echo "<h3>This page has been accessed in error.</h3>";
    }
        }

?>

       </div>
    </div>           