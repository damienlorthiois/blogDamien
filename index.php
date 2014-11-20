<?php
spl_autoload_register("my_autoload");
function my_autoload($class)
{
	$filepath = $class.".Class.php";
	$filepath = str_replace("_", "/", $filepath);
	require_once($filepath);
}

session_start();

// POSTS
$posts = new Model_Post(); // Nouvel objet de la classe Model_Post()
$post = $posts->getPost(2); // AFFICHER UN POST AVE L'ID 2
$post5 = $posts->getLatestPost(); // AFFICHER LES 5 DERNIERS ARTICLES

//COMMENTS
$comments = new Model_Comment(); // Nouvel objet de la classe Model_Comment()

include "View/blog.phtml";



