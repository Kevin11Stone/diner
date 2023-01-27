<?php

// this is my controller

// turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);


// start a session
session_start();


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

// define a order-form1 route (328/diner/order-form1)
$f3->route('GET|POST /order1', function ($f3) {

    // if the form as been posted
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        // move data form POST to SESSION array
        $_SESSION['food'] = $_POST['food'];
        $_SESSION['meal'] = $_POST['meal'];

        // redirect to summary page
        $f3->reroute('summary');

    }


    // instantiate a view
    $view = new Template();
    echo $view->render("views/order-form1.html");
});


// define a order-summary route (328/diner/order-summary )
$f3->route('GET /summary', function () {

    // instantiate a view
    $view = new Template();
    echo $view->render("views/order-summary.html");
});


// run Fat Free
$f3->run();

