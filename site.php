<?php
use \Slim\Slim;
use \Hcode\Page;
use \Hcode\Model\Category;
use \Hcode\Model;
use \Hcode\Model\products;
use \Hcode\Model\Cart;

$app->get('/', function() {

	$products = products::listAll();

	$Page = new Page();

	$Page->setTpl("index", [

		'products'=>Products::checkList($products)

	]);   
	

});

$app->get("/categories/:idcategory", function($idcategory){

	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

	$category = new Category();

	$category->get((int)$idcategory);

	$pagination = $category->getProductsPage($page);

	$pages = [];

	for ($i=1; $i <= $pagination['pages'] ; $i++) { 
		array_push($pages, [
			'link'=>"/categories/".$category->getidcategory(). '?page='.$i,
			'page'=>$i


		]);
	}

	$page = new Page();

	$page->setTpl("category", [
		'category'=>$category->getValues(),
		'products'=>$pagination["data"],
		'pages'=>$pages
	]);


});

$app->get("/products/:desurl", function($desurl){

	$product = new Products();

	$product->getFromURL($desurl);

	$Page = new Page();

	$Page->setTpl("product-detail", [

		'product'=>$product->getValues(),
		'categories'=>$product->getCategories()

	]);   

});

$app->get("/cart", function(){

	$cart = Cart::getFromSession();

	$Page = new Page();

	$Page->setTpl("cart");   

});



?>