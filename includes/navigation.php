<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">CMS Front</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
        <?php 
            $query = "SELECT * FROM categories";
            $select_all_categories_query = mysqli_query($conn,$query);
            while ($row=mysqli_fetch_assoc($select_all_categories_query)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
        ?>
                <li>
                    <a href="category.php?category=<?php echo $cat_id?>"><?php echo $cat_title?></a>
                </li>
                
        <?php 
           }
           ?>
                <li>
                    <a href="admin/index.php">Admin</a>
                </li>   
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
