<?php

/**DETECT USER ID */
function loggedInUserId() {

	global $connection;

	global $fetchUserId;

    if(isLoggedIn()) {

        $query = ("SELECT * FROM user_todo WHERE username = '" . $_SESSION['username'] . "'" );

        $result = mysqli_query($connection, $query);

        if (!$result) {
        	die('QUERY FAILED' . mysqli_error($connection));
        }

        $fetchUserId = mysqli_fetch_array($result);

        return mysqli_num_rows($result) >= 1 ? $fetchUserId['user_id'] : false;

    }

    return false;
}

//** INSERT TO DO**//
function insertToDo() {

	global $connection;

	global $error;

	$task = $_POST['task'];

	if (empty($task)) {
		
		$error = "<p class='alert-danger'>This field cant be empty</p>";

	} else {

			$query = "INSERT INTO todo(task, date, user_id) VALUES('{$task}', now()," . loggedInUserId() . ")";

			$task_query = mysqli_query($connection, $query);

	}

	return false;				
}

//*DELETE TO DO*//
function deleteToDo() {

	global $connection;

	$task_delete = $_GET['delete'];

	$query = "DELETE FROM todo WHERE id = {$task_delete}";

	$delete_query = mysqli_query($connection, $query);

	header('location: todolist.php');
}

//*CHECK EMAIL EXISTS*//
function emailExist($email) {

    global $connection;



    $query = "SELECT email FROM user_todo WHERE email = '$email'";

    $result = mysqli_query($connection, $query);

    if (!$result) {
    	die('QUERY FAILED' . mysqli_error($connection));
    }



    if(mysqli_num_rows($result) > 0) {



        return true;

    } else {



        return false;

    }

}

//*CHECK USERNAME EXISTS*//
function usernameExist($username) {

    global $connection;



    $query = "SELECT username FROM user_todo WHERE username = '$username'";

    $result = mysqli_query($connection, $query);

    if (!$result) {
    	die('QUERY FAILED' . mysqli_error($connection));
    }



    if(mysqli_num_rows($result) > 0) {



        return true;

    } else {



        return false;

    }

}


//* REGISTER USER *//
function register($username, $password, $email) {

	global $connection;

	$username = mysqli_real_escape_string($connection, $username);

    $email    = mysqli_real_escape_string($connection, $email);

    $password = mysqli_real_escape_string($connection, $password);

    $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

	$query = "INSERT INTO user_todo(username, password, email) VALUES('{$username}', '{$password}', '{$email}')";
	$register_query = mysqli_query($connection, $query);
}

//* LOGIN USER *//
function logIn($username, $password) {

	global $connection;

	global $error;

	$username = $_POST['username'];

	$password = $_POST['password'];

	$username = trim($username);

    $password = trim($password);

    $username = mysqli_real_escape_string($connection, $username);

    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM user_todo WHERE username = '{$username}'";

    $select_username_query = mysqli_query($connection, $query);

    if (!$select_username_query) {
    	die('QUERY FAILED' . mysqli_error($connection));
    }

    while ($row = mysqli_fetch_array($select_username_query)) {
    	
    	$db_id       = $row['user_id'];
    	$db_username = $row['username'];
    	$db_password = $row['password'];
    	$db_email    = $row['email'];


    	if (password_verify($password, $db_password)) {
    		
    		$_SESSION['user_id'] = $db_id;
    		$_SESSION['username'] = $db_username;
    		$_SESSION['email'] = $db_email;

    		header('location: todolist.php');
    	} else {

    	 $error = "<p class='alert-warning'>Invalid username or password. Try again!</p>";
    }

    }

    $error = "<p class='alert-warning'>Invalid username or password. Try again!</p>";
}

//* IF USER IS LOGGED IN *//
function isLoggedIn(){



    if (isset($_SESSION['username'])) {

        

        return true;

    }



    return false;

}





?>