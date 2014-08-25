<?php

// if ($_SERVER['xml_request'] == 4) {
// 	header('Content-type: text/javascript');
// }

header('Content-type: text/javascript');

require_once 'autoloader.php';


if ( empty($_POST['name']) || empty($_POST['email']) || empty($_POST['message']) ) {
	die(json_encode(array(
		'success'  => false,
		'feedback' => 'All field are required'
	)));
} else {
	if ( strlen($_POST['name']) < 4 || is_string($_POST['name']) == FALSE ) {
		die(json_encode(array(
			'success'  => false,
			'feedback' => 'name field must be big then 4 character'
		)));
	}

	if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == false) {
		die(json_encode(array(
			'success'  => false,
			'feedback' => 'you must enter a valide email'
		)));
	}

	if ( strlen($_POST['message']) < 4 ) {
		die(json_encode(array(
			'success'  => false,
			'feedback' => 'message field must be big then 4 character'
		)));
	}

	$name	 = $_POST['name'];
	$email 	 = $_POST['email'];
	$message = $_POST['message'];

	$sql = "INSERT INTO guestbook (name, email, message, posted) VALUES(?, ?, ?, NOW())";
	$query = DB::getInstance()->handler()->prepare($sql);
	$query->bindValue(1, $name, PDO::PARAM_STR);
	$query->bindValue(2, $email, PDO::PARAM_STR);
	$query->bindValue(3, $message, PDO::PARAM_STR);
	$result = $query->execute();

	if ($result) {
		die(json_encode(array(
			'success'  => true,
			'feedback' => 'The post has been added'
		)));
	}
}

die(json_encode(array(
	'success'  => false,
	'feedback' => 'somting is wrong'
)));

?>