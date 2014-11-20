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

if (isset($_POST['name']) && isset($_POST['mail']) && isset($_POST['password'])) 
{
	$newUser = $users->creatNewMember($_POST['name'],$_POST['mail'], $_POST['password']);

	if($newUser)
	{
 		$_SESSION['name']= $_POST['name'];
 		$_SESSION['id']= $newUser;
		header("Location: index.php");
	}
}

include "View/inscription.phtml";



