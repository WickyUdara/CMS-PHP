<?php include "includes/admin_header.php"?>
<?php include "../includes/db.php"?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navbar.php"?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to admin
                            
                            <small><?php echo $_SESSION['username'];?></small>
                            
                        </h1>
                        
                    </div>
                </div>
                <!-- /.row -->
                                      
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <?php 
                                    $query = "SELECT * FROM posts";
                                    $select_all_post = mysqli_query($conn,$query);
                                    $posts_count = mysqli_num_rows($select_all_post);
                                    echo "<div class='huge'>{$posts_count}</div>";
                                    ?>
                                
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <?php 
                                    $query = "SELECT * FROM comments";
                                    $select_all_comments = mysqli_query($conn,$query);
                                    $comments_count = mysqli_num_rows($select_all_comments);
                                    echo "<div class='huge'>{$comments_count}</div>";
                                    ?>
                                    <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <?php 
                                    $query = "SELECT * FROM users";
                                    $select_all_users = mysqli_query($conn,$query);
                                    $users_count = mysqli_num_rows($select_all_users);
                                    echo "<div class='huge'>{$users_count}</div>";
                                    ?>                          
                                    
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <?php 
                                        $query = "SELECT * FROM categories";
                                        $select_all_categories = mysqli_query($conn,$query);
                                        $categories_count = mysqli_num_rows($select_all_categories);
                                        echo "<div class='huge'>{$categories_count}</div>";
                                    ?>
                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <?php 
                $query = "SELECT * FROM posts WHERE post_status = 'draft'";
                $select_draft_posts = mysqli_query($conn,$query);
                $draft_post_count = mysqli_num_rows($select_draft_posts);
                
                $query = "SELECT * FROM posts WHERE post_status = 'published'";
                $select_published_posts = mysqli_query($conn,$query);
                $published_post_count = mysqli_num_rows($select_published_posts); 
                
                $query = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
                $select_unapproved_comments = mysqli_query($conn,$query);
                $unapproved_comments_count = mysqli_num_rows($select_unapproved_comments); 

                $query = "SELECT * FROM users WHERE user_role = 'subscriber'";
                $select_subscriber_users = mysqli_query($conn,$query);
                $subscriber_users_count = mysqli_num_rows($select_subscriber_users); 
                
                ?>


                <div class="row">
                <script type="text/javascript">
                    google.charts.load('current', {'packages':['bar']});
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Data','Count'],
                            //[1000,500],
                            <?php
                            $element_text = ['Active Posts','Comments','Users','Categories','Draft Posts','Published Posts','UnCommen','Subscribers'];
                        $element_count = [$posts_count,$comments_count,$users_count,$categories_count,$draft_post_count,$published_post_count,$unapproved_comments_count,$subscriber_users_count];
                            
                            for($i = 0; $i < 8; $i ++ ){
                                 echo"['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
                            };
                            ?>
                            //['Data','Count'],
                            //['Active Posts', 5],
                            //['Categories', 10],
                            //['Users', 10],
                            
                        ]);

                        var options = {
                        chart: {
                            title: 'Company Performance',
                            subtitle: 'Sales, Expenses, and Profit: 2014-2017',
                        }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                    </script>  
                    <div id="columnchart_material" style="width: 800px; height: 500px;"></div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    
    <script src="js/scripts.js"></script>
</body>

</html>
