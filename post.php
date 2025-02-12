<?php include "includes/db.php" ?>
<?php include "includes/header.php"?>
    <!-- Navigation -->
    <?php include "includes/navigation.php"?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <?php 
                if(isset($_GET['p_id'])){
                    $post_id = $_GET['p_id'];
                }
                $query = "SELECT * FROM posts WHERE post_id = $post_id";
                $get_posts_query = mysqli_query($conn,$query);
                while($row = mysqli_fetch_assoc($get_posts_query)){
                    $post_id = $row['post_id'];
                    $post_category_id = $row['post_category_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    $post_tags = $row['post_tags'];
                    

                
                ?>

                <!-- Second Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image;?>">
                <hr>
                <p><?php echo $post_content; ?></p>
                

                <hr>
            <?php }?>
            <!-- Comments Form -->
            <?php 
            if(isset($_POST['create_comment'])){
                $post_id = $_GET['p_id'];
                $comment_author = $_POST['comment_author'];
                $comment_email = $_POST['comment_email'];
                $comment_content = $_POST['comment_content'];
                //insert data into database
                $query = "INSERT INTO comments(`comment_post_id`,`comment_author`,`comment_email`,`comment_content`,`comment_status`,`comment_date`) ";
                $query .= "VALUES($post_id,'{$comment_author}','{$comment_email}','{$comment_content}','unapproved',now()) ";

                $create_comment_query = mysqli_query($conn,$query);
               if(!$create_comment_query){
                die("Comment not inserted".mysqli_error($conn));
            }
            $query = "UPDATE posts SET post_comment_count = post_comment_count + 1";
            $query .= " WHERE post_id = $post_id";
            $update_comment_count = mysqli_query($conn,$query);
        }
            ?>
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form role="form" method="post" action="">
                    <div class="form-group">
                        <label for="author">Author</label>
                        <input type="text" class="form-control" name="comment_author"/>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="comment_email"/>
                    </div>
                    <div class="form-group">
                        <label for="comment_content">Your comment</label>
                        <textarea class="form-control" rows="3" name="comment_content"></textarea>
                    </div>
                    <button type="submit" name="create_comment" class="btn btn-primary" value="submit">Submit</button>
                </form>
            </div>

                <hr>
                <!-- Comment -->
                    
                <?php
                $query = "SELECT * FROM comments WHERE comment_post_id = $post_id ";
                $query .= "AND comment_status = 'approved' ";
                $query .= "ORDER BY comment_id DESC";
                $select_comment_query = mysqli_query($conn,$query);
                if(!$select_comment_query){
                    die('Query Failed'.mysqli_error($conn));
                }
                while($row = mysqli_fetch_assoc($select_comment_query)){
                    echo '<div class="media">';
                    echo '<a class="pull-left" href="#">';
                    echo '<img class="media-object" src="http://placehold.it/64x64" alt="">';
                    echo '</a>';
                    echo '<div class="media-body">';
                    $comment_date = $row['comment_date'];
                    $comment_content = $row['comment_content'];
                    $comment_author = $row['comment_author'];
                    echo '<h4 class="media-heading">'.$comment_author;
                    echo '<small>'.$comment_date.'</small>';
                    echo '</h4>';
                    echo $comment_content;
                }?>     
                    </div>
                </div>
                
                <!-- Comment -->
                <!--<div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        // Nested Comment
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Nested Start Bootstrap
                                    <small>August 25, 2014 at 9:30 PM</small>
                                </h4>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div>
                         End Nested Comment -->
                    </div>
                </div>

                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>

            </div>


                
            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

        <!-- /.row -->

        <hr>

        <!-- Footer -->

<?php include "includes/footer.php"?>