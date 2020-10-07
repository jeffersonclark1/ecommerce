<?php
session_start();
require_once("vendor/autoload.php");
require_once("functions.php");

use \Hcode\PageAdmin;
use \Hcode\Model\User;

$app = new \Slim\Slim();

$app->config('debug', true);

$app->get('/', function() {

    $page = new Hcode\Page();

    $page->setTpl("index");

});

$app->get('/admin', function() {

    User::verifyLogin();

    $page = new Hcode\PageAdmin();

    $page->setTpl("index");

});

$app->get('/admin/login', function() {

    $page = new PageAdmin([
        "header"=>false,
        "footer"=>false
    ]);

    $page->setTpl("login");

});

$app->post('/admin/login', function() {

    User::login($_POST["deslogin"], $_POST["despassword"]);

    header("Location: /ecommerce/admin");
    exit;

});

$app->get('/admin/logout', function() {

    User::logout();

    header("Location: /admin/login");
    exit;

});

$app->get('/admin/users', function(){

    User::verifyLogin();

    $users = User::listAll();

    $page = new \Hcode\PageAdmin();
    $page->setTpl('users', array(
        "users"=>$users
    ));
});

$app->get('/admin/users/create', function(){

    User::verifyLogin();

    $page = new \Hcode\PageAdmin();
    $page->setTpl('users-create');
});

$app->get('/admin/users/:iduser/delete', function(){

    User::verifyLogin();

    $page = new PageAdmin();
    $page->setTpl('');
});

$app->get('/admin/users/:iduser', function($iduser){

    User::verifyLogin();

    $page = new PageAdmin();
    $page->setTpl('users-update');
});

$app->post('/admin/users/create', function(){

    User::verifyLogin();

    $page = new PageAdmin();
    $page->setTpl('');
});

$app->post('/admin/users/:iduser', function($iduser){

    User::verifyLogin();

    $page = new PageAdmin();
    $page->setTpl('');
});



$app->run();

?>