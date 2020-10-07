<?php
session_start();
require_once("vendor/autoload.php");
require_once("functions.php");

use Hcode\Model\User;

$app = new \Slim\Slim();

$app->config('debug', true);

$app->get('/', function() {

    $page = new Hcode\Page();

    $page->setTpl("index");

});

$app->get('/admin', function() {

    var_dump("teste");

    User::verifyLogin();

    $page = new Hcode\PageAdmin();

    $page->setTpl("index");

});

$app->get('/admin/login', function() {

    $page = new Hcode\PageAdmin([
        "header"=>false,
        "footer"=>false
    ]);

    $page->setTpl("login");

});

$app->post('/admin/login', function() {

    User::login(post('deslogin'), post('despassword'));

    header("Location: /admin");
    exit;

});

$app->get('/admin/logout', function() {

    User::logout();

    header("Location: /admin/login");
    exit;

});

$app->get('/admin/users', function(){

    User::verifyLogin();

    $page = new \Hcode\PageAdmin();
    $page->setTpl('users');
});

$app->get('/admin/users/create', function(){

    User::verifyLogin();

    $page = new \Hcode\PageAdmin();
    $page->setTpl('users-create');
});

$app->get('/admin/users/:iduser', function($iduser){

    User::verifyLogin();

    $page = new \Hcode\PageAdmin();
    $page->setTpl('users-update');
});

$app->post('/admin/users/create', function(){

    User::verifyLogin();

    $page = new \Hcode\PageAdmin();
    $page->setTpl('');
});

$app->post('/admin/users/:iduser', function($iduser){

    User::verifyLogin();

    $page = new \Hcode\PageAdmin();
    $page->setTpl('');
});

$app->delete('/admin/users/:iduser', function(){

    User::verifyLogin();

    $page = new \Hcode\PageAdmin();
    $page->setTpl('');
});

$app->run();

?>