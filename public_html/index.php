<?php
session_start();

include "../vendor/autoload.php";

use App\Controllers\FrontController;
use App\Controllers\BlogController;


include __DIR__ . "\..\config.php";

if (strpos($_SERVER['REQUEST_URI'], '/main') !== false) {
    $controller = new FrontController();
    $controller->index();
    return 0;
}


if (strpos($_SERVER['REQUEST_URI'], '/register') !== false) {
    $controller = new FrontController();
    $controller->register();
    return 0;
}

if (strpos($_SERVER['REQUEST_URI'], '/login') !== false) {
    $controller = new FrontController();
    $controller->login();
    return 0;
}

if (strpos($_SERVER['REQUEST_URI'], '/blog') !== false) {
    $controller = new BlogController();
    $controller->index();
    return 0;
}

if (strpos($_SERVER['REQUEST_URI'], '/adminBlog') !== false) {
    $controller = new \App\Controllers\AdminBlogConroller();
    $controller->index();
    return 0;
}