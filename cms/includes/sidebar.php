<?php session_start(); ?>
<?php ob_start(); ?>

            <div id="sidebar" class="col-md-4 pull-right">

            <?php
            
            if(ifItIsMethod('post')) {

                if(isset($_POST['login'])) {

                    if(isset($_POST['username']) && isset($_POST['password'])) {

                        loginUser($_POST['username'], $_POST['password']); 
    
                     } else {

                        redirect('index.php');
                     }

                }
                 
            }
            
            ?>
                <!-- Blog Search Well -->
                <div class="well">
                    <!-- search form 6 -->
                        <div class="button_box2">
                        <form action="search.php" method="post" class="form-wrapper-2 cf">
                        <input name="search" type="text" placeholder="Search" required>
                        <button name="submit" type="submit">Search</button>
                        </form>
                        </div>

                <?php if (isset($_SESSION['username'])): ?>
                    
                    <h4>Welcome <?php echo $_SESSION['firstname'] ?> &#128515</h4>
                    <h4>Have a <span class="greeting"></span>! &#128516</h4>

                    <script src="js/jquery.js"></script>

                    <script>
                    
                        var thehours = new Date().getHours();
                        var themessage;
                        var morning = ('Good morning');
                        var afternoon = ('Good afternoon');
                        var evening = ('Good evening');

                        if (thehours >= 0 && thehours < 12) {
                            themessage = morning; 

                        } else if (thehours >= 12 && thehours < 17) {
                            themessage = afternoon;

                        } else if (thehours >= 17 && thehours < 24) {
                            themessage = evening;
                        }

                        $('.greeting').append(themessage);

                    </script>
                
                <?php else: ?>

                    <div class='window' style="height:100%;">
                        <div class='overlay' style="height:100%;"></div>
                        <div class='content'>
                        <div class='welcome'>Hello There!</div>
                        <div class='subtitle'>We're almost done. Before using our services you need to log in. If you dont have an account create one!</div>
                        <div class='input-fields'>
                            <form action="" method="post">
                            <input name="username" type='text' placeholder='Username' class='input-line full-width'>
                            <input name="password" type='password' placeholder='Password' class='input-line full-width'>
                            

                        </div>
                        <div class='spacing'>Forgot your password? <span class='highlight'><a href="./forgot.php?forgot=<?php echo uniqid(true); ?>">Click HERE</a></span></div>
                        <div><button name="login" type="submit" class='ghost-round full-width'>Log in</button></div>
                        </form>
                        <div><a href="./registration.php"><button class='ghost-round full-width'>Create Account</button></a></div>
                        <div><?php echo $log_in; ?></div>
                        </div>
                    </div>

                <?php endif; ?>

                <!-- Blog Categories Well -->

                    <?php

                    $query = "SELECT * FROM categories";
                    $select_categories_sidebar = mysqli_query($connection, $query);

                    ?>

                </div>







                <!-- Side Widget Well -->
                <?php include "widget.php" ?>

            </div>