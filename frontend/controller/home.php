<?php

session_start();

require_once("../rabbitmq_required.php");
require_once("friends_show.php");

$client = new rabbitMQClient("../testRabbitMQ.ini", "Frontend");

$_SESSION['search'] = htmlspecialchars($_POST['search']);
$_SESSION['user_search'] = htmlspecialchars($_POST['user_search']);

if (!isset($_SESSION['username'])) {
	header("Location: login.php");
	exit();
}

if (isset($_POST['logout'])) {
	session_destroy();
	
	$request['type'] = 'logout';
	$request['username'] = urlencode($_SESSION['username']);
	$request['message'] = 'User has logged out';

	$response = $client->send_request($request);

	header("Location: login.php");
	exit();

}

if (!empty($_SESSION['search'])){

	header("Location: search.php");
	exit();

}

if (!empty($_SESSION['user_search'])) {

	header("Location: user_search.php");
	exit();

}



require("../view/home.view.php");

?>