<?php


//========== DATABASE HELPER FUNCTIONS ==========//

/**REDIRECT */

function redirect($location) {



    header("Location: " . $location);

    exit;

}

/**IMAGE PLACEHOLDER */

function imagePlaceholder($image='') {



    if(!$image) {

        return '350x150.png';

    } else {

        return $image;

    }

}

/**IMAGE PLACEHOLDER USER*/

function imagePlaceholderUser($image='') {



    if(!$image) {

        return 'userpicture.png';

    } else {

        return $image;

    }

}

/**SESSION USER */

function currentUser() {

    if(isset($_SESSION['username'])) {

        return $_SESSION['username'];

    }

    return false;

}

/**QUERY */
function query($query) {

    global $connection;
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    return $result;
}

/**DETECT USER IMAGE */
function userImageAll() {
    global $connection;
    $query = "SELECT * FROM users ";
    $select_users_query = mysqli_query($connection, $query);

    $row = mysqli_fetch_array($select_users_query);

    $user_image = $row['user_image'];


    echo $user_image;
    
}

/**POST COMMENT */
function postComment() {
    global $connection;

    if(isset($_POST['create_comment'])) {

        $query = "SELECT user_image FROM users WHERE user_id = " . loggedInUserId() . "";
        $insert_comment_image = mysqli_query($connection, $query);

        $row = mysqli_fetch_array($insert_comment_image);
        $insert_image = $row['user_image'];
        

        $the_post_id = $_GET['p_id'];
        $comment_author = $_POST['comment_author'];
        $comment_email = $_POST['comment_email'];
        $comment_content = $_POST['comment_content'];


        if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {


            $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status,comment_date, user_image)";

            $query .= "VALUES ($the_post_id ,'{$comment_author}', '{$comment_email}', '{$comment_content }', 'unapproved',now(), '{$insert_image}')";

            $create_comment_query = mysqli_query($connection, $query);

            if (!$create_comment_query) {
                die('QUERY FAILED' . mysqli_error($connection));


            }


        }


    }
}

/**DELETE USER */
function deleteUser() {
    global $connection;
    if(isset($_POST['delete_profile'])) {
        $query = "DELETE FROM users WHERE user_id =" . loggedInUserId() . "";
        $delete_query = mysqli_query($connection, $query);

        redirect('../includes/logout.php');

    }
}


/**DETECT CURENT USER PICTURE */
function userImage() {
    global $connection;
    $query = "SELECT user_image FROM users WHERE user_id = " . loggedInUserId() . "";
    $select_image = mysqli_query($connection, $query);

    $row = mysqli_fetch_array($select_image);

    $show_image = $row['user_image'];

    if(!$show_image) {

        echo imagePlaceholderUser($show_image);

    } else {

    echo $show_image;

    }
}

/**DETECT USER ID */
function loggedInUserId() {

    if(isLoggedIn()) {

        $result = query("SELECT * FROM users WHERE username = '" . $_SESSION['username'] . "'" );
        confirmQuery($result);

        $fetchUserId = mysqli_fetch_array($result);

        return mysqli_num_rows($result) >= 1 ? $fetchUserId['user_id'] : false;

    }

    return false;
}

/**USER LIKE POST */
function userLikePost($post_id = '') {

    $result = query("SELECT * FROM Likes WHERE user_id =" . loggedInUserId() . " AND post_id = {$post_id}" );
    confirmQuery($result);
    return mysqli_num_rows($result) >= 1 ? true : false;
}

/**POST LIKES */
function getPostlikes($post_id) {

    $result = query("SELECT * FROM Likes WHERE post_id = $post_id");
    confirmQuery($result);
    echo mysqli_num_rows($result);
}

/**LOGIN FUNCTIONS */

function ifItIsMethod($method=null) {



    if($_SERVER['REQUEST_METHOD'] == strtoupper($method)){



        return true;

    }



    return false;

}

function isLoggedIn(){



    if (isset($_SESSION['user_role'])) {

        

        return true;

    }



    return false;

}



function checkIfUserIsLoggedInAndRedirect($redirectLocation=null) {



    if (isLoggedIn()) {

        

        redirect($redirectLocation);

    }

}



/* ESCAPE STRING DATABASE */

function escape($string) {



    global $connection;



    return mysqli_real_escape_string($connection, trim($string));

}



/* MOMENT USERS ONLINE */

function usersOnline() {





    if (isset($_GET['onlineusers'])) {



    global $connection;



    if (!$connection) {

        

        session_start();



        include "../includes/db.php";



    $session = session_id();

    $time = time();

    $time_out_in_seconds = 05;

    $time_out = $time - $time_out_in_seconds;



    $query = "SELECT * FROM users_online WHERE session = '$session'";

    $send_query = mysqli_query($connection, $query);

    $count = mysqli_num_rows($send_query);



    if ($count == NULL) {

        

        mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session', '$time')");

    } else {



        mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");

    }



    $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");

    echo $count_user = mysqli_num_rows($users_online_query);







        }





    } // GET REQUEST isset()

}

