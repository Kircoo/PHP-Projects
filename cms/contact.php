<?php session_start(); ?>
<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

<?php

if (isset($_POST['submit'])) {

    $msg = wordwrap($msg,70);

    $to = "kircoosarkovski@gmail.com";
    $subject = wordwrap($_POST['subject'], 70);
    $body = $_POST['body'];
    $header = "FROM:" .$_POST['email'];
    
    mail($to,$subject,$body, $header);
    
    $emailsent = 'Your email has been sent! We will contact you as soon as posible!';

} else {
    
    $emailsent = '';
}

?>

    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
    <!-- Page Content -->
    <div class="container">
    
        <section id="login">

            <div class="container">

                <div class="row">

                    <div class="col-md-3 col-sm-12"></div>

                    <div class="col-md-6 col-sm-12">

                        <div class="form-wrap">

                        <h1 class="text-center">Contact</h1>

                        <div class='bg-success text-center'><h3><?php echo $emailsent ?></h3></div>

                        <div class='window' style="width:100%!important;">

                                    <div class='overlay'></div>

                                        <div class='content'>
                                            
                                                    <div class='input-fields'>

                                                        <form action="" method="post">

                                                            <input name="email" type='email' placeholder='Email Address' class='input-line full-width'>

                                                            <input name="subject" type='text' placeholder='Enter subject' class='input-line full-width'>

                                                            <textarea name="body" class="form-control" rows="6"></textarea>
                                                
                                                        </div>

                                                            <div><button name="submit" type="submit" class='ghost-round full-width mt-5'>Send</button></div>

                                                        </form>
                                            </div>

                                        </div>
                                </div>
                         
                        </div>

                    </div> <!-- /.col-xs-12 -->

                    <div class="col-md-3 col-sm-12"></div>

                </div> <!-- /.row -->

            </div> <!-- /.container -->

        </section>

        <hr>

</div>

<div class="mapouter"><div class="gmap_canvas"><iframe width="100%" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=radovis&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.pureblack.de"></a></div><style>.mapouter{position:relative;text-align:right;height:500px;width:100%;}.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:100%;}</style></div>

<?php include "includes/footer.php";?>
