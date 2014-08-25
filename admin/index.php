<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Guestbook Admin page</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php 

session_start();

if (isset($_SESSION['msg'])) {
	echo $msg = '<p class="warning">' . $_SESSION['msg'] . '</p>';
	unset($msg);
	session_destroy();
}

include '../inc/class.pagination.php';

$pagination = new pagination();
echo $pagination->ini();

$query = $pagination->link->query("SELECT * FROM guestbook ORDER BY id DESC LIMIT $pagination->start, $pagination->records_per_page");

$action = (isset($_GET['action'])) ? $_GET['action'] : null;
$id = (isset($_GET['id'])) ? (int)$_GET['id'] : null;

$msg = array();

if ($action == 'delete') {
	echo '<p class="warning">Do you want to Delete this post</p>';
	echo "<button type='submit'><a href='index.php?action=confirmed&id={$id}'>Confirm</a></button>";
	echo '<button type="submit"><a href="javascript:window.history.go(-1)">Cancel</a></button>';
} else if ($action == 'confirmed') {
	$result = $pagination->link->query("DELETE FROM guestbook WHERE id={$id}");
	if ($result)
		$_SESSION['msg'] = 'The post has been deleted';
		header("Location: index.php");
}

?>
	<table>
		<tr>
			<td>Name</td>
			<td>Email</td>
			<td>Message</td>
			<td>Posted</td>
			<td>Actions</td>
		</tr>
<?php while($row = $query->fetch(PDO::FETCH_ASSOC)): ?>
		<tr>
			<td><?php echo $row['name']; ?></td>
			<td><?php echo $row['email']; ?></td>
			<td><?php echo $row['message']; ?></td>
			<td><?php echo $row['posted']; ?></td>
			<td><button type="submit"><a href="index.php?action=delete&id=<?php echo $row['id']; ?>">Delete</a></button></td>
		</tr>
<?php endwhile; ?>
	</table>
<?php

$pagination->filename = 'index.php';
echo $pagination->createLinks(); ?>
</body>
</html>