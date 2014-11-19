<?php


spl_autoload_register("my_autoload");

function my_autoload($class)
{
	$filepath = $class.".Class.php";
	$filepath = str_replace("_", "/", $filepath);
	require_once($filepath);
}

$posts = new Model_Post();
if (isset($_GET['id'])) {
	$post=$posts->getPost($_GET['id']);
	include "article.phtml";
}
else
{
	echo "404";
}


