<?php


require __DIR__ . '/vendor/autoload.php';

  $options = array(
    'cluster' => 'us2',
    'encrypted' => false
  );
  $pusher = new Pusher\Pusher(
    'c2018f2bea1a7c851e0c',
    '614eea2a1b3554cc7ca6',
    '793674',
    $options
  );


$data['message'] = 'vmro';
 $pusher->trigger('notifications', 'new_user', $data);






?>

<button id="a">kopce</button>

<script src="https://js.pusher.com/4.4/pusher.min.js"></script>
<link rel="stylesheet" type="text/css" href="admin/css/toastr.css">
<script src="admin/js/toastr.min.js"></script>
<script src="js/jquery.js"></script>

<script type="text/javascript">
    
	$(document).ready(function() {


	$("#a").click(function(){


    Pusher.logToConsole = true;

    var pusher = new Pusher('c2018f2bea1a7c851e0c', {

        cluster: 'us2',
        encrypted: true
    });

    var notificationChannel = pusher.subscribe('notifications');

    notificationChannel.bind('new_user', function(notification){

        var message = notification.message;
        console.log(message);
    });

    });
});




</script>