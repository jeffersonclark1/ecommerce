<?php

use Hcode\Model\Categories;
use Hcode\Page;
use \Hcode\Model\Product;

$app->get('/', function() {

    $products = Product::listAll();

    $page = new Page();

    $page->setTpl("index",[
        "products"=>Product::checkList($products)
    ]);

});

$app->get("/categories/:idcategory", function($idcategory){

    $category = new Categories();

    $category->get((int)$idcategory);

    $page = new Page();

    $page->setTpl("category",[
        "category"=>$category->getValues(),
        "products"=>Product::checkList($category->getProducts())
    ]);

});