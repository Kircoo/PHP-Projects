
<?php include 'db.php'; ?>
<?php include '../admin/functions.php'; ?>

<?php


	if (isset($_POST['login'])) {

        loginUser(escape($_POST['username']), escape($_POST['password']));




	}


?>