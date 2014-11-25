<?php
spl_autoload_register("my_autoload");
function my_autoload($class)
{
	$filepath = $class.".Class.php";
	$filepath = str_replace("_", "/", $filepath);
	require_once($filepath);
}

session_start();

// Recupération du numéro de page en GET
if(isset($_GET['page']))
	$page=$_GET['page'];
else
	$page=1;

// POSTS
$posts = new Model_Post(); // Nouvel objet de la classe Model_Post()
$offset = ($page-1)*5;
$postMax = $posts->getMaxPost();
$pageMax= ceil($postMax/5);
$post5 = $posts->getLatestPost(5, $offset); // AFFICHER LES 5 DERNIERS ARTICLES
// var_dump($post5);

//COMMENTS
$comments = new Model_Comment(); // Nouvel objet de la classe Model_Comment()



include "View/index.phtml";


