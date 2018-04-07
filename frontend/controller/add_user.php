<?php

session_start();

require_once('../rabbitmq_required.php');

$client = new rabbitMQClient("../testRabbitMQ.ini", "Frontend");

$_SESSION['user_id'] = htmlspecialchars($_POST['user_id']);
var_dump($_SESSION['user_id']);
var_dump($_SESSION['id']);

if (!empty($_SESSION['user_id'])) {

	$request = array();
	$request['type'] = 'user_add';
	$request['id'] = $_SESSION['id'];
	$request['user_id'] = $_SESSION['user_id'];
	$request['status'] = 'pending';
	$request['message'] = "'{$_SESSION['username']} made a friend request to '{$_SESSION['user_id']}'";

	$friend_request = $client->send_request($request);
}

?>