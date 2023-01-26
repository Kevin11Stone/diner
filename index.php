<?php

// this is my controller

// turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// require autoload file
require_once('vendor/autoload.php');

// instantiate F3 base class
$f3 = Base::instance();

// define a default route (328/diner)
$f3->route('GET /', function () {

    // instantiate a view
    $view = new Template();
    echo $view->render("views/diner-home.html");
});


// define a breakfast route (328/diner/breakfast)
$f3->route('GET /breakfast', function () {

    // instantiate a view
    $view = new Template();
    echo $view->render("views/breakfast.html");
});

// define a lunch route (328/diner/lunch)
$f3->route('GET /lunch', function () {

    // instantiate a view
    $view = new Template();
    echo $view->render("views/lunch.html");
});


// run Fat Free
$f3->run();

