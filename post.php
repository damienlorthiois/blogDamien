<?php

spl_autoload_register("my_autoload");
function my_autoload($class)
{
	$filepath = $class.".Class.php";
	$filepath = str_replace("_", "/", $filepath);
	require_once($filepath);
}

$posts = new Model_Post();
$commentsManager = new Model_Comment();

if (isset($_GET['id'])) 
{
	$post = $posts->getPost($_GET['id']);
	$comments = $commentsManager->getComment($_GET['id']);
	include "View/comment.phtml";
}
else echo "404";





