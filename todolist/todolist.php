<?php session_start(); ?>
<?php ob_start(); ?>
<?php include 'includes/db.php' ?>
<?php include 'includes/functions.php' ?>
<?php include 'includes/header.php' ?>
<?php include 'includes/navigation.php' ?>

<?php

if (!$_SESSION['username']) {
	
	header('location: index.php');
}

loggedInUserId();


$error = '';
if (isset($_POST['submit'])) {

insertToDo();					

}

?>

<div class="container mt-5">

	<h1 class="text-center"><?php echo "Hello " . $_SESSION['username'] . ". What is your to do list today?"; ?></h1>

	<div class="row">

		<div class="col-md-2"></div>

		<div class="col-md-8">

			<?php echo $error; ?>

			<form action="" method="post">
				
				<div class="form-group">
					
					<div class="input-group">

						<input class="form-control" type="text" name="task">

						<div class="input-group-append">

							<input class="btn btn-info btn-sm" type="submit" name="submit">

						</div>

					</div>

				</div>

			</form>

		</div>

		<div class="col-md-2"></div>

	</div>

	<div class="row">

		<div class="col-md-2"></div>

		<div class="col-md-8">

			<table class="table table-info">

					<td>Num</td>

					<td>Task</td>

					<td>Date</td>

					<td>Day</td>

					<td>Delete</td>				

					<?php

					$query = "SELECT * FROM todo WHERE user_id =" . loggedInUserId() . "";

					$select_query = mysqli_query($connection, $query);

					$i = 1;

					while ($row = mysqli_fetch_array($select_query)) {
											
						$id 	  = $row['id'];
						$row_task = $row['task'];
						$date = $row['date'];

						?>

						<tbody>

						<th><?php echo $i++; ?></th>

						<th><?php echo $row_task; ?></th>

						<th><?php echo $date; ?></th>

						<th><?php echo date('l'); ?></th>

						<th><a href="todolist.php?delete=<?php echo $id; ?>">&#10060;</a></th>

						</tbody>

					<?php } ?>

			</table>

		</div>

		<div class="col-md-2"></div>

	</div>

</div>

<?php


if (isset($_GET['delete'])) {
	
	deleteToDo();

}


?>












<?php include 'includes/footer.php' ?>
