<?php
spl_autoload_register("my_autoload");
function my_autoload($class)
{
	$filepath = $class.".Class.php";
	$filepath = str_replace("_", "/", $filepath);
	require_once($filepath);
}

session_start();
$users = new Model_User();

if (isset($_POST['name']) &&isset($_POST['password'])) 
{
	$user = $users->validMember($_POST['name'], $_POST['password']);
	if($user)
	{
		$_SESSION['name']= $user['name'];
		$_SESSION['id']= $user['id'];
		header("Location: index.php");
	}
}

include "View/login.phtml";



