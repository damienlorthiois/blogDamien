<?php
spl_autoload_register("my_autoload");
function my_autoload($class)
{
	$filepath = $class.".Class.php";
	$filepath = str_replace("_","/", $filepath);
	require_once($filepath);
}
session_start();

$posts = new Model_Post();
$commentsManager = new Model_Comment();
$nbComment = $commentsManager->getNumberComment($_GET['id']) ;



if (isset($_GET['id'])) 
{
	$post = $posts->getPost($_GET['id']);
	if (isset($_POST['commentContent'])) 
	{
		$newComment = $commentsManager->createComment($_GET['id'],$_SESSION['id'], $_POST['commentContent']);
		header("Location: post.php?id=".$_GET['id']);
		exit();
	}
	$comments = $commentsManager->getComment($_GET['id']);
	include "View/comment.phtml";
}
else echo "404";





