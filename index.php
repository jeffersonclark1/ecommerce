<?php
session_start();

require_once("vendor/autoload.php");
require_once("functions.php");

use \Slim\Slim;
$app = new Slim();

require_once("functions.php");
require_once("site.php");
require_once("admin-categories.php");
require_once("admin.php");
require_once("admin-user.php");
require_once("admin-products.php");
require_once("admin-orders.php");

$app->config('debug', true);

$app->run();

?>