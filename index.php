<?php


spl_autoload_register("my_autoload");

function my_autoload($class)
{
	$filepath = $class.".Class.php";
	$filepath = str_replace("_", "/", $filepath);
	require_once($filepath);
}

// AFFICHER LES PREMIERS POST

$posts = new Model_Post();
$post = $posts->getPost(5);
$post5 = $posts->getLatestPost();
var_dump($post);


include "blog.phtml";



