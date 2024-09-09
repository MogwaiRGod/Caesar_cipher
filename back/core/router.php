<?php

namespace core;

// let's retrieve the arguments of the URL
$params = explode('/', $_GET['p']);

if ($params[0]) {
    $controller = $params[0];
} else {
    // default controller is HomeController
    $controller = 'HomeController'; 
}
if (@$params[1]) {
    $method = $params[1];
} else {
    // default method is index
    $method = 'index'; 
}
if (@$params[2]) {
    // the rest of URL is the parameters
    $req = $params[2];
} else {
    $req = '';
}

$controller = 'Controllers\\' . $controller;

if (method_exists($controller, $method)) {
    $myctrl = new $controller();
    $myctrl->$method($req);

} else {
    echo $method . " methode non existante...erreur 404 pour " . $controller;
}