usersOnline();



/* CONFIRM QUERIES */

function confirmQuery($result) {



        global $connection;

        if (!$result) {

        die('QUERY FAILED' . mysqli_error($connection));

    }



}





/** ADD CATEGORY */

function insertCategory() {



global $connection;

if (isset($_POST['submit'])) {



    $cat_title = $_POST['cat_title'];



         if ($cat_title == '' || empty($cat_title)) {

             echo "This field shouldn't be emtpy!";

         } else {



               $stmt = mysqli_prepare($connection, "INSERT INTO categories(cat_title) VALUES(?)");



               mysqli_stmt_bind_param($stmt, 's', $cat_title);



               mysqli_stmt_execute($stmt);



                if (!$stmt) {

                    die('Query failed!' . mysqli_error($connection));

            }



        }

                                

    }

}



/**SHOW CATEGORIES */

function showAllCategories() {

	global $connection;

	$query = "SELECT * FROM categories";

    $select_categories = mysqli_query($connection, $query);



    while ($row = mysqli_fetch_array($select_categories)) {

                                

    $cat_id = $row['cat_id'];

    $cat_title = $row['cat_title'];



    echo "<tr>";

    echo "<td>{$cat_id}</td>";

    echo "<td>{$cat_title}</td>";

    echo "<td><a class='btn btn-primary' href='categories.php?delete={$cat_id}'>Delete</a></td>";

    echo "<td><a class='btn btn-primary' href='categories.php?edit={$cat_id}'>Edit</a></td>";

    echo "</tr>";



    }

}





/** DELETE CATEGORY */

function deleteCategories() {



	global $connection;

	if (isset($_GET['delete'])) {



        $the_cat_id = $_GET['delete'];





        $stmt = mysqli_prepare($connection, "DELETE FROM categories WHERE cat_id = ? ");

        mysqli_stmt_bind_param($stmt, 'i', $the_cat_id);

        mysqli_execute($stmt);

        header('location: categories.php');

                                    



    }

}



/* ADMIN INDEX COUNT ITEMS */

function recordCount($table) {

    global $connection;

    $query = "SELECT * FROM " . $table;

    $select_query_post = mysqli_query($connection, $query);

    $result = mysqli_num_rows($select_query_post);

    return $result;

}

/**SEPARATEE USER POSTS */
function get_users_posts(){

    $user = currentUser();
    return query("SELECT * FROM posts WHERE user_id =". loggedInUserId() . "");

}

/**GET SEPARETE USER COMMENTS */
function get_user_post_comments() {
    return query("SELECT * FROM posts INNER JOIN comments ON posts.post_id = comments.comment_post_id WHERE user_id =" . loggedInUserId() . "");
}

/**GET SEPARATE USER PUBLISH POST */
function all_user_published_posts(){

    return query("SELECT * FROM posts WHERE user_id =". loggedInUserId() . " AND post_status = 'published'");
}
/**GET SEPARATE USER PUBLISH DRAFT */
function all_user_draft_posts(){

    return query("SELECT * FROM posts WHERE user_id =". loggedInUserId() . " AND post_status = 'draft'");
}

/**GET SEPARATE USER UNNAPROVED STATUS */
function all_user_comments_unnaproved(){

    return query("SELECT * FROM posts INNER JOIN comments ON posts.post_id = comments.comment_post_id WHERE user_id =" . loggedInUserId() . " AND comment_status = 'unapproved'");
}

/**GET SEPARATE USER APROVED STATUS */
function all_user_comments_aproved(){

    return query("SELECT * FROM posts INNER JOIN comments ON posts.post_id = comments.comment_post_id WHERE user_id =" . loggedInUserId() . " AND comment_status = 'Approved'");
}

/** ADMIN INDEX COUNT ITEMS */

function checkStatus($table, $column, $status){

    global $connection;

    $query = "SELECT * FROM $table WHERE $column = '$status' ";

    $result = mysqli_query($connection, $query);



    return mysqli_num_rows($result);

}



/** ADMIN ROLE COUNT */

function checkRole($table, $column, $role){



    global $connection;

    $query = "SELECT * FROM $table WHERE $column = '$role' ";

    $result = mysqli_query($connection, $query);



    return mysqli_num_rows($result);

}

