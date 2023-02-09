<?php

// this is my controller

// turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);


// start a session
session_start();


// require autoload file
require_once('vendor/autoload.php');
require_once('model/data-layer.php');
require_once('model/validate.php');

//$food1 = "tacos";
//$food2 = "";
//$food3 = "x";
//echo validFood($food1) ? "valid" : "not valid";
//echo validFood($food2) ? "valid" : "not valid";
//echo validFood($food3) ? "valid" : "not valid";

//var_dump( getMeals() );

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

// define an order-form2 (328/diner/order-form2)
$f3->route('GET|POST /order2', function ($f3) {

//If the form has been submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        //Move data from POST array to SESSION array
        $_SESSION['conds'] = implode(", ",$_POST['conds']);

        //Redirect to summary page
        $f3->reroute('summary');
    }


    $f3->set('condiments', getCondiments());


    // instantiate a view
    $view = new Template();
    echo $view->render("views/order-form2.html");
});



// define a order-form1 route (328/diner/order-form1)
$f3->route('GET|POST /order1', function ($f3) {

    //var_dump($_POST);

    // if the form as been posted
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        // move data form POST to SESSION array
        $food = trim($_POST['food']);
        if ( validFood($food )) {
            $_SESSION['food'] = $food;
        }
        else {
            $f3->set('errors["food"]', 'Food must have at least 2 chars');
        }


        // validate the meal
        $meal = $_POST['meal'];
        if(validMeal($meal)) {
            $_SESSION['meal'] = $meal;
        }
        else {
            $f3->set('errors["meal"]', 'Meal is invalid');

        }

        if( empty($f3->get('errors'))) {
            $f3->reroute('order2');
        }
        // redirect to summary page
        $f3->reroute('order2');

    }

    // add meals to F3 hive
    $f3->set('meals', getMeals());


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

