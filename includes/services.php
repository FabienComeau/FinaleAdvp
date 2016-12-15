<section id="inner-headline">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="pageTitle">SQL Chapters</h2>
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
                    <h3>SQL <span class="color">Chapters</span></h3>
                    <p>For the months of October and November, SQL queries where covered in class. A list of the chapters will be excusable along with the demos that went along with them.  
                        <br>!!!!!!!!!!!Just to make it look better I would like to put another blerb here about SQL to fill up the space  sgv drbvfdgvrefgv fdgvfdcv fbfdhuhvlksjlkjfdo!!!!!!!!!!!!!</p>
                </div>  
            </div>
        </div>
        <!-- Info Blcoks -->
        <div class="row">     


                    <?php
     
                    $data = $dbh->getchapterList();
//var_dump($data);
//var_dump($data);

                    if ($data['error'] == false) {
                        $catItems = $data['items'];

                        foreach ($catItems as $item) {
                            $catId = $item['chapterID'];
                            $chapter = $item['chapterNumber'];
                            
                            //$total = $item['total'];
                            
                            echo '<div class="col-sm-4 info-blocks">';
                            echo '<div class="info-blocks-in">';
                            echo "<h4>Chapter $chapter</h4><br>";                            
                            echo "<p><a class=\"btn btn-warning\" href='/FinaleAdvp/demo.php?id=$catId' role=\"button\">Demos &raquo;</a></p>";
                            echo '</div>';
                            echo '</div>';
                            //echo "<li><a href='/Advp_Web_Study/services.php?id=$catId'>$chapter</a></li>";
                        }
                    }
                     
                    
                    ?>
          
        </div>
    </div>