/** SHOW POSTS ADMIN */
function showAllPostsAdmin() {

    global $connection;

    $query = "SELECT posts.post_id, posts.post_category_id, posts.post_title, posts.post_author, posts.post_date, posts.post_image, ";

    $query .= "posts.post_content, posts.post_tags, posts.post_comment_count, posts.post_status, posts.post_views_counts, categories.cat_id, categories.cat_title ";

    $query .= "FROM posts ";

    $query .= "LEFT JOIN categories ON posts.post_category_id = categories.cat_id ORDER BY posts.post_id DESC";

    return mysqli_query($connection, $query);

}
/** SHOW POSTS */
function showAllPosts() {

    

    global $connection;

    

    $user = currentUser();

    $query = "SELECT posts.post_id, posts.post_category_id, posts.post_title, posts.post_author, posts.post_date, posts.post_image, ";

    $query .= "posts.post_content, posts.post_tags, posts.post_comment_count, posts.post_status, posts.post_views_counts, categories.cat_id, categories.cat_title ";

    $query .= "FROM posts ";

    $query .= "LEFT JOIN categories ON posts.post_category_id = categories.cat_id WHERE posts.post_author = '$user' ORDER BY posts.post_id DESC";

    return mysqli_query($connection, $query);

}


/**FETCH ARRAY FUNCTION */
function fetchArray($result) {
    return mysqli_fetch_array($result);
}

/**COUNT NUM ROWS FUNCTION */
function countRows($result){
    return mysqli_num_rows($result);
}

/**GET USERNAME */
function getUsername(){
    return isset($_SESSION['username']) ? $_SESSION['username'] : null;
}

/**VIEW USERS ONLY SUBSCRIBER */
function is_sub() {

    if(isLoggedIn()){
        $result = query("SELECT user_role FROM users WHERE user_id = " . $_SESSION['user_id'] . "");

        $row = fetchArray($result);
    
        if ($row['user_role'] == 'Subscriber') {
    
            return true;
    
        } else {
    
            return false;
    
        }

    }
    
    return false;
}


/**VIEW USERS ONLY ADMIN */

function is_admin() {

    if(isLoggedIn()){
        $result = query("SELECT user_role FROM users WHERE user_id = " . $_SESSION['user_id'] . "");

        $row = fetchArray($result);
    
        if ($row['user_role'] == 'Admin') {
    
            return true;
    
        } else {
    
            return false;
    
        }

    }
    
    return false;
}



/**USERNAME EXIST */

function usernameExist($username) {

    global $connection;



    $query = "SELECT username FROM users WHERE username = '$username'";

    $result = mysqli_query($connection, $query);

    confirmQuery($result);



    if(mysqli_num_rows($result) > 0) {



        return true;

    } else {



        return false;

    }

}



/**EMAIL EXIST */

function emailExist($email) {

    global $connection;



    $query = "SELECT user_email FROM users WHERE user_email = '$email'";

    $result = mysqli_query($connection, $query);

    confirmQuery($result);



    if(mysqli_num_rows($result) > 0) {



        return true;

    } else {



        return false;

    }

}



/**REGISTER USER */

function registerUser($username, $email, $password, $firstname, $lastname, $user_image) {



    global $connection;

        $username = mysqli_real_escape_string($connection, $username);

        $email    = mysqli_real_escape_string($connection, $email);

        $password = mysqli_real_escape_string($connection, $password);

        $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

        $query = "INSERT INTO users (username, user_email, user_password, user_firstname, user_lastname, user_role, user_image, token )";

        $query .= "VALUES ('{$username}', '{$email}', '{$password}', '{$firstname}', '{$lastname}', 'Subscriber', '{$user_image}', '' )";

        $register_query = mysqli_query($connection, $query);

        confirmQuery($register_query);

}

/**SHOW SELECTED CATEGORY TITLE */
function showCat(){
    global $connection;
    global $post_category;
    global $show_catt;

    $query = "SELECT * FROM categories WHERE cat_id =" . $post_category . "";
    $show_cat = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($show_cat);
    $show_catt = $row['cat_title'];
    
    confirmQuery($show_cat);

}

/**FOOTER CATEGORY */
function footerCategory() {
    global $connection;
    $query = "SELECT * FROM categories";

    $select_categories_sidebar = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_array($select_categories_sidebar)) {

        $cat_title = $row['cat_title'];

        $cat_id = $row['cat_id'];

        echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
    }

    return false;
}

/**LOGIN USER */

