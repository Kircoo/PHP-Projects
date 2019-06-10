<div class="menu-top">
<nav id="navbar-main" class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
            </div>



            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-first">
                <?php
                
                $home_class = '';
                $pageName = basename($_SERVER['PHP_SELF']);
                $home = 'index.php';

                if($pageName == $home) {

                    $home_class = 'active';
                }

                
                ?>
                <li class="<?php echo $home_class; ?>"><a href="index.php">Home</a></li>

                    <li class='dropdown'>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Categories<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                    <?php

                    $query = "SELECT * FROM categories";
                    $select_all_categories_query = mysqli_query($connection, $query);

                    while ($row = mysqli_fetch_array($select_all_categories_query)) {
                        
                    $cat_title = $row['cat_title'];
                    $cat_id = $row['cat_id'];

                    $category_class = '';

                    $contact_class = '';

                    $login_class = '';

                    $home_class = '';

                    $pageName = basename($_SERVER['PHP_SELF']);
                    
                    $contact = 'contact.php';

                    $login = 'login.php';

                    $home = 'index.php';

                    if (isset($_GET['category']) && $_GET['category'] == $cat_id) {

                        $category_class = 'active';
                        
                        
                    } else if ($pageName == $contact) {

                        $contact_class = 'active';


                    } else if ($pageName == $login) {

                        $login_class = 'active';
                    } 

                    echo "<li class='$category_class'><a href='category.php?category={$cat_id}'>{$cat_title}</a></li>";

                    }

                    ?>
                    </ul>
                    </li>

                    <?php if(is_admin()): ?>

                    <li class='<?php echo $login_class; ?>'>
                        <a href="admin/dashboard.php">Admin</a>
                    </li>

                    <li>
                        <a href="includes/logout.php">Log out</a>
                    </li>

                    <?php elseif(is_sub()): ?>

                    <li>
                        <a href="includes/logout.php">Log out</a>
                    </li>

                    <?php else: ?>

                    <li class='<?php echo $login_class; ?>'>
                        <a href="login.php">Log in</a>
                    </li>

                    <?php endif; ?>

                    
                    <li class='<?php echo $contact_class; ?>'>
                        <a href="contact.php">Contact</a>
                    </li>

                    <li>
                        <a href="http://tikataka.mk/weather/" target="_blank">Weather</a>
                    </li>

                    <?php

                    if (is_admin()) {
                        
                        if (isset($_GET['p_id'])) {

                            $the_post_id = escape($_GET['p_id']);
                            
                            echo "<li><a href='admin/posts.php?source=edit_post&p_id={$the_post_id}'>Edit Post</a></li>";

                        }

                    }

                    ?>

                </ul>




        <?php if (isset($_SESSION['username'])): ?>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img class="profile-image" src='images/<?php userImage(); ?>'>

                    
                    <?php echo $_SESSION['username']; ?>


                    <b class="caret"></b></a>
                    <ul class="dropdown-menu">

        <?php if(is_admin()): ?>
                                <li>
                                    <a href="admin/dashboard.php"><i class="fa fa-user"></i> Admin panel</a>
                                </li>
        <?php else: ?>
                                <li>
                                    <a href="admin"><i class="fa fa-fw fa-user"></i> Profile</a>
                                </li>
        <?php endif; ?>
                                <li class="divider"></li>
                                <li>
                                    <a href="includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
        <?php endif; ?>

            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
</div>