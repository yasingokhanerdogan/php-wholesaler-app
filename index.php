<?php
ob_start();
session_start();

define("__mainDIR__", __DIR__);

require __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/core/helpers.php";

$app = new \Core\Bootstrap();
define("baseUrl", config("BASE_URL"));


require __DIR__ . "/routes/routeHelpers.php";
require __DIR__ . "/routes/web.php";