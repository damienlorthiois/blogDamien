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
$takenUser=false;

if (isset($_POST['name']) ) 
{
	if ($users->verificationMember($_POST['name'])!=false) 
	{
		$takenUser=true;
	}

	else if (strlen($_POST['name'])>=6 && isset($_POST['mail']) && filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL) && isset($_POST['password']) && strlen($_POST['password'])>=6) 
	{
		$takenUser=false;
		$newUser = $users->createNewMember($_POST['name'],$_POST['mail'], $_POST['password']);
		if($newUser)
		{
	 		$_SESSION['name']= $_POST['name'];
	 		$_SESSION['id']= $newUser;
	 		$_SESSION['admin']= 0;
			header("Location: index.php");
		}
	}
}



include "View/inscription.phtml";



