<?php
use \Slim\Slim;
use \Hcode\Page;
use \Hcode\Model\Category;
use \Hcode\Model;
use \Hcode\Model\products;

$app->get('/', function() {

	$products = products::listAll();

	$Page = new Page();

	$Page->setTpl("index", [

		'products'=>Products::checkList($products)

	]);   
	

});

$app->get("/categories/:idcategory", function($idcategory){

	$category = new Category();

	$category->get((int)$idcategory);

	$page = new Page();

	$page->setTpl("category", [
		'category'=>$category->getValues(),
		'products'=>[]
	]);


});

?>