<?php
	include "router.class.php";
	include "route.class.php";
    
	$router = new Router( $_GET['url'] );
	$router->get('/', function($id = '0'){ echo "Bienvenue sur ma homepage !"; }); 
	$router->get('/posts/:id', function($id){ echo "Voila l'article $id"; }); 
	$router->run(); 
?>