<?php

$db = "localhost";

$db_username = "root";

$db_password = "";

$db_table = "divisima";

$db = mysqli_connect($db, $db_username, $db_password, $db_table);

if (!$db) {
	die("CONNECTION FAILED" . mysqli_error($db));
}

?>