function loginUser($username, $password) {

    global $connection;
    global $log_in;

    $username = trim($username);

    $password = trim($password);

    $username = mysqli_real_escape_string($connection, $username);

    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM users WHERE username = '{$username}'" ;

    $select_user_query = mysqli_query($connection, $query);

    if (!$select_user_query) {

        die('QUERY FAILED' . mysqli_error($connection));

    }

    while ($row = mysqli_fetch_array($select_user_query)) {

        $db_id = $row['user_id'];

        $db_username = $row['username'];

        $db_password = $row['user_password'];

        $db_firstname = $row['user_firstname'];

        $db_lastname = $row['user_lastname'];

        $db_role = $row['user_role'];

        $db_email = $row['user_email'];

        $db_image = $row['user_image'];

        if (password_verify($password, $db_password)) {

            $_SESSION['user_id'] = escape($db_id);

            $_SESSION['username'] = escape($db_username);

            $_SESSION['firstname'] = escape($db_firstname);

            $_SESSION['lastname'] = escape($db_lastname);

            $_SESSION['email'] = escape($db_email);

            $_SESSION['user_role'] = escape($db_role);

            $_SESSION['image'] = escape($db_image);

            if ($_SESSION['user_role'] == "Admin") {

                redirect("/cms/admin/dashboard.php");
            } else {

                redirect("/cms/admin");

            }

        } else {

            $log_in = "<p class='alert-danger'>Wrong username or password. Try again</p>";
        }

    }

    $log_in = "<p class='alert-danger'>Wrong username or password. Try again</p>";

}

/**ADD POST */
function addNewPost() {

    global $connection;

    $query = "SELECT * FROM users ";
    $select_user = mysqli_query($connection, $query);

    while($row = mysqli_fetch_array($select_user)) {

    $username_echo = $row['username'];
    $user_id = $row['user_id'];
    }

    if (isset($_POST['create_post'])) {
        
        $post_title = escape($_POST['post_title']);
        $post_category_id = escape($_POST['post_category']);
        $post_author = escape($_SESSION['username']);
        $post_status = escape($_POST['post_status']);
        $post_user_id = escape($_SESSION['user_id']);

        $post_image = $_FILES['post_image']['name'];
        $post_image_temp = $_FILES['post_image']['tmp_name'];


        $post_tags = escape($_POST['post_tags']);
        $post_content = escape($_POST['post_content']);
        $post_date = escape(date('d-m-y'));
        $post_comment_count = escape(0);

        move_uploaded_file($post_image_temp, "../images/$post_image");

        $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status, post_views_counts, likes, user_id) ";
        $query .= "VALUES ({$post_category_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_comment_count}', '{$post_status}', 0, 0, '{$post_user_id}') ";

        $publish_post_query = mysqli_query($connection, $query);

        confirmQuery($publish_post_query);

        $the_post_id = mysqli_insert_id($connection);

        echo "<p class='bg-success'>Post Created. <a href='../post.php?p_id={$the_post_id}'> View Post</a> // <a href='./posts.php?source=add_post'> Add New Posts</a></p>";
    }

    return true;
}

/**SHOW CATEGORY */
function showCategory() {
    global $connection;

    $query = "SELECT * FROM categories";
    $select_edit_categories = mysqli_query($connection, $query);

    confirmQuery($select_edit_categories);

    while ($row = mysqli_fetch_array($select_edit_categories)) {
                    
    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title'];

    echo "<option value='$cat_id'>{$cat_title}</option>";

    }

    return true;
}

/**ADD USER */
function addNewUser() {
    global $connection;
    global $user_created;

    if (isset($_POST['create_user'])) {
	
	$username = escape($_POST['username']);
	$user_password = escape($_POST['password']);
	$user_firstname = escape($_POST['firstname']);
	$user_lastname = escape($_POST['lastname']);
	$user_email = escape($_POST['email']);


	$user_image = $_FILES['user_image']['name'];
	$user_image_temp = $_FILES['user_image']['tmp_name'];


	$user_role = escape($_POST['user_role']);
	


	move_uploaded_file($user_image_temp, "../images/$user_image");

		$username = mysqli_real_escape_string($connection, $username);
        $user_email    = mysqli_real_escape_string($connection, $user_email);
        $user_password = mysqli_real_escape_string($connection, $user_password);

        $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));

        // $hashFormat = "$2y$10$";
        // $salt = "asdqwesasdxzxcvasdqweq";
        // $hash_and_salty = $hashFormat . $salt;
        // $user_password = crypt($user_password, $hash_and_salty);

	$query = "INSERT INTO users(username, user_password, user_firstname, user_lastname, user_email, user_image, user_role, token) ";
	$query .= "VALUES ('{$username}', '{$user_password}', '{$user_firstname}', '{$user_lastname}', '{$user_email}', '{$user_image}', '{$user_role}' , '') ";

	$add_user_query = mysqli_query($connection, $query);

	confirmQuery($add_user_query);

	$user_created =  "User is created: " . " <br> " . "<a href='users.php'>View users</a>";


    }

    return true;
}



































?>