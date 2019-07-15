<?php
use \Hcode\PageAdmin;
use \Hcode\Model\User;
use \Hcode\Model\Category;

$app->get('/admin', function() {

	User::verifyLogin();

	$Page = new PageAdmin();

	$Page->setTpl("index");   
	

});

$app->get('/admin/login', function() {

	$Page = new PageAdmin([

		"header"=>false,
		"footer"=>false

	]);

	$Page->setTpl("login");   
	

});

$app->post('/admin/login', function() {

	User::login($_POST["login"], $_POST["password"]);

	header("Location: /admin");
	exit;

});

$app->get('/admin/logout', function() {

	User::logout();

	header("Location: /admin/login");
	exit;
});


?>